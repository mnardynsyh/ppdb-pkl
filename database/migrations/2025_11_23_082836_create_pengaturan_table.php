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
    Schema::create('pengaturan', function (Blueprint $table) {
        $table->id();

        // tahun_ajaran varchar(20) DEFAULT NULL
        $table->string('tahun_ajaran', 20)->nullable();

        // status enum('Dibuka','Ditutup') NOT NULL DEFAULT 'Ditutup'
        $table->enum('status', ['Dibuka', 'Ditutup'])->default('Ditutup');

        // tanggal_buka date DEFAULT NULL
        $table->date('tanggal_buka')->nullable();

        // tanggal_tutup date DEFAULT NULL
        $table->date('tanggal_tutup')->nullable();

        // alamat_sekolah text
        // Saya set nullable() karena di SQL Anda tidak ada 'NOT NULL'
        $table->text('alamat_sekolah')->nullable();

        // telepon varchar(255) DEFAULT NULL
        $table->string('telepon')->nullable();

        // email varchar(255) DEFAULT NULL
        $table->string('email')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan');
    }
};
