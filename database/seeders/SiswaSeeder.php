<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Siswa;
use App\Models\OrangTua;
use App\Models\SekolahAsal; // Pastikan SekolahAsal di-import
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Sequence;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        // 1. BUAT AKUN SISWA KHUSUS (Budi Santoso)
        // Email: siswa@ppdb.com
        // Pass : siswa123
        
        $userKhusus = User::factory()->create([
            'name'      => 'Budi Santoso (Siswa)',
            'email'     => 'siswa@ppdb.com',
            'password'  => Hash::make('siswa123'), 
            'role_id'   => 2, // Role Siswa
        ]);

        // Buat data Siswa Budi Santoso dan relasi-relasinya
        Siswa::factory()
            ->has(SekolahAsal::factory()) // Relasi One-to-One
            ->has(
                OrangTua::factory()->count(2) // Relasi One-to-Many
                    ->state(new Sequence(
                        // Tetapkan 'Ayah' dan 'Ibu' secara berurutan
                        ['hubungan' => 'Ayah'],
                        ['hubungan' => 'Ibu'],
                    ))
            )
            ->create([
                'user_id'       => $userKhusus->id,
                'nama_lengkap'  => 'Budi Santoso',
                'nisn'          => '0001112223',
                // created_at dan updated_at akan diisi oleh Factory/Laravel
            ]);


        // 2. BUAT 10 AKUN SISWA ACAK
        Siswa::factory()
            ->count(100)
            // has(SekolahAsal::factory()) akan membuat SekolahAsal terkait
            ->has(SekolahAsal::factory()) 
            ->has(
                OrangTua::factory()->count(2)
                    ->state(new Sequence(
                        ['hubungan' => 'Ayah'],
                        ['hubungan' => 'Ibu'],
                    ))
            )
            ->create();
    }
}