<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class SekolahAsalFactory extends Factory
{
    public function definition(): array
    {
        return [
            'siswa_id' => Siswa::factory(),
            'nama_sekolah' => 'SMP Negeri ' . fake()->numberBetween(1, 10) . ' ' . fake()->city(),
            'alamat_sekolah' => fake()->address(),
            'tahun_lulus' => '2025',
        ];
    }
}