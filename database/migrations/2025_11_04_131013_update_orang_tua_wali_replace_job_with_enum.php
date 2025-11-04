<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi: ubah kolom pekerjaan di tabel orang_tua_wali.
     */
    public function up(): void
    {
        Schema::table('orang_tua_wali', function (Blueprint $table) {
            // Hapus foreign key (jika ada) sebelum menghapus kolom ID pekerjaan
            if (Schema::hasColumn('orang_tua_wali', 'pekerjaan_ayah_id')) {
                $table->dropForeign(['pekerjaan_ayah_id']);
                $table->dropColumn('pekerjaan_ayah_id');
            }
            if (Schema::hasColumn('orang_tua_wali', 'pekerjaan_ibu_id')) {
                $table->dropForeign(['pekerjaan_ibu_id']);
                $table->dropColumn('pekerjaan_ibu_id');
            }
            if (Schema::hasColumn('orang_tua_wali', 'pekerjaan_wali_id')) {
                $table->dropForeign(['pekerjaan_wali_id']);
                $table->dropColumn('pekerjaan_wali_id');
            }

            // Tambahkan kolom enum pekerjaan ayah
            $table->enum('pekerjaan_ayah', [
                'Tidak Bekerja',
                'Petani',
                'Buruh',
                'Pedagang',
                'Pegawai Negeri Sipil (PNS)',
                'Pegawai Swasta',
                'Guru/Dosen',
                'Wiraswasta',
                'TNI/Polri',
                'Pensiunan',
                'Lainnya'
            ])->after('tanggal_lahir_ayah');

            $table->string('pekerjaan_ayah_lainnya', 100)->nullable()->after('pekerjaan_ayah');

            // Tambahkan kolom enum pekerjaan ibu
            $table->enum('pekerjaan_ibu', [
                'Tidak Bekerja',
                'Petani',
                'Buruh',
                'Pedagang',
                'Pegawai Negeri Sipil (PNS)',
                'Pegawai Swasta',
                'Guru/Dosen',
                'Wiraswasta',
                'TNI/Polri',
                'Pensiunan',
                'Lainnya'
            ])->after('tanggal_lahir_ibu');

            $table->string('pekerjaan_ibu_lainnya', 100)->nullable()->after('pekerjaan_ibu');

            // Tambahkan kolom enum pekerjaan wali (optional)
            $table->enum('pekerjaan_wali', [
                'Tidak Bekerja',
                'Petani',
                'Buruh',
                'Pedagang',
                'Pegawai Negeri Sipil (PNS)',
                'Pegawai Swasta',
                'Guru/Dosen',
                'Wiraswasta',
                'TNI/Polri',
                'Pensiunan',
                'Lainnya'
            ])->nullable()->after('tanggal_lahir_wali');

            $table->string('pekerjaan_wali_lainnya', 100)->nullable()->after('pekerjaan_wali');
        });

        // Hapus tabel job jika sudah tidak dipakai
        Schema::dropIfExists('job');
    }

    /**
     * Undo migrasi: kembalikan ke kondisi sebelumnya.
     */
    public function down(): void
    {
        Schema::table('orang_tua_wali', function (Blueprint $table) {
            // Hapus kolom enum baru
            $table->dropColumn([
                'pekerjaan_ayah',
                'pekerjaan_ayah_lainnya',
                'pekerjaan_ibu',
                'pekerjaan_ibu_lainnya',
                'pekerjaan_wali',
                'pekerjaan_wali_lainnya',
            ]);

            // Kembalikan kolom ID pekerjaan (jika rollback)
            $table->unsignedBigInteger('pekerjaan_ayah_id')->nullable();
            $table->unsignedBigInteger('pekerjaan_ibu_id')->nullable();
            $table->unsignedBigInteger('pekerjaan_wali_id')->nullable();
        });

        // Kembalikan tabel job
        Schema::create('job', function (Blueprint $table) {
            $table->id();
            $table->string('pekerjaan', 100);
            $table->timestamps();
        });
    }
};
