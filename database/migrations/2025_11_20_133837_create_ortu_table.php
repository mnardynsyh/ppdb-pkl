<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orang_tua', function (Blueprint $table) {
            $table->id();

            // Relasi ke siswa
            $table->foreignId('siswa_id')
                ->constrained('siswa')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Ayah / Ibu / Wali
            $table->enum('hubungan', ['Ayah', 'Ibu', 'Wali']);

            // Data pribadi
            $table->string('nama_lengkap');
            $table->string('nik', 16)->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();

            // ENUM pendidikan terakhir
            $table->enum('pendidikan_terakhir', [
                'Tidak Sekolah',
                'SD/Sederajat',
                'SMP/Sederajat',
                'SMA/Sederajat',
                'Diploma (D1/D2/D3)',
                'Sarjana (S1)',
                'Magister (S2)',
                'Doktor (S3)',
            ])->nullable();

            // ENUM pekerjaan
            $table->enum('pekerjaan', [
                'PNS',
                'TNI/POLRI',
                'Karyawan Swasta',
                'Wiraswasta',
                'Petani',
                'Buruh',
                'Guru/Dosen',
                'Nelayan',
                'Tidak Bekerja',
                'Lainnya'
            ])->nullable();

            // ENUM penghasilan bulanan
            $table->enum('penghasilan_bulanan', [
                '< Rp 1 juta',
                'Rp 1–3 juta',
                'Rp 3–5 juta',
                '> Rp 5 juta',
                'Tidak Berpenghasilan'
            ])->nullable();

            // Kontak opsional
            $table->string('no_hp', 20)->nullable();

            // Alamat opsional (jika beda dengan siswa)
            $table->text('alamat')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orang_tua');
    }
};
