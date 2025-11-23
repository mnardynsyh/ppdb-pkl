<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama agar hanya ada 1 baris pengaturan
        DB::table('pengaturan')->truncate();

        // Insert data pengaturan awal
        DB::table('pengaturan')->insert([
            'id' => 1, // Kita paksa ID 1
            'tahun_ajaran' => '2025/2026',
            'status' => 'Dibuka', // Default langsung BUKA agar bisa dites
            'tanggal_buka' => '2025-03-01',
            'tanggal_tutup' => '2025-07-15',
            'alamat_sekolah' => 'Jl. Raya P.Diponegoro 09, Bumiayu, Brebes, Jawa Tengah', // Sesuaikan dengan data real
            'telepon' => '0812-3456-7890',
            'email' => 'info@smp.sch.id',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}