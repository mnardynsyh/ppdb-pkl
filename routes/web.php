<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Wali\DashboardWali;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\AgamaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PendidikanController;
use App\Http\Controllers\Admin\PenghasilanController;

/*
|--------------------------------------------------------------------------
| Public Routes (Guest Only)
|--------------------------------------------------------------------------
*/

// Guest routes (hanya bisa diakses kalau belum login)
Route::middleware('guest')->group(function () {
    // Landing page
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Login untuk admin & siswa
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

    // Registrasi siswa
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('siswa.register');
    Route::post('/register', [AuthController::class, 'register'])->name('siswa.register.submit');

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
Route::middleware(['siswa'])->prefix('wali')->name('wali.')->group(function () {
    Route::get('/dashboard', [DashboardWali::class, 'index'])->name('dashboard');
});



