<?php

namespace Database\Factories;

use App\Models\User;
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
        // --- PERUBAHAN DI SINI: Batasi rentang waktu 30 hari terakhir ---
        $createdAt = fake()->dateTimeBetween('-30 days', 'now');
        // Pastikan updated_at lebih baru dari created_at
        $updatedAt = fake()->dateTimeBetween($createdAt, 'now');
        
        return [
            // Otomatis buat User baru saat Siswa dibuat (Relasi One-to-One)
            // Mengatur role_id = 2 (Siswa) di UserFactory.
            'user_id' => User::factory()->state(['role_id' => 2]), 
            
            'nama_lengkap' => fake()->name(),
            'nik' => fake()->unique()->numerify('################'), // 16 digit
            'nisn' => fake()->unique()->numerify('##########'),      // 10 digit
            'tanggal_lahir' => fake()->date('Y-m-d', '-15 years'),  // Usia sekitar 15 tahun
            'agama' => fake()->randomElement(['Islam','Kristen','Katolik','Hindu','Buddha']),
            'tempat_lahir' => fake()->city(),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'alamat' => fake()->address(),
            
            // Mocking ID Wilayah (Sesuai dengan data wilayah Aceh '11')
            'provinsi_id' => '11',
            'kabupaten_id' => '1101',
            'kecamatan_id' => '1101010',
            'desa_id' => '1101010001',
            
            'anak_ke' => fake()->numberBetween(1, 5),
            'status_pendaftaran' => fake()->randomElement(['Pending', 'Diterima', 'Ditolak']),

            // Mengisi kolom timestamps dalam rentang 30 hari terakhir
            'created_at' => $createdAt,
            'updated_at' => $updatedAt, // Menggunakan $updatedAt
        ];
    }
}