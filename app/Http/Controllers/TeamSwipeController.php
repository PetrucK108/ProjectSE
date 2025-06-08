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

        // Check if user has completed their profile
        if (!$user->skill_level || !$user->gaya_bermain) {
            return redirect()->route('profil')->with('error', 'Lengkapi Skill Level dan Play Style untuk menggunakan fitur ini.');
        }

        // Get all teams that haven't been swiped by current user
        $availableTeams = User::where('id', '!=', $user->id)
            ->whereNotIn('id', function ($query) use ($user) {
                $query->select('target_user_id')
                    ->from('swipes')
                    ->where('user_id', $user->id);
            })
            ->whereNotNull('skill_level')
            ->whereNotNull('gaya_bermain')
            ->with('pemain') // Load players relationship
            ->get();

        if ($availableTeams->isEmpty()) {
            return view('Sidebar.find', ['teamToShow' => null]);
        }

        // Smart recommendation algorithm
        $recommendations = $this->getSmartRecommendations($user, $availableTeams);

        // Get the first recommendation
        $teamToShow = $recommendations->first();

        return view('Sidebar.find', compact('teamToShow'));
    }

    public function handleSwipe(Request $request)
    {
        $request->validate([
            'target_user_id' => 'required|exists:users,id',
            'action' => 'required|in:accept,decline'
        ]);

        $user = Auth::user();

        // Record the swipe
        DB::table('swipes')->insert([
            'user_id' => $user->id,
            'target_user_id' => $request->target_user_id,
            'action' => $request->action,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // If it's an accept, also record in likes table for compatibility
        if ($request->action === 'accept') {
            DB::table('likes')->insertOrIgnore([
                'user_id' => $user->id,
                'liked_user_id' => $request->target_user_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return redirect()->route('find')->with(
            'success',
            $request->action === 'accept' ? 'Tim berhasil disukai!' : 'Tim dilewati'
        );
    }

    private function getSmartRecommendations(User $user, $availableTeams)
    {
        return $availableTeams->map(function ($team) use ($user) {
            $score = $this->calculateCompatibilityScore($user, $team);
            $team->compatibility_score = $score;
            return $team;
        })->sortByDesc('compatibility_score');
    }

    private function calculateCompatibilityScore(User $user, User $team)
    {
        $score = 0;

        // Skill level compatibility (40% weight)
        $skillLevelMap = [
            'Beginner' => 1,
            'Intermediate' => 2,
            'Advanced' => 3,
            'Professional' => 4
        ];

        $userSkillLevel = $skillLevelMap[$user->skill_level] ?? 0;
        $teamSkillLevel = $skillLevelMap[$team->skill_level] ?? 0;

        $skillDifference = abs($userSkillLevel - $teamSkillLevel);
        $skillScore = max(0, (4 - $skillDifference) / 4) * 40;
        $score += $skillScore;

        // Play style compatibility (30% weight)
        $styleCompatibility = $this->getPlayStyleCompatibility($user->gaya_bermain, $team->gaya_bermain);
        $score += $styleCompatibility * 30;

        // Performance metrics (20% weight)
        $avgGoalsDiff = abs(($user->avg_gol ?? 0) - ($team->avg_gol ?? 0));
        $performanceScore = max(0, (5 - $avgGoalsDiff) / 5) * 20;
        $score += $performanceScore;

        // Team size factor (10% weight)
        $teamSize = $team->pemain->count();
        $optimalSize = 7; // Ideal team size
        $sizeDiff = abs($teamSize - $optimalSize);
        $sizeScore = max(0, (7 - $sizeDiff) / 7) * 10;
        $score += $sizeScore;

        return $score;
    }

    private function getPlayStyleCompatibility($userStyle, $teamStyle)
    {
        // Compatibility matrix for play styles
        $compatibilityMatrix = [
            'Ultra Attacking' => [
                'Ultra Defensive' => 1.0,
                'Defensive' => 0.8,
                'Balanced' => 0.6,
                'Attacking' => 0.4,
                'Ultra Attacking' => 0.2
            ],
            'Attacking' => [
                'Ultra Defensive' => 0.8,
                'Defensive' => 1.0,
                'Balanced' => 0.8,
                'Attacking' => 0.6,
                'Ultra Attacking' => 0.4
            ],
            'Balanced' => [
                'Ultra Defensive' => 0.6,
                'Defensive' => 0.8,
                'Balanced' => 1.0,
                'Attacking' => 0.8,
                'Ultra Attacking' => 0.6
            ],
            'Defensive' => [
                'Ultra Defensive' => 0.4,
                'Defensive' => 0.6,
                'Balanced' => 0.8,
                'Attacking' => 1.0,
                'Ultra Attacking' => 0.8
            ],
            'Ultra Defensive' => [
                'Ultra Defensive' => 0.2,
                'Defensive' => 0.4,
                'Balanced' => 0.6,
                'Attacking' => 0.8,
                'Ultra Attacking' => 1.0
            ]
        ];

        return $compatibilityMatrix[$userStyle][$teamStyle] ?? 0.5;
    }

    // Legacy method for backward compatibility
    public function swipe(Request $request)
    {
        return $this->handleSwipe($request);
    }
}
