<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.Auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})
    // ->middleware(['auth'])
    ->name('dashboard');
