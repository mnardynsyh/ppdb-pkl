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
        Schema::create('lampiran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');

            // Kolom untuk menyimpan jenis berkas, misal: 'kartu_keluarga', 'akta_kelahiran', 'ijazah'
            // Ini memungkinkan Anda untuk dengan mudah mengelola berbagai jenis dokumen.
            $table->string('jenis_berkas');
            
            // Kolom untuk menyimpan path file di dalam direktori storage Anda.
            $table->string('path_file');
            
            // Kolom untuk menyimpan nama asli file saat diunggah oleh pengguna (opsional, tapi berguna).
            $table->string('nama_file_asli')->nullable();

            $table->timestamps();

            // Definisi Foreign Key ke tabel siswa.
            // Jika data siswa dihapus, semua berkas terkait juga akan terhapus.
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
            
            // Menambahkan unique constraint.
            // Ini memastikan bahwa satu siswa hanya bisa mengunggah satu jenis berkas yang sama.
            // Contoh: Siswa ID 1 hanya bisa punya satu 'kartu_keluarga'.
            $table->unique(['siswa_id', 'jenis_berkas']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas_lampiran');
    }
};
