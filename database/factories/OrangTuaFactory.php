<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrangTuaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'siswa_id' => Siswa::factory(), // Default relation
            'hubungan' => fake()->randomElement(['Ayah', 'Ibu']),
            'nama_lengkap' => fake()->name(),
            'nik' => fake()->numerify('################'),
            'tempat_lahir' => fake()->city(),
            'tanggal_lahir' => fake()->date('Y-m-d', '-40 years'),
            'pendidikan_terakhir' => fake()->randomElement(['SMA/Sederajat', 'Sarjana (S1)']),
            'pekerjaan' => fake()->randomElement(['Wiraswasta', 'Karyawan Swasta', 'PNS']),
            'agama' => 'Islam',
            'penghasilan_bulanan' => fake()->randomElement(['Rp 1–3 juta', 'Rp 3–5 juta']),
            'no_hp' => fake()->phoneNumber(),
            'alamat' => fake()->address(),
        ];
    }
}