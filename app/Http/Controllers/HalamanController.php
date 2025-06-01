<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemain;

class HalamanController extends Controller
{
    public function showHomeForm()
    {
        return view('Home.home');
    }

    public function showRecentMatchesForm()
    {
        return view('Sidebar.recent-matches');
    }

    public function showProfilForm()
    {
        $players = Pemain::where('user_id', Auth::id())->get();

        $totalGol = $players->sum('gol');
        $jumlahPertandingan = 25;

        $avg_gol = $jumlahPertandingan > 0 ? $totalGol / $jumlahPertandingan : 0;

        $kiper = $players->where('posisi', 'kiper');
        $totalConceded = $kiper->sum('goals_conceded');
        $avgConceded = $jumlahPertandingan > 0 ? $totalConceded / $jumlahPertandingan : 0;



        $avgAge = $players->count() > 0 ? $players->avg('umur') : 0;
        $squadSize = $players->count();

        return view('Sidebar.profil', compact(
            'players',
            'avg_gol',
            'totalConceded',
            'avgConceded',
            'avgAge',
            'squadSize'
        ));
    }



    public function storePlayer(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor' => 'required|integer',
            'umur' => 'required|integer',
            'jurusan' => 'required|string|max:255',
            'angkatan' => 'required|string|max:255',
            'posisi' => 'required|string|in:Kiper,Anchor,Pivot,Flank',
        ]);

        Pemain::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'nomor' => $request->nomor,
            'umur' => $request->umur,
            'jurusan' => $request->jurusan,
            'angkatan' => $request->angkatan,
            'posisi' => $request->posisi,
            'gol' => 0,
            'assist' => 0,
            'goals_conceded' => 0,
        ]);

        return redirect()->route('profil')->with('success', 'Pemain berhasil ditambahkan');
    }


    public function destroy($id)
    {
        $pemain = Pemain::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $pemain->delete();

        return redirect()->back()->with('success', 'Pemain berhasil dihapus.');
    }

    public function showSewaForm()
    {
        return view('Sidebar.sewa');
    }

    public function showMessageForm()
    {
        return view('Sidebar.message');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }

    public function updateProfilTim(Request $request)
    {
        $request->validate([
            'skill_level' => 'required|in:Beginner,Intermediate,Advanced,Professional',
            'gaya_bermain' => 'required|in:Ultra Attacking,Attacking,Balanced,Defensive,Ultra Defensive',
        ]);

        $skillMap = [
            'Beginner' => 1,
            'Intermediate' => 2,
            'Advanced' => 3,
            'Professional' => 4,
        ];

        $styleMap = [
            'Ultra Attacking' => 1,
            'Attacking' => 2,
            'Balanced' => 3,
            'Defensive' => 4,
            'Ultra Defensive' => 5,
        ];

        $user = Auth::user();
        if ($user instanceof \App\Models\User) {
            $user->skill_level = $skillMap[$request->input('skill_level')];
            $user->gaya_bermain = $styleMap[$request->input('gaya_bermain')];
            $user->save();
        }

        return redirect()->route('profil')->with('success', 'Profil tim berhasil diperbarui.');
    }
}
