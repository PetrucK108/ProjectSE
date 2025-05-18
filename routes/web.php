<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', [HalamanController::class, 'showHomeForm'])->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot-password');

Route::get('/home', [HalamanController::class, 'showHomeForm'])->name('home');

Route::get('/recent-matches', [HalamanController::class, 'showRecentMatchesForm'])->name('recent-matches');

Route::get('/profil', [HalamanController::class, 'showProfilForm'])->name('profil');
Route::post('/profil', [HalamanController::class, 'storePlayer'])->name('profil.store');

Route::get('/find', [HalamanController::class, 'showFindForm'])->name('find');

Route::get('/sewa', [HalamanController::class, 'showSewaForm'])->name('sewa');

Route::get('/message', [HalamanController::class, 'showMessageForm'])->name('message');

Route::post('/logout', [HalamanController::class, 'logout'])->name('logout');
