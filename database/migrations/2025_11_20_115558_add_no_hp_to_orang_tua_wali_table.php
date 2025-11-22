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
        Schema::table('orang_tua_wali', function (Blueprint $table) {

            $table->string('no_hp_ayah', 20)->nullable()->after('pekerjaan_ayah');

            // Menambahkan kolom No HP Ibu
            $table->string('no_hp_ibu', 20)->nullable()->after('pekerjaan_ibu');

            // Menambahkan kolom No HP Wali
            $table->string('no_hp_wali', 20)->nullable()->after('pekerjaan_wali');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orang_tua_wali', function (Blueprint $table) {
            // Menghapus kolom jika di-rollback
            $table->dropColumn(['no_hp_ayah', 'no_hp_ibu', 'no_hp_wali']);
        });
    }
};