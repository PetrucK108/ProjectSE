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
        $players = Pemain::all();
        return view('Sidebar.profil', compact('players'));
    }

    public function storePlayer(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor' => 'required|integer',
            'umur' => 'required|integer',
            'jurusan' => 'required|string|max:255',
            'angkatan' => 'required|string|max:10',
        ]);

        Pemain::create([
            'nama' => $validated['nama'],
            'nomor' => $validated['nomor'],
            'umur' => $validated['umur'],
            'jurusan' => $validated['jurusan'],
            'angkatan' => $validated['angkatan'],
            'gol' => 0,
            'assist' => 0,
            'clean_sheet' => 0,
        ]);

        return redirect()->route('profil')->with('success', 'Pemain berhasil ditambahkan');
    }

    public function showFindForm()
    {
        return view('Sidebar.find');
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
        return redirect('/login');
    }
}
