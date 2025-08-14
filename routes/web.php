<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobController;

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

    // CRUD Job (pakai modal)
    Route::get('/job', [JobController::class, 'index'])->name('job.index');
    Route::post('/job', [JobController::class, 'store'])->name('job.store');
    Route::put('/job/{id}', [JobController::class, 'update'])->name('job.update');
    Route::delete('/job/{id}', [JobController::class, 'destroy'])->name('job.destroy');
});




// Student Dashboard
Route::middleware('student')->group(function () {
    Route::get('student/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');
});
