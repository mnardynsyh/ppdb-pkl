<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class SiswaFactory extends Factory
{
    protected $model = Siswa::class;

    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'nama_lengkap' => $this->faker->name(),
            'nik' => $this->faker->numerify('###############'),
            'nisn' => $this->faker->numerify('##########'),
            'tanggal_lahir' => $this->faker->date(),
            'tempat_lahir' => $this->faker->city(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'alamat' => $this->faker->address(),
            'asal_sekolah' => $this->faker->company(),
            'anak_ke' => $this->faker->numberBetween(1, 5),
            'agama_id' => 1, // contoh default
            'tahun_lulus' => $this->faker->year(),
            'pas_foto' => null,
            'status_pendaftaran' => 'pending',
            'role_id' => 2, // pastikan role untuk siswa diisi di sini
        ];
    }
}
