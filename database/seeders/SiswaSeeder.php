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

        
        $userKhusus = User::factory()->create([
            'name'      => 'Budi Santoso',
            'email'     => 'siswa@ppdb.com',
            'password'  => Hash::make('siswa123'), 
            'role_id'   => 2, // Role Siswa
        ]);

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

            ]);


        Siswa::factory()
            ->count(30)
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