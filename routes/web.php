<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

Route::get('/theme/{theme}', function ($theme) {
    session()->put('theme', $theme);
    session()->save();
    return redirect()->back();
});

Route::get('/language/{locale}', function ($locale) {
    session()->put('locale', $locale);
    session()->save();
    return redirect()->back();
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/media/preview/{id}', [MediaController::class, 'preview'])->name('media.preview');
    Route::get('/media/download/{id}', [MediaController::class, 'download'])->name('media.download');
    Route::resource('media', MediaController::class);

    Route::view('/settings', 'settings')->name('settings');
    Route::view('/', 'main');
});
