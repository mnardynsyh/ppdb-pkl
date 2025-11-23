<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data Jadwal PPDB Simulasi
        $jadwal = [
            [
                'title' => 'Pendaftaran Gelombang 1',
                'date_range' => '01 Maret - 30 April 2025',
                'description' => 'Pendaftaran dibuka secara online untuk jalur prestasi dan reguler. Calon siswa wajib melengkapi biodata dan berkas.',
                'order' => 1,
                
            ],
            [
                'title' => 'Verifikasi Berkas',
                'date_range' => '01 Mei - 05 Mei 2025',
                'description' => 'Panitia melakukan verifikasi kelengkapan dan keabsahan dokumen yang diunggah oleh calon siswa.',
                'order' => 2,
                
            ],
            [
                'title' => 'Tes Seleksi Akademik',
                'date_range' => '10 Mei 2025',
                'description' => 'Pelaksanaan tes potensi akademik dan wawancara (bawa kartu peserta ujian).',
                'order' => 3,
            ],
            [
                'title' => 'Pengumuman Kelulusan',
                'date_range' => '15 Mei 2025',
                'description' => 'Hasil seleksi dapat dilihat melalui akun masing-masing siswa atau papan pengumuman sekolah.',
                'order' => 4,
            ],
            [
                'title' => 'Daftar Ulang',
                'date_range' => '16 Mei - 20 Mei 2025',
                'description' => 'Siswa yang diterima wajib melakukan daftar ulang dan penyerahan berkas fisik ke sekolah.',
                'order' => 5,
                
            ],
        ];

        // Insert data ke tabel
        DB::table('jadwal')->insert($jadwal);
    }
}