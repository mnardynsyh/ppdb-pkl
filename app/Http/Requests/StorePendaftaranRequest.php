<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class StorePendaftaranRequest extends FormRequest
{
    // Kita pindahkan opsi dropdown ke sini atau ke Enum terpisah (disarankan).
    // Untuk saat ini, kita simpan di sini agar rapi.
    private const AGAMA = ['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'];
    private const PENDIDIKAN = ['Tidak Sekolah','SD/Sederajat','SMP/Sederajat','SMA/Sederajat','Diploma (D1/D2/D3)','Sarjana (S1)','Magister (S2)','Doktor (S3)'];
    private const PENGHASILAN = ['< Rp 1 juta','Rp 1–3 juta','Rp 3–5 juta','> Rp 5 juta','Tidak Berpenghasilan'];
    private const PEKERJAAN = ['PNS','TNI/POLRI','Karyawan Swasta','Wiraswasta','Petani','Buruh','Guru/Dosen','Nelayan','Tidak Bekerja'];

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_lengkap'   => 'required|string|max:255',
            'nik' => [
                'required', 'digits:16',
                Rule::unique('siswa', 'nik')->ignore(Auth::id(), 'user_id'),
            ],
            'nisn' => [
                'required', 'digits:10',
                Rule::unique('siswa', 'nisn')->ignore(Auth::id(), 'user_id'),
            ],
            'jenis_kelamin'  => 'required|in:L,P',
            'tempat_lahir'   => 'required|string|max:100',
            'tanggal_lahir'  => 'required|date',
            'agama'          => ['required', Rule::in(self::AGAMA)],
            'anak_ke'        => 'required|integer|min:1',
            'alamat'         => 'required|string',
            'provinsi_id'    => 'required|exists:provinsi,id',
            'kabupaten_id'   => 'required|exists:kabupaten,id',
            'kecamatan_id'   => 'required|exists:kecamatan,id',
            'desa_id'        => 'required|exists:desa,id',

            // Validasi Ayah
            'nama_ayah'           => 'required|string|max:255',
            'nik_ayah'            => 'required|digits:16',
            'tempat_lahir_ayah'   => 'required|string|max:100',
            'tanggal_lahir_ayah'  => 'required|date',
            'pekerjaan_ayah'      => ['required', Rule::in(self::PEKERJAAN)],
            'pendidikan_ayah'     => ['required', Rule::in(self::PENDIDIKAN)],
            'penghasilan_ayah'    => ['required', Rule::in(self::PENGHASILAN)],
            'no_hp_ayah'          => 'nullable|string|max:20',
            'agama_ayah'          => ['required', Rule::in(self::AGAMA)],

            // Validasi Ibu
            'nama_ibu'            => 'required|string|max:255',
            'nik_ibu'             => 'required|digits:16',
            'tempat_lahir_ibu'    => 'required|string|max:100',
            'tanggal_lahir_ibu'   => 'required|date',
            'pekerjaan_ibu'       => ['required', Rule::in(self::PEKERJAAN)],
            'pendidikan_ibu'      => ['required', Rule::in(self::PENDIDIKAN)],
            'penghasilan_ibu'     => ['required', Rule::in(self::PENGHASILAN)],
            'no_hp_ibu'           => 'nullable|string|max:20',
            'agama_ibu'           => ['required', Rule::in(self::AGAMA)],

            // Validasi Wali
            'tinggal_dengan_wali' => 'nullable',
            'nama_wali'           => 'required_if:tinggal_dengan_wali,on|nullable|string|max:255',
            'nik_wali'            => 'nullable|digits:16',
            'tempat_lahir_wali'   => 'nullable|string|max:100',
            'tanggal_lahir_wali'  => 'nullable|date',
            'pekerjaan_wali'      => ['nullable', Rule::in(self::PEKERJAAN)],
            'pendidikan_wali'     => ['nullable', Rule::in(self::PENDIDIKAN)],
            'penghasilan_wali'    => ['nullable', Rule::in(self::PENGHASILAN)],
            'no_hp_wali'          => 'nullable|string|max:20',
            'agama_wali'          => ['nullable', Rule::in(self::AGAMA)],

            // Sekolah Asal
            'nama_sekolah'        => 'required|string|max:255',
            'alamat_sekolah'      => 'nullable|string',
            'tahun_lulus'         => 'required|digits:4',

            // Berkas
            'berkas'              => 'required|array',
            'berkas.*'            => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }
}