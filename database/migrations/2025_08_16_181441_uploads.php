<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_siswa')->constrained('siswa')->onDelete('cascade');
            $table->string('jenis_dokumen'); // KK, Akta, Foto, dll
            $table->string('path_file');    // lokasi file
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};
