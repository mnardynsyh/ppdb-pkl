<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PendaftaranController;
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
    Route::get('/jadwal', [HomeController::class, 'jadwal'])->name('jadwal');
    Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');
});

Route::get('/login', [SiswaAuth::class, 'showLoginForm'])->middleware('guest:siswa')->name('login');


/*
|--------------------------------------------------------------------------
| Route Siswa
|--------------------------------------------------------------------------
*/
Route::prefix('siswa')->name('siswa.')->group(function () {
    // Rute guest
    Route::middleware('guest:siswa')->controller(SiswaAuth::class)->group(function () {
        Route::get('/register', 'showRegisterForm')->name('register');
        Route::post('/register', 'register')->name('register.submit');
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login')->name('login.submit');
    });

    // Rute siswa yang sudah login
    Route::middleware('auth:siswa')->group(function () {
        Route::post('/logout', [SiswaAuth::class, 'logout'])->name('logout');
        
        Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('dashboard');
        
        Route::get('/formulir-pendaftaran', [SiswaDashboard::class, 'showForm'])->name('formulir');
        Route::post('/formulir-pendaftaran', [SiswaDashboard::class, 'store'])->name('formulir.store');

        Route::get('/status-pendaftaran', [SiswaDashboard::class, 'showStatus'])->name('status');

        // Rute untuk profil siswa
        Route::prefix('profil')->name('profil.')->controller(ProfileController::class)->group(function () {
            Route::get('/', 'edit')->name('edit');
            Route::put('/', 'update')->name('update');
        });
        
        
        Route::get('/cetak-bukti', [SiswaDashboard::class, 'cetakBukti'])->name('cetak-bukti');
    });
});

Route::get('/wilayah/kabupaten', [WilayahController::class, 'getKabupaten'])->name('wilayah.kabupaten');
Route::get('/wilayah/kecamatan', [WilayahController::class, 'getKecamatan'])->name('wilayah.kecamatan');
Route::get('/wilayah/desa', [WilayahController::class, 'getDesa'])->name('wilayah.desa');


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
        
        Route::resource('jadwal', JadwalController::class)->only(['index', 'store', 'update', 'destroy']);

        Route::prefix('pendaftaran')->name('pendaftaran.')->controller(PendaftaranController::class)->group(function () {
            Route::get('/masuk', 'masuk')->name('masuk');
            Route::get('/diterima', 'diterima')->name('diterima');
            Route::get('/ditolak', 'ditolak')->name('ditolak');
            Route::get('/semua', 'semuaPendaftar')->name('semua');
            Route::get('/{siswa}/detail', 'detail')->name('detail');

            // Route untuk Aksi Perubahan Status
            Route::patch('/{siswa}/terima', 'terima')->name('terima');
            Route::patch('/{siswa}/tolak', 'tolak')->name('tolak');
            Route::patch('/{siswa}/batalkan', 'batalkan')->name('batalkan');

            Route::get('/export', 'exportExcel')->name('export');
        });

        Route::prefix('pengaturan')->name('pengaturan.')->controller(PengaturanController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::put('/', 'update')->name('update');
            Route::post('/jadwal', 'storeJadwal')->name('jadwal.store');
            Route::put('/jadwal/{jadwal}', 'updateJadwal')->name('jadwal.update');
            Route::delete('/jadwal/{jadwal}', 'destroyJadwal')->name('jadwal.destroy');
        });

        Route::prefix('profil')->name('profil.')->controller(ProfileController::class)->group(function () {
            Route::get('/', 'edit')->name('edit');
            Route::put('/', 'update')->name('update');
        });
    });
});

