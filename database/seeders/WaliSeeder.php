<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class WaliSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        DB::table('wali')->insert([
            [
                'nama_wali' => 'Budi Santoso',
                'email' => 'budi@gmail.com',
                'password' => Hash::make('budi123'),
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_wali' => 'Siti Aminah',
                'email' => 'siti@gmail.com',
                'password' => Hash::make('siti123'),
                'no_hp' => '081298765432',
                'alamat' => 'Jl. Sudirman No. 25, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
