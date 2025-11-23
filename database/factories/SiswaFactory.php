<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiswaFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Otomatis buat User baru saat Siswa dibuat
            'user_id' => User::factory()->state(['role_id' => 2]), 
            'nama_lengkap' => fake()->name(),
            'nik' => fake()->unique()->numerify('################'), // 16 digit
            'nisn' => fake()->unique()->numerify('##########'),      // 10 digit
            'tanggal_lahir' => fake()->date('Y-m-d', '-15 years'),   // Usia sekitar 15 tahun
            'agama' => fake()->randomElement(['Islam','Kristen','Katolik','Hindu','Buddha']),
            'tempat_lahir' => fake()->city(),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'alamat' => fake()->address(),
            
            // Mocking ID Wilayah (Karena char, kita pakai angka string)
            'provinsi_id' => '11',
            'kabupaten_id' => '1101',
            'kecamatan_id' => '1101010',
            'desa_id' => '1101010001',
            
            'anak_ke' => fake()->numberBetween(1, 5),
            'status_pendaftaran' => 'Pending',
        ];
    }
}