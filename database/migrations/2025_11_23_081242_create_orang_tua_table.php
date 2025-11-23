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
    Schema::create('orang_tua', function (Blueprint $table) {
        $table->id();

        $table->foreignId('siswa_id')
              ->constrained('siswa')
              ->onDelete('cascade');

        $table->enum('hubungan', ['Ayah', 'Ibu', 'Wali']);
        
        $table->string('nama_lengkap');
        
        // NIK biasanya 16 digit
        $table->string('nik', 16)->nullable();
        
        $table->string('tempat_lahir')->nullable();
        $table->date('tanggal_lahir')->nullable();

        // Enum Pendidikan
        $table->enum('pendidikan_terakhir', [
            'Tidak Sekolah', 
            'SD/Sederajat', 
            'SMP/Sederajat', 
            'SMA/Sederajat', 
            'Diploma (D1/D2/D3)', 
            'Sarjana (S1)', 
            'Magister (S2)', 
            'Doktor (S3)'
        ])->nullable();

        // Enum Pekerjaan
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
        ])->nullable();

        // Enum Agama (Sesuai SQL Anda ada 'Kristen Protestan')
        $table->enum('agama', [
            'Islam', 
            'Kristen Protestan', 
            'Katholik', 
            'Hindu', 
            'Buddha', 
            'Konghucu'
        ])->nullable();

        // Enum Penghasilan
        $table->enum('penghasilan_bulanan', [
            '< Rp 1 juta', 
            'Rp 1–3 juta', 
            'Rp 3–5 juta', 
            '> Rp 5 juta', 
            'Tidak Berpenghasilan'
        ])->nullable();

        $table->string('no_hp', 20)->nullable();
        $table->text('alamat')->nullable();

        // $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orang_tua');
    }
};
