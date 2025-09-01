<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrangTuaWali extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orang_tua_wali';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'siswa_id',
        'nama_ayah',
        'nik_ayah',
        'tempat_lahir_ayah',
        'tanggal_lahir_ayah',
        'pekerjaan_ayah_id',
        'penghasilan_ayah_id',
        'pendidikan_ayah_id',
        'agama_ayah_id',
        'nama_ibu',
        'nik_ibu',
        'tempat_lahir_ibu',
        'tanggal_lahir_ibu',
        'pekerjaan_ibu_id',
        'penghasilan_ibu_id',
        'pendidikan_ibu_id',
        'agama_ibu_id',
        'nama_wali',
        'nik_wali',
        'tempat_lahir_wali',
        'tanggal_lahir_wali',
        'pekerjaan_wali_id',
        'penghasilan_wali_id',
        'pendidikan_wali_id',
        'agama_wali_id',
    ];

    /**
     * Mendapatkan data siswa yang memiliki data orang tua/wali ini.
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    // Anda bisa menambahkan relasi lain di sini jika diperlukan, contohnya:

    /**
     * Mendapatkan data pekerjaan ayah.
     */
    public function pekerjaanAyah(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'pekerjaan_ayah_id');
    }

    /**
     * Mendapatkan data agama ibu.
     */
    public function agamaIbu(): BelongsTo
    {
        return $this->belongsTo(Agama::class, 'agama_ibu_id');
    }
    
    // ... dan relasi lainnya untuk pendidikan, penghasilan, dll.
}
