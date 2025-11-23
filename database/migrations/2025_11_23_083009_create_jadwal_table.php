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
    Schema::create('jadwal', function (Blueprint $table) {
        $table->id();

        // Judul kegiatan (misal: "Pendaftaran Gelombang 1")
        $table->string('title');

        // Rentang tanggal (string)
        // Disimpan sebagai string sesuai SQL Anda (misal: "01 - 10 Juli 2025")
        $table->string('date_range');

        // Deskripsi kegiatan
        $table->text('description');

        // Urutan tampilan
        // unsignedInteger sama dengan int UNSIGNED
        $table->unsignedInteger('order')->default(0);

        // $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
