<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            // Menambahkan kolom baru 'alamat_sekolah_asal' setelah kolom 'asal_sekolah'
            // Dibuat nullable() agar tidak error pada data yang sudah ada.
            $table->text('alamat_sekolah_asal')->nullable()->after('asal_sekolah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            // Menghapus kolom jika migrasi di-rollback
            $table->dropColumn('alamat_sekolah_asal');
        });
    }
};
