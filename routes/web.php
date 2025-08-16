<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\PenghasilanController;
use App\Http\Controllers\Admin\AgamaController;
use App\Http\Controllers\Admin\PendidikanController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard');
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Proses login
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // CRUD Job
    Route::get('/job', [JobController::class, 'index'])->name('job.index');
    Route::post('/job', [JobController::class, 'store'])->name('job.store');
    Route::put('/job/{job}', [JobController::class, 'update'])->name('job.update');
    Route::delete('/job/{job}', [JobController::class, 'destroy'])->name('job.destroy');

    // CRUD Penghasilan
    Route::get('/penghasilan', [PenghasilanController::class, 'index'])->name('penghasilan.index');
    Route::post('/penghasilan', [PenghasilanController::class, 'store'])->name('penghasilan.store');
    Route::put('/penghasilan/{id}', [PenghasilanController::class, 'update'])->name('penghasilan.update');
    Route::delete('/penghasilan/{id}', [PenghasilanController::class, 'destroy'])->name('penghasilan.destroy');
    
    // CRUD Agama
    Route::get('/agama', [AgamaController::class, 'index'])->name('agama.index');
    Route::post('/agama', [AgamaController::class, 'store'])->name('agama.store');
    Route::put('/agama/{id}', [AgamaController::class, 'update'])->name('agama.update');
    Route::delete('/agama/{id}', [AgamaController::class, 'destroy'])->name('agama.destroy');

    // CRUD Pendidikan
    Route::get('/pendidikan', [PendidikanController::class, 'index'])->name('pendidikan.index');
    Route::post('/pendidikan', [PendidikanController::class, 'store'])->name('pendidikan.store');
    Route::put('/pendidikan/{id}', [PendidikanController::class, 'update'])->name('pendidikan.update');
    Route::delete('/pendidikan/{id}', [PendidikanController::class, 'destroy'])->name('pendidikan.destroy');

});


// Student Dashboard
Route::middleware('student')->group(function () {
    Route::get('student/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');
});
