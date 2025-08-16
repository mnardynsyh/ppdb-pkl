<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('siswa')->insert([
            [
                'id_wali'        => 1, // pastikan wali dengan id 1 sudah ada
                'nama_siswa'     => 'Budi Santoso',
                'tanggal_lahir'  => '2010-05-12',
                'tempat_lahir'   => 'Jakarta',
                'jenis_kelamin'  => 'L',
                'alamat'         => 'Jl. Melati No. 45, Jakarta',
                'id_pendidikan'  => null,
                'id_pekerjaan'   => null,
                'id_penghasilan' => null,
                'id_agama'       => null,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'id_wali'        => 2,
                'nama_siswa'     => 'Siti Aminah',
                'tanggal_lahir'  => '2012-08-21',
                'tempat_lahir'   => 'Bandung',
                'jenis_kelamin'  => 'P',
                'alamat'         => 'Jl. Melati No. 45, Jakarta',
                'id_pendidikan'  => null,
                'id_pekerjaan'   => null,
                'id_penghasilan' => null,
                'id_agama'       => null,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
