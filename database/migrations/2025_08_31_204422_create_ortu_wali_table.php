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
        Schema::create('orang_tua_wali', function (Blueprint $table) {
            $table->id();
            
            // Foreign key ke tabel siswa (relasi one-to-one)
            $table->unsignedBigInteger('siswa_id')->unique();

            // Data Ayah
            $table->string('nama_ayah');
            $table->string('nik_ayah')->unique();
            $table->string('tempat_lahir_ayah');
            $table->date('tanggal_lahir_ayah');
            $table->unsignedBigInteger('pekerjaan_ayah_id');
            $table->unsignedBigInteger('penghasilan_ayah_id');
            $table->unsignedBigInteger('pendidikan_ayah_id');
            $table->unsignedBigInteger('agama_ayah_id');

            // Data Ibu
            $table->string('nama_ibu');
            $table->string('nik_ibu')->unique();
            $table->string('tempat_lahir_ibu');
            $table->date('tanggal_lahir_ibu');
            $table->unsignedBigInteger('pekerjaan_ibu_id');
            $table->unsignedBigInteger('penghasilan_ibu_id');
            $table->unsignedBigInteger('pendidikan_ibu_id');
            $table->unsignedBigInteger('agama_ibu_id');

            // Data Wali (Opsional)
            $table->string('nama_wali')->nullable();
            $table->string('nik_wali')->unique()->nullable();
            $table->string('tempat_lahir_wali')->nullable();
            $table->date('tanggal_lahir_wali')->nullable();
            $table->unsignedBigInteger('pekerjaan_wali_id')->nullable();
            $table->unsignedBigInteger('penghasilan_wali_id')->nullable();
            $table->unsignedBigInteger('pendidikan_wali_id')->nullable();
            $table->unsignedBigInteger('agama_wali_id')->nullable();

            $table->timestamps();

            // Definisi Foreign Key Constraints
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');

            $table->foreign('pekerjaan_ayah_id')->references('id')->on('job')->onDelete('cascade');
            $table->foreign('penghasilan_ayah_id')->references('id')->on('penghasilan')->onDelete('cascade');
            $table->foreign('pendidikan_ayah_id')->references('id')->on('pendidikan')->onDelete('cascade');
            $table->foreign('agama_ayah_id')->references('id')->on('agama')->onDelete('cascade');

            $table->foreign('pekerjaan_ibu_id')->references('id')->on('job')->onDelete('cascade');
            $table->foreign('penghasilan_ibu_id')->references('id')->on('penghasilan')->onDelete('cascade');
            $table->foreign('pendidikan_ibu_id')->references('id')->on('pendidikan')->onDelete('cascade');
            $table->foreign('agama_ibu_id')->references('id')->on('agama')->onDelete('cascade');

            $table->foreign('pekerjaan_wali_id')->references('id')->on('job')->onDelete('cascade');
            $table->foreign('penghasilan_wali_id')->references('id')->on('penghasilan')->onDelete('cascade');
            $table->foreign('pendidikan_wali_id')->references('id')->on('pendidikan')->onDelete('cascade');
            $table->foreign('agama_wali_id')->references('id')->on('agama')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ortu_wali');
    }
};
