<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\AgamaController;
use App\Http\Controllers\Admin\PendidikanController;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Controllers\Admin\PenghasilanController;
use App\Http\Controllers\Admin\AuthController as AdminAuth;
use App\Http\Controllers\Siswa\AuthController as SiswaAuth;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;

/*
|--------------------------------------------------------------------------
| Rute Publik (Guest)
|--------------------------------------------------------------------------
*/
Route::middleware(['guest:web', 'guest:siswa'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

Route::get('/login', [SiswaAuth::class, 'showLoginForm'])->middleware('guest:siswa')->name('login');


/*
|--------------------------------------------------------------------------
| Route Siswa
|--------------------------------------------------------------------------
*/
Route::name('siswa.')->group(function () {
    // jika belum login sebagai siswa
    Route::middleware('guest:siswa')->controller(SiswaAuth::class)->group(function () {
        Route::get('/register', 'showRegisterForm')->name('register');
        Route::post('/register', 'register')->name('register.submit');
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login')->name('login.submit');
    });

    // jika sudah login sebagai siswa
    Route::middleware('auth:siswa')->group(function () {
        Route::post('/logout', [SiswaAuth::class, 'logout'])->name('logout');
        
        // Route untuk menampilkan halaman dashboard (form)
        Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('dashboard');

        // Route untuk menyimpan data dari form pendaftaran
        Route::post('/dashboard', [SiswaDashboard::class, 'store'])->name('dashboard.store');
    });
});



/*
|--------------------------------------------------------------------------
| Route Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // jika belum login sebagai admin
    Route::middleware('guest:web')->controller(AdminAuth::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login')->name('login.submit');
    });

    // jika sudah login sebagai admin
    Route::middleware('auth:web')->group(function () {
        Route::post('/logout', [AdminAuth::class, 'logout'])->name('logout');
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
        
        Route::resource('job', JobController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('penghasilan', PenghasilanController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('agama', AgamaController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('pendidikan', PendidikanController::class)->only(['index', 'store', 'update', 'destroy']);

        Route::prefix('pendaftaran')->name('pendaftaran.')->controller(PendaftaranController::class)->group(function () {
            Route::get('/masuk', 'masuk')->name('masuk');
            Route::get('/diterima', 'diterima')->name('diterima');
            Route::get('/ditolak', 'ditolak')->name('ditolak');
            Route::post('/{siswa}/terima', 'prosesTerima')->name('terima');
            Route::post('/{siswa}/tolak', 'prosesTolak')->name('tolak');
            Route::post('/{siswa}/kembalikan', 'kembalikanKePending')->name('kembalikan');
        });
    });
});

