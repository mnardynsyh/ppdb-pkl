<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Pengaturan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Mengatur default string length (opsional, untuk kompatibilitas DB lama)
        Schema::defaultStringLength(191);

        // LOGIKA UNTUK SHARE DATA PENGATURAN KE SEMUA VIEW
        try {
            // Cek apakah tabel pengaturan sudah ada (agar tidak error saat migrate fresh)
            if (Schema::hasTable('pengaturan')) {
                $pengaturan = Pengaturan::first();
                
                // Ambil tahun ajaran, jika null gunakan default tahun sekarang
                $tahunAjaran = $pengaturan->tahun_ajaran ?? date('Y').'/'.(date('Y')+1);
                
                // Bagikan variabel $tahun_ajaran ke seluruh view blade
                View::share('tahun_ajaran', $tahunAjaran);
                
                // Opsional: Bagikan seluruh objek pengaturan jika ingin akses status pendaftaran dll
                View::share('global_pengaturan', $pengaturan);
            }
        } catch (\Exception $e) {
            // Fallback jika terjadi error koneksi database dll
            View::share('tahun_ajaran', date('Y').'/'.(date('Y')+1));
        }
    }
}