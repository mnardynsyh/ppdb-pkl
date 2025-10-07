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
        $table->char('provinsi_id', 2)->nullable()->after('alamat');
        $table->char('kabupaten_id', 4)->nullable()->after('provinsi_id');
        $table->char('kecamatan_id', 7)->nullable()->after('kabupaten_id');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            //
        });
    }
};
