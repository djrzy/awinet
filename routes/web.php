<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\Customer\CustomerController;
use App\Http\Controllers\Admin\InternetPlan\InternetPlanController;
use App\Http\Controllers\Admin\Tenant\SettingsController;
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
})->middleware(['auth'])->name('customer.add');

Route::get('/customer/{customer}', [CustomerController::class, 'show'])->middleware('auth')->name('admin.customers.show');

Route::get('/plan/internet', [InternetPlanController::class, 'show'])->middleware('auth')->name('plan.internet');

Route::get('/maps', function () {
    $customers = \App\Models\Customer::with('services')->get();
    return view('pages.admin.customer.maps', compact('customers'));
})->name('customer.maps');

Route::get('/invoice', function () {
    return view('pages.admin.invoice.index');
})->middleware(['auth'])->name('invoice');

Route::middleware(['auth'])->name('admin.')->group(function () {
    Route::get('/setting/billing-cycle', [SettingsController::class, 'billing_cycle'])->name('billing-cycles.create');

    Route::get('/routers', function () {
        return view('pages::admin.router.index');
    })->name('routers');
});
