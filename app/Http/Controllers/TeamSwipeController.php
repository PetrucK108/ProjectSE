<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TeamMatches;
use App\Models\Like;

class TeamSwipeController extends Controller
{
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

        // If it's an accept, also record in likes table
        if ($request->action === 'accept') {
            DB::table('likes')->insertOrIgnore([
                'user_id' => $user->id,
                'liked_user_id' => $request->target_user_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Cek apakah target user juga sudah accept user ini
            $mutual = DB::table('swipes')
                ->where('user_id', $request->target_user_id)
                ->where('target_user_id', $user->id)
                ->where('action', 'accept')
                ->exists();

            if ($mutual) {
                // Urutkan ID agar tidak double
                $team1 = min($user->id, $request->target_user_id);
                $team2 = max($user->id, $request->target_user_id);

                $alreadyMatched = TeamMatches::where('team1_id', $team1)
                    ->where('team2_id', $team2)
                    ->exists();

                if (!$alreadyMatched) {
                    TeamMatches::create([
                        'team1_id' => $team1,
                        'team2_id' => $team2,
                    ]);
                }
            }
        }

        return redirect()->route('find');
    }

    public function swipe(Request $request)
    {
        return $this->handleSwipe($request);
    }

    public function index()
    {
        // NOTES : Average Goals dan Conceded Sekarang Sedang Tidak Digunakan Jadi Untuk Content-Based Filtering Kita Hanya Menggunakan Skill Level dan Playstyle Saja Untuk Saat Ini

        // Ambil user yang sedang login
        $user = Auth::user();
        // Jika belum login, redirect ke halaman login
        if (!$user) {
            return redirect()->route('login');
        }

        // Ambil data user dari database (bukan dari session cache)
        $freshUser = User::find($user->id);

        // Cek kelengkapan profil: foto profil, skill level, dan gaya bermain
        $fotoProfil = $freshUser->foto_profil;
        $isDefaultPhoto = !$fotoProfil || $fotoProfil === 'images/default-user.png';
        $isSkillEmpty = !$freshUser->skill_level || $freshUser->skill_level === '' || $freshUser->skill_level === '0';
        $isPlaystyleEmpty = !$freshUser->gaya_bermain || $freshUser->gaya_bermain === '' || $freshUser->gaya_bermain === '0';

        // Jika ada yang kosong, redirect ke halaman profil dengan pesan error
        $profileIncomplete = $isSkillEmpty || $isPlaystyleEmpty || $isDefaultPhoto;
        if ($profileIncomplete) {
            return redirect()->route('profil')->with('error', 'Lengkapi profil tim (foto, skill level, dan playstyle) sebelum menggunakan fitur ini.');
        }

        // Ambil semua user_id yang pernah di-swipe oleh user saat ini
        $swipedUserIds = DB::table('swipes')
            ->where('user_id', $freshUser->id)
            ->pluck('target_user_id')
            ->toArray();

        // Ambil semua tim selain dirinya sendiri dan yang belum pernah di-swipe
        $teams = User::where('id', '!=', $freshUser->id)
            ->whereNotIn('id', $swipedUserIds)
            ->get();

        $scoreContents = [];

        // Hitung skor content-based filtering untuk setiap tim
        foreach ($teams as $team) {
            // Ambil skill dan playstyle dari user
            $userSkill = is_numeric($freshUser->skill_level) ? (float)$freshUser->skill_level : 0;
            $userPlayStyle = $freshUser->gaya_bermain ?? '';

            // Ambil skill dan playstyle dari tim kandidat
            $teamSkill = is_numeric($team->skill_level) ? (float)$team->skill_level : 0;
            $teamPlayStyle = $team->gaya_bermain ?? '';

            // Rumus Dari Content-Based Filtering:
            // Hitung skor berdasarkan kemiripan skill dan playstyle
            $scoreContent =
                (1 - abs($userSkill - $teamSkill) / 5) * 0.5 +
                // Mirip skill = nilai lebih tinggi
                (($userPlayStyle == $teamPlayStyle) ? 1 : 0) * 0.5;
            // Sama gaya bermain = nilai 0.5

            $scoreContents[$team->id] = $scoreContent;
        }

        $scoreCollabs = [];

        // Ambil semua tim yang disukai oleh user ini
        $userLikedTeamIds = DB::table('likes')
            ->where('user_id', $freshUser->id)
            ->pluck('liked_user_id')
            ->toArray();
        $totalLikes = count($userLikedTeamIds);

        // Hitung skor collaborative filtering
        foreach ($teams as $team) {
            $mutualLikes = 0;

            // Jika user pernah menyukai tim lain
            if ($totalLikes > 0) {
                // Hitung berapa banyak dari tim yang disukai juga menyukai tim ini
                $mutualLikes = DB::table('likes')
                    ->whereIn('liked_user_id', $userLikedTeamIds)
                    ->where('liked_user_id', $team->id)
                    ->count();
            }

            // Rumus Dari Collaborative Filtering:
            // Skor = jumlah mutual / total like
            $scoreCollab = $totalLikes > 0 ? $mutualLikes / $totalLikes : 0;
            $scoreCollabs[$team->id] = $scoreCollab;
        }

        $scoreHybrids = [];

        // Hitung skor hybrid = rata-rata dari skor content & collab
        foreach ($teams as $team) {
            $content = $scoreContents[$team->id] ?? 0;
            $collab = $scoreCollabs[$team->id] ?? 0;
            $scoreHybrids[$team->id] = ($content + $collab) / 2;
        }

        $teamToShow = null;

        // Jika ada skor hybrid
        if (count($scoreHybrids) > 0) {
            $userSkill = $freshUser->skill_level;
            $userPlayStyle = $freshUser->gaya_bermain;

            // Buat prioritas playstyle tergantung gaya bermain user
            $playstylePriority = [
                'Ultra Defensive' => ['Ultra Attacking', 'Attacking', 'Balanced', 'Defensive', 'Ultra Defensive'],
                'Defensive' => ['Attacking', 'Ultra Attacking', 'Balanced', 'Defensive', 'Ultra Defensive'],
                'Balanced' => ['Balanced', 'Attacking', 'Defensive', 'Ultra Attacking', 'Ultra Defensive'],
                'Attacking' => ['Defensive', 'Ultra Defensive', 'Balanced', 'Attacking', 'Ultra Attacking'],
                'Ultra Attacking' => ['Ultra Defensive', 'Defensive', 'Balanced', 'Attacking', 'Ultra Attacking'],
            ];

            // Urutkan tim berdasarkan skill setara, playstyle prioritas, lalu skor hybrid
            $sortedTeams = $teams->sort(function ($a, $b) use ($userSkill, $userPlayStyle, $playstylePriority, $scoreHybrids) {
                // Bandingkan skill: yang sama lebih diutamakan
                $aSkillDiff = abs((string)$a->skill_level === (string)$userSkill ? 0 : 1);
                $bSkillDiff = abs((string)$b->skill_level === (string)$userSkill ? 0 : 1);
                if ($aSkillDiff != $bSkillDiff) {
                    return $aSkillDiff - $bSkillDiff;
                }

                // Bandingkan playstyle berdasarkan urutan prioritas
                $aPlayIdx = array_search($a->gaya_bermain, $playstylePriority[$userPlayStyle] ?? []);
                $bPlayIdx = array_search($b->gaya_bermain, $playstylePriority[$userPlayStyle] ?? []);
                if ($aPlayIdx !== false && $bPlayIdx !== false && $aPlayIdx != $bPlayIdx) {
                    return $aPlayIdx - $bPlayIdx;
                }

                // Bandingkan skor hybrid
                $aScore = $scoreHybrids[$a->id] ?? 0;
                $bScore = $scoreHybrids[$b->id] ?? 0;
                return $bScore <=> $aScore;
            })->values();

            // Ambil tim pertama dari hasil sorting (tim terbaik)
            $teamToShow = $sortedTeams->first();
        }

        // Kirim data ke halaman Blade
        return view('Sidebar.find', [
            'teamToShow' => $teamToShow,            // Tim yang ditampilkan di kartu
            'recommendedTeams' => $teams,           // Semua tim kandidat
            'scoreContents' => $scoreContents,      // Skor content-based
            'scoreCollabs' => $scoreCollabs,        // Skor collaborative
            'scoreHybrids' => $scoreHybrids,        // Skor hybrid akhir
        ]);
    }
}

