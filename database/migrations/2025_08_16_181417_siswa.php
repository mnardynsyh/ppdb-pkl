<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->foreignId('id_wali')->constrained('wali')->onDelete('cascade');
            
            $table->string('nama_siswa');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat')->nullable();

            // Relasi ke tabel referensi
            $table->foreignId('id_pendidikan')->nullable()->constrained('pendidikan')->nullOnDelete();
            $table->foreignId('id_pekerjaan')->nullable()->constrained('pekerjaan')->nullOnDelete();
            $table->foreignId('id_penghasilan')->nullable()->constrained('penghasilan')->nullOnDelete();
            $table->foreignId('id_agama')->nullable()->constrained('agama')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
