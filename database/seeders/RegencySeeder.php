<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class RegencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kabupaten')->delete();
        $csvFile = database_path('seeders/data/regencies.csv');

        LazyCollection::make(function () use ($csvFile) {
            $handle = fopen($csvFile, 'r');
            while (($line = fgetcsv($handle, 4096, ";")) !== false) {
                 yield $line;
            }
            fclose($handle);
        })
        ->skip(1)
        ->chunk(1000)
        ->each(function (LazyCollection $chunk) {
            $data = $chunk->map(function ($row) {
                 // [SESUAIKAN INDEKS] Sesuaikan $row[0], $row[1], $row[2]
                return [
                    'id'          => $row[0],
                    'provinsi_id' => $row[1], 
                    'nama'        => $row[2], 
                ];
            })->toArray();
            DB::table('kabupaten')->insert($data);
        });
    }
}
