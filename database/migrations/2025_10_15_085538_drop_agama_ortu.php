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

        Schema::table('orang_tua_wali', function (Blueprint $table) use ($agamaOptions) {
            // 1. Tambah kolom enum baru
            $table->enum('agama_ayah', $agamaOptions)->nullable()->after('pendidikan_ayah_id');
            $table->enum('agama_ibu', $agamaOptions)->nullable()->after('pendidikan_ibu_id');
            $table->enum('agama_wali', $agamaOptions)->nullable()->after('pendidikan_wali_id');

            // 2. Hapus foreign key constraints
            $table->dropForeign(['agama_ayah_id']);
            $table->dropForeign(['agama_ibu_id']);
            $table->dropForeign(['agama_wali_id']);

            // 3. Hapus kolom lama
            $table->dropColumn(['agama_ayah_id', 'agama_ibu_id', 'agama_wali_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orang_tua_wali', function (Blueprint $table) {
            // 1. Hapus kolom enum yang baru
            $table->dropColumn(['agama_ayah', 'agama_ibu', 'agama_wali']);

            // 2. Buat kembali kolom-kolom id yang lama
            $table->unsignedBigInteger('agama_ayah_id')->nullable();
            $table->unsignedBigInteger('agama_ibu_id')->nullable();
            $table->unsignedBigInteger('agama_wali_id')->nullable();

            // 3. Buat kembali foreign key constraints
            $table->foreign('agama_ayah_id')->references('id')->on('agama')->onDelete('set null');
            $table->foreign('agama_ibu_id')->references('id')->on('agama')->onDelete('set null');
            $table->foreign('agama_wali_id')->references('id')->on('agama')->onDelete('set null');
        });
    }
};
