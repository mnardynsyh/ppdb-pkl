<?php

namespace Database\Factories;

use App\Models\Desa;
use App\Models\User;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiswaFactory extends Factory
{
    /**
     * Tentukan status default model.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = fake('id_ID');
        $desa = Desa::inRandomOrder()->first();

        $namaLengkap = $faker->firstName() . ' ' . $faker->lastName();

        if (!$desa) {
             // Fallback agar seeder tidak error jika lupa seed wilayah
            $desaId = null;
            $kecamatanId = null;
            $kabupatenId = null;
            $provinsiId = null;
        } else {
            // 2. Cari induk wilayahnya agar konsisten
            // Desa -> Kecamatan -> Kabupaten -> Provinsi
            $kecamatan = Kecamatan::find($desa->kecamatan_id);
            $kabupaten = Kabupaten::find($kecamatan->kabupaten_id);
            $provinsi  = Provinsi::find($kabupaten->provinsi_id);

            $desaId      = $desa->id;
            $kecamatanId = $kecamatan->id;
            $kabupatenId = $kabupaten->id;
            $provinsiId  = $provinsi->id;
        }
        
        $createdAt = fake()->dateTimeBetween('-30 days', 'now');
        $updatedAt = fake()->dateTimeBetween($createdAt, 'now');
        
        return [
            'user_id' => User::factory()->state([
                'name' => $namaLengkap, 
                'email' => $faker->unique()->userName() . '@siswa.com', // Email lebih rapi
            ]),
            
            'nama_lengkap' => fake()->name(),
            'nik' => fake()->unique()->numerify('################'),
            'nisn' => fake()->unique()->numerify('##########'),
            'tanggal_lahir' => fake()->date('Y-m-d', '-15 years'),
            'agama' => fake()->randomElement(['Islam','Kristen','Katolik','Hindu','Buddha']),
            'tempat_lahir' => fake()->city(),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'alamat' => fake()->streetAddress(),
            
            // Mocking ID Wilayah
            'desa_id' => $desaId,
            'kecamatan_id' => $kecamatanId,
            'kabupaten_id' => $kabupatenId,
            'provinsi_id' => $provinsiId,
            
            'anak_ke' => fake()->numberBetween(1, 5),
            'status_pendaftaran' => fake()->randomElement(['Pending', 'Diterima', 'Ditolak']),

            // Mengisi kolom timestamps dalam rentang 30 hari terakhir
            'created_at' => $createdAt,
            'updated_at' => $updatedAt, // Menggunakan $updatedAt
        ];
    }
}