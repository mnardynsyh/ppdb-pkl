<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            if (Schema::hasColumn('siswa', 'asal_sekolah')) {
                $table->dropColumn('asal_sekolah');
            }

            if (Schema::hasColumn('siswa', 'alamat_sekolah_asal')) {
                $table->dropColumn('alamat_sekolah_asal');
            }

            if (Schema::hasColumn('siswa', 'tahun_lulus')) {
                $table->dropColumn('tahun_lulus');
            }
        });
    }

    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->string('asal_sekolah')->nullable();
            $table->text('alamat_sekolah_asal')->nullable();
            $table->year('tahun_lulus')->nullable();
        });
    }
};
