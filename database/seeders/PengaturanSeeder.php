<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat satu baris data pengaturan default jika belum ada.
        Pengaturan::firstOrCreate(
            ['id' => 1], // Kunci untuk memastikan hanya ada satu baris
            [
                'status' => 'Ditutup',
                'tanggal_buka' => now()->addDays(7)->toDateString(),
                'tanggal_tutup' => now()->addDays(14)->toDateString(),
            ]
        );
    }
}
