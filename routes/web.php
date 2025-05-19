<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HalamanController::class, 'showHomeForm'])->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/', function () {
    return redirect()->route(Auth::check() ? 'home' : 'login');
});

Route::get('/home', [HalamanController::class, 'showHomeForm'])->middleware('auth')->name('home');

Route::get('/recent-matches', [HalamanController::class, 'showRecentMatchesForm'])->name('recent-matches');

Route::get('/profil', [HalamanController::class, 'showProfilForm'])->middleware('auth')->name('profil');
Route::post('/profil', [HalamanController::class, 'storePlayer'])->middleware('auth')->name('profil.store');

Route::get('/find', [HalamanController::class, 'showFindForm'])->middleware('auth')->name('find');
Route::get('/sewa', [HalamanController::class, 'showSewaForm'])->middleware('auth')->name('sewa');
Route::get('/message', [HalamanController::class, 'showMessageForm'])->middleware('auth')->name('message');


Route::post('/logout', [HalamanController::class, 'logout'])->name('logout');
