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
    Schema::create('siswa', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')
              ->constrained('users')
              ->onDelete('cascade');

        $table->string('nama_lengkap');
        $table->string('nik')->unique();
        $table->string('nisn')->unique();
        $table->date('tanggal_lahir')->nullable();
        
        $table->enum('agama', ['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'])
              ->nullable();
              
        $table->string('tempat_lahir')->nullable();
        $table->enum('jenis_kelamin', ['L', 'P']);
        $table->text('alamat')->nullable();

        // Wilayah
        $table->char('provinsi_id', 2);
        $table->char('kabupaten_id', 4);
        $table->char('kecamatan_id', 7);
        $table->char('desa_id', 10);

        $table->integer('anak_ke')->nullable();

        $table->enum('status_pendaftaran', ['Pending', 'Diterima', 'Ditolak'])
              ->default('Pending');

        // $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
