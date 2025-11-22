<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WilayahController;

// AUTH
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Admin
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Controllers\Admin\ProfileController as AdminProfile;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;

// Siswa
use App\Http\Controllers\Siswa\ProfilController as SiswaProfile;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;


/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jadwal', [HomeController::class, 'jadwal'])->name('jadwal');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');


/*
|--------------------------------------------------------------------------
| LOGIN (Admin & Siswa)
|--------------------------------------------------------------------------
*/
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    // Registrasi hanya khusus siswa
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.siswa');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.siswa.submit');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| ROUTE SISWA
|--------------------------------------------------------------------------
*/
Route::prefix('siswa')
    ->name('siswa.')
    ->middleware(['auth', 'role:2'])
    ->group(function () {

        Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('dashboard');

        // Formulir
        Route::get('/formulir-pendaftaran', [SiswaDashboard::class, 'showForm'])->name('formulir');
        Route::post('/formulir-pendaftaran', [SiswaDashboard::class, 'store'])->name('formulir.store');

        // Status & cetak
        Route::get('/status-pendaftaran', [SiswaDashboard::class, 'showStatus'])->name('status');
        Route::get('/cetak-bukti', [SiswaDashboard::class, 'cetakBukti'])->name('cetak-bukti');

        // Profil
        Route::prefix('profil')->name('profil.')->controller(SiswaProfile::class)->group(function () {
            Route::get('/', 'edit')->name('edit');
            Route::put('/', 'update')->name('update');
        });
    });


/*
|--------------------------------------------------------------------------
| ROUTE ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:1'])
    ->group(function () {

        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

        // Manajemen Pendaftaran
        Route::prefix('pendaftaran')->name('pendaftaran.')->controller(PendaftaranController::class)->group(function () {
            Route::get('/masuk', 'masuk')->name('masuk');
            Route::get('/diterima', 'diterima')->name('diterima');
            Route::get('/ditolak', 'ditolak')->name('ditolak');
            Route::get('/semua', 'semuaPendaftar')->name('semua');
            Route::get('/{siswa}/detail', 'detail')->name('detail');
            Route::patch('/{siswa}/terima', 'terima')->name('terima');
            Route::patch('/{siswa}/tolak', 'tolak')->name('tolak');
            Route::patch('/{siswa}/batalkan', 'batalkan')->name('batalkan');
            Route::get('/export', 'exportExcel')->name('export');
        });

        // Pengaturan & Jadwal
        Route::controller(PengaturanController::class)->group(function () {
            Route::get('/pengaturan', 'index')->name('pengaturan.index');
            Route::put('/pengaturan', 'update')->name('pengaturan.update');

            Route::post('/jadwal', 'storeJadwal')->name('jadwal.store');
            Route::put('/jadwal/{jadwal}', 'updateJadwal')->name('jadwal.update');
            Route::delete('/jadwal/{jadwal}', 'destroyJadwal')->name('jadwal.destroy');
        });

        // Profil admin
        Route::prefix('profil')->name('profil.')->controller(AdminProfile::class)->group(function () {
            Route::get('/', 'edit')->name('edit');
            Route::put('/', 'update')->name('update');
        });
    });


/*
|--------------------------------------------------------------------------
| API Wilayah
|--------------------------------------------------------------------------
*/
Route::get('/wilayah/kabupaten', [WilayahController::class, 'getKabupaten'])->name('wilayah.kabupaten');
Route::get('/wilayah/kecamatan', [WilayahController::class, 'getKecamatan'])->name('wilayah.kecamatan');
Route::get('/wilayah/desa', [WilayahController::class, 'getDesa'])->name('wilayah.desa');

