<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TeamSwipeController;

// Redirect root
Route::get('/', function () {
    return redirect()->route(Auth::check() ? 'profil' : 'login');
});

// Guest Routes (Login & Register)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [HalamanController::class, 'logout'])->name('logout');

    // Halaman utama
    Route::get('/recent-matches', [HalamanController::class, 'showRecentMatchesForm'])->name('recent-matches');

    // Profil Tim & Pemain
    Route::get('/profil', [HalamanController::class, 'showProfilForm'])->name('profil');
    Route::post('/profil', [HalamanController::class, 'storePlayer'])->name('profil.store');
    Route::post('/profil/player', [HalamanController::class, 'storePlayer'])->name('profil.storePlayer');
    Route::delete('/profil/{id}', [HalamanController::class, 'destroy'])->name('profil.destroy');
    Route::post('/profil/tim/update', [HalamanController::class, 'updateProfilTim'])->name('profil.tim.update');
    Route::post('/profil/tim/edit', [HalamanController::class, 'editProfilTim'])->name('profil.tim.edit');

    // Fitur Find & Swipe
    Route::get('/find', [TeamSwipeController::class, 'index'])->name('find');
    Route::post('/swipe-action', [TeamSwipeController::class, 'handleSwipe'])->name('swipe.action');
    Route::post('/swipe', [TeamSwipeController::class, 'swipe'])->name('swipe');

    // Like user (optional anonymous fallback check)
    Route::post('/like/{id}', function ($id) {
        DB::table('likes')->insert([
            'user_id' => Auth::id(),
            'liked_user_id' => $id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return back();
    })->name('like.user');

    // Halaman tambahan
    Route::get('/sewa', [HalamanController::class, 'showSewaForm'])->name('sewa');
    Route::get('/message', [HalamanController::class, 'showMessageForm'])->name('message');
    Route::get('/message/contact/{contactId}', [HalamanController::class, 'showMessageForm'])->name('message.with');
    Route::get('/message/add-contact/{enemyId}', [HalamanController::class, 'addContactAndRedirect'])->name('message.addContact');
    Route::post('/message/send/{contactId}', [HalamanController::class, 'sendMessage'])->name('message.send');
});

