<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Siswa;
use App\Models\OrangTua;
use App\Models\SekolahAsal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Sequence;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        // Email: siswa@ppdb.com
        // Pass : siswa123
        
        $userKhusus = User::factory()->create([
            'name'     => 'Budi Santoso (Siswa)',
            'email'    => 'siswa@ppdb.com',
            'password' => Hash::make('siswa123'), // Password pasti
            'role_id'  => 2, // Pastikan 2 adalah role siswa
        ]);

        Siswa::factory()
            ->create([
                'user_id'      => $userKhusus->id,
                'nama_lengkap' => 'Budi Santoso',
                'nisn'         => '0001112223',
            ])
            ->each(function ($siswa) {
                SekolahAsal::factory()->create(['siswa_id' => $siswa->id]);
                OrangTua::factory()->count(2)->create(['siswa_id' => $siswa->id]);
            });


        // 2. BUAT 10 AKUN SISWA ACAK
        Siswa::factory()
            ->count(10)
            // Gunakan state 'siswa' dari UserFactory yang baru Anda buat
            ->for(User::factory()->siswa()) 
            ->has(SekolahAsal::factory())
            ->has(
                OrangTua::factory()->count(2)
                    ->state(new Sequence(
                        ['hubungan' => 'Ayah', 'jenis_kelamin' => 'L'],
                        ['hubungan' => 'Ibu', 'jenis_kelamin' => 'P'],
                    ))
            )
            ->create();
    }
}