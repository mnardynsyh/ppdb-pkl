<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Menghapus tabel orang_tua_wali.
     */
    public function up(): void
    {
        Schema::dropIfExists('orang_tua_wali');
    }

    /**
     * Reverse the migrations.
     * Membuat kembali tabel orang_tua_wali (jika di-rollback).
     */
    public function down(): void
    {
        Schema::create('orang_tua_wali', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            
            // Data Ayah
            $table->string('nama_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('no_hp_ayah', 20)->nullable();

            // Data Ibu
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('no_hp_ibu', 20)->nullable();

            // Data Wali
            $table->string('nama_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('no_hp_wali', 20)->nullable();

            $table->timestamps();
        });
    }
};