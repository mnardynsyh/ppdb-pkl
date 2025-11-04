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
        $table->dropForeign(['penghasilan_ayah_id']);
        $table->dropForeign(['penghasilan_ibu_id']);
        $table->dropForeign(['penghasilan_wali_id']);

        $table->dropColumn(['penghasilan_ayah_id', 'penghasilan_ibu_id', 'penghasilan_wali_id']);

        $table->enum('penghasilan_ayah', [
            '< Rp 1 juta',
            'Rp 1–3 juta',
            'Rp 3–5 juta',
            '> Rp 5 juta',
            'Tidak Berpenghasilan'
        ])->after('pekerjaan_ayah_id')->nullable();

        $table->enum('penghasilan_ibu', [
            '< Rp 1 juta',
            'Rp 1–3 juta',
            'Rp 3–5 juta',
            '> Rp 5 juta',
            'Tidak Berpenghasilan'
        ])->after('pekerjaan_ibu_id')->nullable();

        $table->enum('penghasilan_wali', [
            '< Rp 1 juta',
            'Rp 1–3 juta',
            'Rp 3–5 juta',
            '> Rp 5 juta',
            'Tidak Berpenghasilan'
        ])->after('pekerjaan_wali_id')->nullable();
    });

    Schema::dropIfExists('penghasilan');
}

public function down(): void
{
    Schema::create('penghasilan', function (Blueprint $table) {
        $table->id();
        $table->string('penghasilan', 100);
        $table->timestamps();
    });

    Schema::table('orang_tua_wali', function (Blueprint $table) {
        $table->dropColumn(['penghasilan_ayah', 'penghasilan_ibu', 'penghasilan_wali']);
        $table->foreignId('penghasilan_ayah_id')->nullable()->constrained('penghasilan');
        $table->foreignId('penghasilan_ibu_id')->nullable()->constrained('penghasilan');
        $table->foreignId('penghasilan_wali_id')->nullable()->constrained('penghasilan');
    });
}

};
