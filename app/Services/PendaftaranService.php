<?php

namespace App\Services;

use App\Models\Siswa;
use App\Models\Lampiran;
use App\Models\OrangTua;
use App\Models\SekolahAsal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PendaftaranService
{
    public function handleRegistration(array $validatedData, $files)
    {
        return DB::transaction(function () use ($validatedData, $files) {
            
            // 1. Simpan Data Siswa
            $siswa = Siswa::updateOrCreate(
                ['user_id' => Auth::id()],
                array_merge($validatedData, ['status_pendaftaran' => 'Pending'])
            );

            // 2. Simpan Data Orang Tua (Ayah, Ibu, Wali)
            $this->saveOrangTua($siswa->id, 'Ayah', $validatedData, '_ayah');
            $this->saveOrangTua($siswa->id, 'Ibu', $validatedData, '_ibu');

            if (!empty($validatedData['nama_wali'])) {
                $this->saveOrangTua($siswa->id, 'Wali', $validatedData, '_wali');
            } else {
                OrangTua::where('siswa_id', $siswa->id)->where('hubungan', 'Wali')->delete();
            }

            // 3. Simpan Sekolah Asal
            SekolahAsal::updateOrCreate(
                ['siswa_id' => $siswa->id],
                [
                    'nama_sekolah'    => $validatedData['nama_sekolah'],
                    'alamat_sekolah'  => $validatedData['alamat_sekolah'] ?? null,
                    'tahun_lulus'     => $validatedData['tahun_lulus'],
                ]
            );

            // 4. Simpan Berkas
            if ($files) {
                $this->handleFileUploads($siswa, $files);
            }

            return $siswa;
        });
    }

    private function saveOrangTua($siswaId, $hubungan, $data, $suffix = '')
    {
        // Jika suffix kosong (untuk field ayah/ibu yang namanya beda di form), sesuaikan mapping
        // Di sini saya asumsikan pattern nama field konsisten sesuai form request Anda:
        // misal: nama_ayah, nik_ayah. Tapi untuk field 'alamat' dia global.
        
        $keySuffix = ($hubungan == 'Ayah' || $hubungan == 'Ibu') ? strtolower($hubungan) : 'wali';
        $suffix = '_' . $keySuffix;

        OrangTua::updateOrCreate(
            ['siswa_id' => $siswaId, 'hubungan' => $hubungan],
            [
                'nama_lengkap'        => $data['nama' . $suffix],
                'nik'                 => $data['nik' . $suffix],
                'tempat_lahir'        => $data['tempat_lahir' . $suffix],
                'tanggal_lahir'       => $data['tanggal_lahir' . $suffix],
                'pendidikan_terakhir' => $data['pendidikan' . $suffix],
                'pekerjaan'           => $data['pekerjaan' . $suffix],
                'penghasilan_bulanan' => $data['penghasilan' . $suffix],
                'no_hp'               => $data['no_hp' . $suffix],
                'agama'               => $data['agama' . $suffix],
                'alamat'              => $data['alamat'], // Alamat orang tua sama dengan siswa
            ]
        );
    }

    private function handleFileUploads($siswa, $files)
    {
        foreach ($files as $jenis => $file) {
            $lampiranLama = Lampiran::where('siswa_id', $siswa->id)
                                    ->where('jenis_berkas', $jenis)
                                    ->first();

            if ($lampiranLama && $lampiranLama->path_file) {
                if (Storage::disk('public')->exists($lampiranLama->path_file)) {
                    Storage::disk('public')->delete($lampiranLama->path_file);
                }
            }

            $path = $file->storeAs(
                "lampiran/{$siswa->id}",
                $jenis . '.' . $file->getClientOriginalExtension(),
                'public'
            );

            Lampiran::updateOrCreate(
                ['siswa_id' => $siswa->id, 'jenis_berkas' => $jenis],
                [
                    'path_file'      => $path,
                    'nama_file_asli' => $file->getClientOriginalName(),
                ]
            );
        }
    }
}