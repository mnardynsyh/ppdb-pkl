<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrangTuaWali extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan.
     *
     * @var string
     */
    protected $table = 'orang_tua_wali';

    /**
     * Kolom yang bisa diisi mass-assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'siswa_id',

        // Data Ayah
        'nama_ayah',
        'nik_ayah',
        'tempat_lahir_ayah',
        'tanggal_lahir_ayah',
        'pekerjaan_ayah',
        'pekerjaan_ayah_lainnya',
        'penghasilan_ayah',
        'pendidikan_ayah',
        'agama_ayah',
        'alamat_ayah',

        // Data Ibu
        'nama_ibu',
        'nik_ibu',
        'tempat_lahir_ibu',
        'tanggal_lahir_ibu',
        'pekerjaan_ibu',
        'pekerjaan_ibu_lainnya',
        'penghasilan_ibu',
        'pendidikan_ibu',
        'agama_ibu',
        'alamat_ibu',

        // Data Wali
        'nama_wali',
        'nik_wali',
        'tempat_lahir_wali',
        'tanggal_lahir_wali',
        'pekerjaan_wali',
        'pekerjaan_wali_lainnya',
        'penghasilan_wali',
        'pendidikan_wali',
        'agama_wali',
        'alamat_wali',
    ];

    /**
     * Relasi: satu orang_tua_wali dimiliki oleh satu siswa.
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    /**
     * Helper method untuk menampilkan pekerjaan ayah dengan fallback "lainnya".
     */
    public function getPekerjaanAyahDisplayAttribute(): string
    {
        return $this->pekerjaan_ayah === 'Lainnya'
            ? ($this->pekerjaan_ayah_lainnya ?? 'Lainnya')
            : ($this->pekerjaan_ayah ?? '-');
    }

    /**
     * Helper method untuk menampilkan pekerjaan ibu dengan fallback "lainnya".
     */
    public function getPekerjaanIbuDisplayAttribute(): string
    {
        return $this->pekerjaan_ibu === 'Lainnya'
            ? ($this->pekerjaan_ibu_lainnya ?? 'Lainnya')
            : ($this->pekerjaan_ibu ?? '-');
    }

    /**
     * Helper method untuk menampilkan pekerjaan wali dengan fallback "lainnya".
     */
    public function getPekerjaanWaliDisplayAttribute(): string
    {
        return $this->pekerjaan_wali === 'Lainnya'
            ? ($this->pekerjaan_wali_lainnya ?? 'Lainnya')
            : ($this->pekerjaan_wali ?? '-');
    }
}
