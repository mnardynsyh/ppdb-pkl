<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SekolahAsal>
 */
class SekolahAsalFactory extends Factory
{
    public function definition(): array
    {
        $faker = fake('id_ID');
        
        // Membuat nama sekolah random yang realistis
        $namaSekolah = 'SD Negeri ' . $faker->numberBetween(1, 15) . ' ' . $faker->city();

        return [
            'siswa_id' => Siswa::factory(),
            'nama_sekolah' => $namaSekolah,
            'alamat_sekolah' => $faker->address(),
            'tahun_lulus' => $faker->year('-2 years'),
        ];
    }
}