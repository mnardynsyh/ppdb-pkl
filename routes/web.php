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
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login/proses', 'login')->name('login.process');
    Route::post('/logout', 'logout')->name('logout');
});

// Wali Registration
Route::prefix('wali')->name('wali.')->group(function () {
    Route::get('/register', [WaliController::class, 'create'])->name('register');
    Route::post('/register', [WaliController::class, 'store'])->name('store');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Job
    Route::resource('job', JobController::class)->only(['index', 'store', 'update', 'destroy']);

    // Penghasilan
    Route::resource('penghasilan', PenghasilanController::class)->only(['index', 'store', 'update', 'destroy']);

    // Agama
    Route::resource('agama', AgamaController::class)->only(['index', 'store', 'update', 'destroy']);

    // Pendidikan
    Route::resource('pendidikan', PendidikanController::class)->only(['index', 'store', 'update', 'destroy']);
});


/*
|--------------------------------------------------------------------------
| Wali Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'wali'])->prefix('wali')->name('wali.')->group(function () {
    Route::get('/dashboard', [WaliController::class, 'dashboard'])->name('dashboard');
});
