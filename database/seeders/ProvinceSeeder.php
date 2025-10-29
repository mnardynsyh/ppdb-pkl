<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection; // Untuk file besar

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel sebelum mengisi
        DB::table('provinsi')->delete();

        // Path ke file CSV Anda
        $csvFile = database_path('seeders/data/provinces.csv'); 

        // Proses data CSV secara efisien
        LazyCollection::make(function () use ($csvFile) {
            $handle = fopen($csvFile, 'r');
            // Pastikan delimiter CSV benar (biasanya koma ,)
            while (($line = fgetcsv($handle, 4096, ";")) !== false) { 
                yield $line;
            }
            fclose($handle);
        })
        ->skip(1) // Lewati baris header jika ada
        ->chunk(1000) // Proses per 1000 baris
        ->each(function (LazyCollection $chunk) {
            $data = $chunk->map(function ($row) {
                 // [SESUAIKAN INDEKS] Sesuaikan $row[0] dan $row[1]
                 // dengan urutan kolom ID dan Nama di CSV Anda
                return [
                    'id'   => $row[0], 
                    'nama' => $row[1], 
                ];
            })->toArray();
            
            // Masukkan data ke database
            DB::table('provinsi')->insert($data);
        });
    }
}
