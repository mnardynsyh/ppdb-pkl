<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sekolah_asal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->string('nama_sekolah');
            $table->text('alamat_sekolah')->nullable();
            $table->year('tahun_lulus')->nullable();
            $table->timestamps();

            // Relation
            $table->foreign('siswa_id')
                  ->references('id')->on('siswa')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sekolah_asal');
    }
};
