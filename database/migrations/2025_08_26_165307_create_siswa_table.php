<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nama_lengkap');
            $table->string('nik')->unique();
            $table->string('nisn')->unique();
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat');
            $table->string('asal_sekolah');
            $table->integer('anak_ke')->nullable();
            $table->unsignedBigInteger('agama_id'); // Foreign key ke tabel agama
            $table->year('tahun_lulus')->nullable();
            $table->string('pas_foto')->nullable();
            $table->enum('status_pendaftaran', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();

            // Relasi ke tabel agama
            $table->foreign('agama_id')->references('id')->on('agama')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Rollback migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
