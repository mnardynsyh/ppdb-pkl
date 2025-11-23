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
    Schema::create('sekolah_asal', function (Blueprint $table) {
        $table->id();
        $table->foreignId('siswa_id')
              ->constrained('siswa')
              ->onDelete('cascade');

        $table->string('nama_sekolah');

        $table->text('alamat_sekolah')->nullable();
        $table->year('tahun_lulus')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolah_asal');
    }
};
