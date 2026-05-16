<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\Customer\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.auth.login');
})->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/dashboard', function () {
    return view('pages.admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/customer', function () {
    return view('pages.admin.customer.index');
})->middleware(['auth'])->name('customer');

Route::get('/customer/add', function () {
    return view('pages.admin.customer.create');
})->middleware(['auth'])->name('customerAdd');

Route::get('/customers/{customer}', [CustomerController::class, 'show'])->middleware('auth')->name('admin.customers.show');
