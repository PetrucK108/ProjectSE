<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('Auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users,phone',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
                'unique:users,email'
            ],
            'password' => 'required|string|min:6',
            'fakultas' => 'required|string',
            'jurusan' => 'required|string',
        ], [
            'email.regex' => 'Email harus menggunakan Gmail.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone.unique' => 'Nomor telepon sudah terdaftar.',
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'jurusan' => $request->jurusan,
            'fakultas' => $request->fakultas,
        ]);

        // Tidak perlu OTP, langsung login
        Auth::login($user);

        return redirect()->route('profil')->with('success', 'Registrasi berhasil!');
    }
}

