<?php

use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    App::setLocale('en');
    return view('main');
});

Route::get('/lv', function () {
    App::setLocale('lv');
    return view('main');
});

Route::get('/ru', function () {
    App::setLocale('ru');
    return view('main');
});

Route::resource('media', MediaController::class);
Route::delete('/media/{media:uuid}', [MediaController::class, 'destroy'])->name('media.destroy');
