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
        // [BARU] Definisikan opsi pendidikan untuk kolom enum
        $pendidikanOptions = [
            'Tidak Sekolah',
            'SD/Sederajat',
            'SMP/Sederajat',
            'SMA/Sederajat',
            'Diploma (D1/D2/D3)',
            'Sarjana (S1)',
            'Magister (S2)',
            'Doktor (S3)',
            'Lainnya'
        ];

        Schema::table('orang_tua_wali', function (Blueprint $table) use ($pendidikanOptions) {
            // 1. Tambah kolom enum pendidikan baru
            $table->enum('pendidikan_ayah', $pendidikanOptions)->nullable()->after('penghasilan_ayah_id');
            $table->enum('pendidikan_ibu', $pendidikanOptions)->nullable()->after('penghasilan_ibu_id');
            $table->enum('pendidikan_wali', $pendidikanOptions)->nullable()->after('penghasilan_wali_id');

            // 2. Hapus foreign key constraints
            //    Pastikan nama constraint sesuai (biasanya: nama_tabel_nama_kolom_foreign)
            $table->dropForeign(['pendidikan_ayah_id']);
            $table->dropForeign(['pendidikan_ibu_id']);
            $table->dropForeign(['pendidikan_wali_id']);

            // 3. Hapus kolom id pendidikan yang lama
            $table->dropColumn(['pendidikan_ayah_id', 'pendidikan_ibu_id', 'pendidikan_wali_id']);
        });

        // 4. Hapus tabel 'pendidikan'
        Schema::dropIfExists('pendidikan');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Buat kembali tabel 'pendidikan'
        Schema::create('pendidikan', function (Blueprint $table) {
            $table->id();
            $table->string('pendidikan');
            $table->timestamps(); // Asumsi ada timestamps
        });

        Schema::table('orang_tua_wali', function (Blueprint $table) {
            // 2. Hapus kolom enum pendidikan yang baru
            $table->dropColumn(['pendidikan_ayah', 'pendidikan_ibu', 'pendidikan_wali']);

            // 3. Tambah kembali kolom id pendidikan yang lama
            $table->unsignedBigInteger('pendidikan_ayah_id')->nullable();
            $table->unsignedBigInteger('pendidikan_ibu_id')->nullable();
            $table->unsignedBigInteger('pendidikan_wali_id')->nullable();

            // 4. Tambah kembali foreign key constraints
            $table->foreign('pendidikan_ayah_id')->references('id')->on('pendidikan')->onDelete('set null');
            $table->foreign('pendidikan_ibu_id')->references('id')->on('pendidikan')->onDelete('set null');
            $table->foreign('pendidikan_wali_id')->references('id')->on('pendidikan')->onDelete('set null');
        });
    }
};
