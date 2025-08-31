<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $siswaRoleId = DB::table('roles')->where('name', 'siswa')->value('id') ?? 2;
        // Pastikan ada agama dengan id = 1, atau sesuaikan agama_id
        DB::table('siswa')->insert([
            [
                'email' => 'siswa1@example.com',
                'password' => Hash::make('password123'),
                'nama_lengkap' => 'Siswa Satu',
                'nik' => '1234567890123456',
                'nisn' => '1234567890',
                'tanggal_lahir' => '2005-01-01',
                'tempat_lahir' => 'Jakarta',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Contoh No.1',
                'asal_sekolah' => 'SMP Contoh',
                'anak_ke' => 1,
                'agama_id' => 1,
                'tahun_lulus' => 2023,
                'pas_foto' => null,
                'role_id' => $siswaRoleId,
                'status_pendaftaran' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
