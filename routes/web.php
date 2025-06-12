<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

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
    Route::post('/media/{uuid}/share', [MediaController::class, 'share'])->name('media.share');
    Route::resource('media', MediaController::class);

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
});
