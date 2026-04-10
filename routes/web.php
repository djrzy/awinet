<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})
    // ->middleware(['auth'])
    ->name('dashboard');
