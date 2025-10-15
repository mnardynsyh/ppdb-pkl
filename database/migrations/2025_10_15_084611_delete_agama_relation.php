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
        $agamaOptions = ['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Buddha', 'Konghucu'];

        // === Perubahan hanya pada tabel 'siswa' ===
        Schema::table('siswa', function (Blueprint $table) use ($agamaOptions) {
            // 1. Tambah kolom enum 'agama' yang baru
            $table->enum('agama', $agamaOptions)->nullable()->after('tanggal_lahir');
            
            // 2. Hapus foreign key constraint dari kolom 'agama_id'
            //    Nama constraint biasanya mengikuti format: nama_tabel_nama_kolom_foreign
            $table->dropForeign(['agama_id']);

            // 3. Hapus kolom 'agama_id' yang lama
            $table->dropColumn('agama_id');
        });

        // Bagian untuk tabel 'orang_tua_wali' telah dihapus untuk sementara
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // === Rollback hanya pada tabel 'siswa' ===
        Schema::table('siswa', function (Blueprint $table) {
            // 1. Hapus kolom 'agama' yang baru
            $table->dropColumn('agama');

            // 2. Buat kembali kolom 'agama_id' yang lama
            $table->unsignedBigInteger('agama_id')->nullable();

            // 3. Buat kembali foreign key constraint
            $table->foreign('agama_id')->references('id')->on('agama')->onDelete('set null');
        });

        // Bagian untuk tabel 'orang_tua_wali' telah dihapus untuk sementara
    }
};

