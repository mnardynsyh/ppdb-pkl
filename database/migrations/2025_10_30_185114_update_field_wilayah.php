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
        Schema::table('siswa', function (Blueprint $table) {
            // 1. Tambahkan kolom-kolom baru
            $table->char('provinsi_id', 2)->nullable()->after('alamat');
            $table->char('kabupaten_id', 4)->nullable()->after('provinsi_id');
            $table->char('kecamatan_id', 7)->nullable()->after('kabupaten_id');
            $table->char('desa_id', 10)->nullable()->after('kecamatan_id'); // [BARU] Menambahkan kolom desa

            // 2. Definisikan foreign key constraints
            // Pastikan tabel (provinsi, kabupaten, dll.) sudah ada dari migrasi sebelumnya
            $table->foreign('provinsi_id')
                  ->references('id')
                  ->on('provinsi')
                  ->onUpdate('cascade')
                  ->onDelete('set null'); // Set NULL jika provinsi terhapus

            $table->foreign('kabupaten_id')
                  ->references('id')
                  ->on('kabupaten')
                  ->onUpdate('cascade')
                  ->onDelete('set null');

            $table->foreign('kecamatan_id')
                  ->references('id')
                  ->on('kecamatan')
                  ->onUpdate('cascade')
                  ->onDelete('set null');

            $table->foreign('desa_id')
                  ->references('id')
                  ->on('desa')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            // 1. Hapus foreign key terlebih dahulu (urutan penting)
            $table->dropForeign(['desa_id']);
            $table->dropForeign(['kecamatan_id']);
            $table->dropForeign(['kabupaten_id']);
            $table->dropForeign(['provinsi_id']);

            // 2. Hapus kolom-kolom
            $table->dropColumn(['desa_id', 'kecamatan_id', 'kabupaten_id', 'provinsi_id']);
        });
    }
};
