<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pemain;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class HalamanController extends Controller
{
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
            'skill_level' => 'required|integer|between:1,4',
            'gaya_bermain' => 'required|integer|between:1,5',
        ]);

        // Tambahkan ini
        $skillMap = [
            1 => 'Beginner',
            2 => 'Intermediate',
            3 => 'Advanced',
            4 => 'Professional'
        ];

        $styleMap = [
            1 => 'Ultra Defensive',
            2 => 'Defensive',
            3 => 'Balanced',
            4 => 'Attacking',
            5 => 'Ultra Attacking'
        ];

        $user = Auth::user();
        if ($user instanceof \App\Models\User) {
            $user->skill_level = $skillMap[$request->input('skill_level')];
            $user->gaya_bermain = $styleMap[$request->input('gaya_bermain')];
            $user->save();
        }

        return redirect()->route('profil')->with('success', 'Profil tim berhasil diperbarui.');
    }

    public function editProfilTim(Request $request)
    {
        $request->validate([
            'nama_tim' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        if ($user instanceof \App\Models\User) {
            $user->name = $request->nama_tim;
            $user->email = $request->email;
            $user->phone = $request->phone;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            if ($request->hasFile('foto_profil')) {
                $image = $request->file('foto_profil');
                $filename = 'profil_' . $user->id . '.' . $image->getClientOriginalExtension();
                $path = public_path('uploads/profil/' . $filename);

                $user->foto_profil = 'uploads/profil/' . $filename;
            }

            $user->save();
        }

        return redirect()->route('profil')->with('success', 'Profil tim berhasil diperbarui.');
    }
}