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
        // Tabel Provinsi
        Schema::create('provinsi', function (Blueprint $table) {
            $table->char('id', 2)->primary(); // ID Provinsi (misal: 32)
            $table->string('nama');          // Nama Provinsi (misal: JAWA BARAT)
            // $table->timestamps(); // Opsional
        });

        // Tabel Kabupaten/Kota
        Schema::create('kabupaten', function (Blueprint $table) {
            $table->char('id', 4)->primary(); // ID Kabupaten (misal: 3204)
            $table->char('provinsi_id', 2);   // Foreign key ke tabel provinsi
            $table->string('nama');          // Nama Kabupaten (misal: KABUPATEN BANDUNG)
            // $table->timestamps(); // Opsional

            // Definisi Foreign Key ke provinsi
            $table->foreign('provinsi_id')
                  ->references('id')
                  ->on('provinsi')
                  ->onUpdate('cascade') 
                  ->onDelete('restrict'); 
        });

        // Tabel Kecamatan
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->char('id', 7)->primary(); // ID Kecamatan (misal: 3204050)
            $table->char('kabupaten_id', 4);    // Foreign key ke tabel kabupaten
            $table->string('nama');          // Nama Kecamatan (misal: CICALENGKA)
            // $table->timestamps(); // Opsional

            // Definisi Foreign Key ke kabupaten
            $table->foreign('kabupaten_id')
                  ->references('id')
                  ->on('kabupaten')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });

        // [BARU] Tabel Desa/Kelurahan
        Schema::create('desa', function (Blueprint $table) {
            $table->char('id', 10)->primary(); // ID Desa (misal: 3204050001)
            $table->char('kecamatan_id', 7);    // Foreign key ke tabel kecamatan
            $table->string('nama');          // Nama Desa (misal: CIKANCUNG)
            // $table->timestamps(); // Opsional

             // Definisi Foreign Key ke kecamatan
            $table->foreign('kecamatan_id')
                  ->references('id')
                  ->on('kecamatan')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Urutan drop penting karena ada foreign key
        Schema::dropIfExists('desa'); // [BARU] Hapus desa dulu
        Schema::dropIfExists('kecamatan');
        Schema::dropIfExists('kabupaten');
        Schema::dropIfExists('provinsi');
    }
};

