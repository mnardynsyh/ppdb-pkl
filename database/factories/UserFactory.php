<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        $faker = fake('id_ID');
        
        // Buat nama bersih
        $nama = $faker->firstName() . ' ' . $faker->lastName();

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('admin123'),
            'role_id' => 1,

            'name' => $nama,
            'email' => $faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'role_id' => 2,
        ];
    }
}
