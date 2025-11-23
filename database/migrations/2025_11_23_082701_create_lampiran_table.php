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
    Schema::create('lampiran', function (Blueprint $table) {
        $table->id();

        // Relasi ke tabel siswa
        // Jika data siswa dihapus, data file lampirannya di database juga dihapus
        $table->foreignId('siswa_id')
              ->constrained('siswa')
              ->onDelete('cascade');

        // Jenis berkas (misal: 'KK', 'Akta', 'Ijazah', 'Foto')
        $table->string('jenis_berkas');

        // Lokasi penyimpanan file di folder storage (generated filename)
        $table->string('path_file');

        // Nama asli file saat diupload user (agar saat download namanya user-friendly)
        $table->string('nama_file_asli')->nullable();

        // $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lampiran');
    }
};
