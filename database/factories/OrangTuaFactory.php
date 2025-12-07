<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrangTua>
 */
class OrangTuaFactory extends Factory
{
    public function definition(): array
    {
        $faker = fake('id_ID');

        return [
            // Relasi default (akan di-override oleh seeder jika dipanggil via Siswa)
            'siswa_id' => Siswa::factory(),

            'hubungan' => $faker->randomElement(['Ayah', 'Ibu', 'Wali']),
            'nama_lengkap' => $faker->name(),
            'nik' => $faker->numerify('################'),
            'tempat_lahir' => $faker->city(),
            'tanggal_lahir' => $faker->date('Y-m-d', '-40 years'),
            
            // Sesuai ENUM di database
            'pendidikan_terakhir' => $faker->randomElement([
                'Tidak Sekolah', 
                'SD/Sederajat', 
                'SMP/Sederajat', 
                'SMA/Sederajat', 
                'Diploma (D1/D2/D3)', 
                'Sarjana (S1)', 
                'Magister (S2)', 
                'Doktor (S3)'
            ]),
            
            // Sesuai ENUM di database
            'pekerjaan' => $faker->randomElement([
                'PNS', 
                'TNI/POLRI', 
                'Karyawan Swasta', 
                'Wiraswasta', 
                'Petani', 
                'Buruh', 
                'Guru/Dosen', 
                'Nelayan', 
                'Tidak Bekerja'
            ]),

            'agama' => $faker->randomElement([
                'Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'
            ]),

            'penghasilan_bulanan' => $faker->randomElement([
                '< Rp 1 juta', 
                'Rp 1–3 juta', 
                'Rp 3–5 juta', 
                '> Rp 5 juta', 
                'Tidak Berpenghasilan'
            ]),

            'no_hp' => $faker->phoneNumber(),
            'alamat' => $faker->address(),
        ];
    }
}