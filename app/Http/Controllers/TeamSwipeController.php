<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeamSwipeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user->skill_level || !$user->gaya_bermain) {
            return redirect()->route('profil')->with('error', 'Lengkapi Skill Level dan Play Style untuk menggunakan fitur ini.');
        }

        // Ambil semua tim lain yang belum diswipe oleh user ini
        $allTeams = User::where('id', '!=', $user->id)
            ->whereNotIn('id', function ($query) use ($user) {
                $query->select('target_user_id')
                    ->from('swipes')
                    ->where('user_id', $user->id);
            })
            ->whereNotNull('skill_level')
            ->whereNotNull('gaya_bermain')
            ->get();

        $matches = collect();

        foreach ([0, 1, 2] as $diff) {
            $sameLevelTeams = $allTeams->filter(function ($team) use ($user, $diff) {
                return abs((int)$team->skill_level - (int)$user->skill_level) == $diff;
            });

            $prioritized = $sameLevelTeams->sortBy(function ($team) use ($user) {
                return $this->playStylePriority($user->gaya_bermain, $team->gaya_bermain);
            });

            $matches = $matches->merge($prioritized);
        }

        // Ambil satu rekomendasi teratas
        $teamToShow = $matches->first();

        return view('Sidebar.find', compact('teamToShow'));
    }

    public function swipe(Request $request)
    {
        $user = Auth::user();

        DB::table('swipes')->insert([
            'user_id' => $user->id,
            'target_user_id' => $request->target_user_id,
            'action' => $request->action,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('team-swipe.index');
    }

    private function playStylePriority($userStyle, $targetStyle)
    {
        $priorityMap = [
            'Ultra Attacking' => ['Ultra Defensive', 'Defensive', 'Balanced', 'Attacking', 'Ultra Attacking'],
            'Attacking' => ['Defensive', 'Balanced', 'Attacking', 'Ultra Defensive', 'Ultra Attacking'],
            'Balanced' => ['Balanced', 'Attacking', 'Defensive', 'Ultra Attacking', 'Ultra Defensive'],
            'Defensive' => ['Attacking', 'Balanced', 'Defensive', 'Ultra Attacking', 'Ultra Defensive'],
            'Ultra Defensive' => ['Ultra Attacking', 'Attacking', 'Balanced', 'Defensive', 'Ultra Defensive'],
        ];

        return array_search($targetStyle, $priorityMap[$userStyle] ?? []) ?? 999;
    }

    // Optional: Hybrid recommendation (tidak dipanggil di index saat ini)

    private function hybridRecommendations(User $user)
    {
        $content = $this->contentBased($user);
        $collab = $this->collaborativeFiltering($user);
        $merged = $content->merge($collab)->unique('id');

        return $merged->sortByDesc(fn($u) => $this->calculateHybridScore($user, $u));
    }

    private function contentBased(User $user)
    {
        return User::where('id', '!=', $user->id)
            ->select('users.*')
            ->selectRaw('
                (1 - ABS(skill_level - ?)/5) * 0.25 +
                (1 - ABS(avg_gol - ?)/10) * 0.25 +
                (1 - ABS(avgConceded - ?)/10) * 0.25 +
                (CASE WHEN gaya_bermain = ? THEN 1 ELSE 0 END) * 0.25 AS similarity_score
            ', [
                $user->skill_level,
                $user->avg_gol,
                $user->avgConceded,
                $user->gaya_bermain,
            ])
            ->orderByDesc('similarity_score')
            ->take(10)
            ->get();
    }

    private function collaborativeFiltering(User $user)
    {
        $likedUserIds = DB::table('likes')
            ->where('user_id', $user->id)
            ->pluck('liked_user_id');

        $otherUsers = DB::table('likes')
            ->whereIn('user_id', $likedUserIds)
            ->where('liked_user_id', '!=', $user->id)
            ->groupBy('liked_user_id')
            ->select('liked_user_id', DB::raw('count(*) as count'))
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        return User::whereIn('id', $otherUsers->pluck('liked_user_id'))->get();
    }

    private function calculateHybridScore(User $base, User $other)
    {
        $contentScore =
            (1 - abs($base->skill_level - $other->skill_level) / 5) * 0.25 +
            (1 - abs($base->avg_gol - $other->avg_gol) / 10) * 0.25 +
            (1 - abs($base->avgConceded - $other->avgConceded) / 10) * 0.25 +
            ($base->gaya_bermain === $other->gaya_bermain ? 1 : 0) * 0.25;

        $collabScore = DB::table('likes')
            ->where('user_id', $base->id)
            ->where('liked_user_id', $other->id)
            ->exists() ? 1 : 0;

        return ($contentScore * 0.7) + ($collabScore * 0.3);
    }
}
