<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        // Memilih tabel 'job' untuk dimodifikasi
        Schema::table('job', function (Blueprint $table) {
            // Mengubah nama kolom 'id' menjadi 'id_job'
            $table->renameColumn('id', 'id_job');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        // Memilih tabel 'job' untuk dimodifikasi
        Schema::table('job', function (Blueprint $table) {
            // Mengembalikan nama kolom 'id_job' menjadi 'id'
            $table->renameColumn('id_job', 'id');
        });
    }
};
