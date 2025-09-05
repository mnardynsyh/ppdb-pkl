<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            // Menambahkan kolom status_pendaftaran setelah kolom pas_foto
            // ENUM untuk membatasi nilai yang bisa dimasukkan
            // Default 'pending' untuk setiap pendaftar baru
            $table->enum('status_pendaftaran', ['pending', 'diterima', 'ditolak'])
                  ->default('pending')
                  ->after('pas_foto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            // Hapus kolom jika migrasi di-rollback
            $table->dropColumn('status_pendaftaran');
        });
    }
};
