<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\RolesSeeder;
use Database\Seeders\SiswaSeeder;
use Database\Seeders\JadwalSeeder;
use Database\Seeders\RegencySeeder;
use Database\Seeders\VillageSeeder;
use Database\Seeders\DistrictSeeder;
use Database\Seeders\ProvinceSeeder;
use Database\Seeders\PengaturanSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProvinceSeeder::class,
            RegencySeeder::class,
            DistrictSeeder::class,
            VillageSeeder::class,
            RolesSeeder::class,
            AdminSeeder::class,
            SiswaSeeder::class,
            JadwalSeeder::class,
            PengaturanSeeder::class,
        ]);
    }
}
