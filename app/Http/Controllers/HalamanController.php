<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pemain;
use App\Models\TeamMatches;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\User;
use App\Models\Message;
use App\Models\ChatContact;


class HalamanController extends Controller
{
    private function isProfileComplete($user)
    {
        // Hanya cek: Foto profil, skill_level, gaya_bermain (tidak perlu minimal 6 pemain)
        $hasPhoto = $user->foto_profil && $user->foto_profil !== '';
        $hasSkill = $user->skill_level && $user->gaya_bermain;
        return $hasPhoto && $hasSkill;
    }

    // Tambahkan pengecekan di semua fitur utama KECUALI showProfilForm
    public function showRecentMatchesForm()
    {
        $user = Auth::user();
        if (!$this->isProfileComplete($user)) {
            return redirect()->route('profil')->with('error', 'Please complete your team profile (photo, recommendation profile, and at least 6 players) before accessing other features.');
        }

        $userId = Auth::id();

        $matches = TeamMatches::with(['team1', 'team2'])
            ->where('team1_id', $userId)
            ->orWhere('team2_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Sidebar.recent-matches', compact('matches'));
    }

    public function showProfilForm()
    {
        $players = \App\Models\Pemain::where('user_id', Auth::id())->orderBy('id', 'desc')->get();

        $avgAge = $players->count() > 0 ? $players->avg('umur') : 0;
        $squadSize = $players->count();

        return view('Sidebar.profil', compact(
            'players',
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
            'angkatan' => 'required|string|max:255',
            'posisi' => 'required|string|in:Kiper,Anchor,Pivot,Flank',
        ]);

        \App\Models\Pemain::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'nomor' => $request->nomor,
            'umur' => $request->umur,
            'angkatan' => $request->angkatan,
            'posisi' => $request->posisi,
            'jurusan' => '',
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
        $user = Auth::user();
        if (!$this->isProfileComplete($user)) {
            return redirect()->route('profil')->with('error', 'Please complete your team profile (photo, recommendation profile, and at least 6 players) before accessing other features.');
        }
        return view('Sidebar.sewa');
    }

    public function showMessageForm(Request $request, $contactId = null)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$this->isProfileComplete($user)) {
            return redirect()->route('profil')->with('error', 'Please complete your team profile (photo, recommendation profile, and at least 6 players) before accessing other features.');
        }

        $contacts = $user->contacts()->with(['contactUser' => function ($q) {
            $q->select('id', 'name', 'foto_profil', 'jurusan');
        }])->get();

        $selectedContact = null;
        $messages = collect();

        if ($contactId) {
            $selectedContact = \App\Models\User::find($contactId);
            \App\Models\Message::where('from_user_id', $contactId)
                ->where('to_user_id', $user->id)
                ->whereNull('read_at')
                ->update(['read_at' => now()]);
            $messages = \App\Models\Message::where(function ($q) use ($user, $contactId) {
                $q->where('from_user_id', $user->id)->where('to_user_id', $contactId);
            })->orWhere(function ($q) use ($user, $contactId) {
                $q->where('from_user_id', $contactId)->where('to_user_id', $user->id);
            })->orderBy('created_at')->get();
        }

        return view('Sidebar.message', compact('contacts', 'selectedContact', 'messages'));
    }

    public function addContactAndRedirect($enemyId)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$this->isProfileComplete($user)) {
            return redirect()->route('profil')->with('error', 'Please complete your team profile (photo, recommendation profile, and at least 6 players) before accessing other features.');
        }
        $user->contacts()->firstOrCreate(['contact_user_id' => $enemyId]);
        $enemy = \App\Models\User::find($enemyId);
        if ($enemy) {
            $enemy->contacts()->firstOrCreate(['contact_user_id' => $user->id]);
        }
        return redirect()->route('message.with', ['contactId' => $enemyId]);
    }

    public function sendMessage(Request $request, $contactId)
    {
        $request->validate(['content' => 'required|string|max:1000']);
        Message::create([
            'from_user_id' => Auth::id(),
            'to_user_id' => $contactId,
            'content' => $request->content,
        ]);
        return redirect()->route('message.with', ['contactId' => $contactId]);
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
            'nama_tim' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = \App\Models\User::find(Auth::id());
        if ($user) {
            $user->name = $request->nama_tim;
            $user->email = $request->email;
            $user->phone = $request->phone;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            if ($request->hasFile('foto_profil')) {
                if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
                    Storage::disk('public')->delete($user->foto_profil);
                }

                $file = $request->file('foto_profil');
                $filename = 'profile_' . $user->id . '_' . time() . '.jpg';
                $path = 'profiles/' . $filename;

                if (!Storage::disk('public')->exists('profiles')) {
                    Storage::disk('public')->makeDirectory('profiles');
                }

                $manager = new ImageManager(new Driver());
                $img = $manager->read($file)->cover(400, 400)->toJpeg(90);
                Storage::disk('public')->put($path, (string) $img);

                $user->foto_profil = $path;
            }

            $user->save();
        }

        return redirect()->route('profil')->with('success', 'Profil tim berhasil diperbarui.');
    }
}
