<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RegencySeeder;
use Database\Seeders\DistrictSeeder;
use Database\Seeders\ProvinceSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProvinceSeeder::class,
            RegencySeeder::class,
            DistrictSeeder::class,
            VillageSeeder::class,
        ]);
    }
}
