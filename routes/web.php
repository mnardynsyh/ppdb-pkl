<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\PenghasilanController;
use App\Http\Controllers\Admin\AgamaController;
use App\Http\Controllers\Admin\PendidikanController;
use App\Http\Controllers\WaliController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Public Routes (Guest Only)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

    // registrasi wali
    Route::prefix('wali')->name('wali.')->group(function () {
        Route::get('/register', [WaliController::class, 'create'])->name('register');
        Route::post('/register', [WaliController::class, 'store'])->name('store');
    });
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Admin / Wali)
|--------------------------------------------------------------------------
*/

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('job', JobController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('penghasilan', PenghasilanController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('agama', AgamaController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('pendidikan', PendidikanController::class)->only(['index', 'store', 'update', 'destroy']);
});

// Wali
Route::middleware(['auth', 'wali'])->prefix('wali')->name('wali.')->group(function () {
    Route::get('/dashboard', [WaliController::class, 'dashboard'])->name('dashboard');
});
