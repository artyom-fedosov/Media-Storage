<?php

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
