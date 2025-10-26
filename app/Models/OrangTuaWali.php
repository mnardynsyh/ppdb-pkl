<?php

namespace App\Models;

use App\Models\Job; // [DIKEMBALIKAN] Model Job tetap digunakan
// [DIHAPUS] Model Pendidikan tidak lagi digunakan
// use App\Models\Pendidikan; 
use App\Models\Penghasilan;
use App\Models\Siswa;
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
        'pekerjaan_ayah_id', // [DIKEMBALIKAN] Tetap menggunakan ID untuk pekerjaan
        'penghasilan_ayah_id',
        // [DIUBAH] Menggunakan nama kolom enum baru untuk pendidikan
        'pendidikan_ayah', 
        'agama_ayah', // Disesuaikan dari langkah sebelumnya
        'alamat_ayah', // Disesuaikan dari langkah sebelumnya
        'nama_ibu',
        'nik_ibu',
        'tempat_lahir_ibu',
        'tanggal_lahir_ibu',
        'pekerjaan_ibu_id', // [DIKEMBALIKAN] Tetap menggunakan ID untuk pekerjaan
        'penghasilan_ibu_id',
         // [DIUBAH] Menggunakan nama kolom enum baru untuk pendidikan
        'pendidikan_ibu', 
        'agama_ibu', // Disesuaikan dari langkah sebelumnya
        'alamat_ibu', // Disesuaikan dari langkah sebelumnya
        'nama_wali',
        'nik_wali',
        'tempat_lahir_wali',
        'tanggal_lahir_wali',
        'pekerjaan_wali_id', // [DIKEMBALIKAN] Tetap menggunakan ID untuk pekerjaan
        'penghasilan_wali_id',
        'pendidikan_wali', 
        'agama_wali', // Disesuaikan dari langkah sebelumnya
        'alamat_wali', // Disesuaikan dari langkah sebelumnya
    ];

    /**
     * Mendapatkan data siswa yang memiliki data orang tua/wali ini.
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    // ===================================================================
    // RELASI UNTUK DATA AYAH
    // ===================================================================

    public function pekerjaanAyah(): BelongsTo 
    {
        return $this->belongsTo(Job::class, 'pekerjaan_ayah_id');
    }

    public function penghasilanAyah(): BelongsTo
    {
        return $this->belongsTo(Penghasilan::class, 'penghasilan_ayah_id');
    }
    
    // ===================================================================
    // RELASI UNTUK DATA IBU
    // ===================================================================

    public function pekerjaanIbu(): BelongsTo 
    {
        return $this->belongsTo(Job::class, 'pekerjaan_ibu_id');
    }

    public function penghasilanIbu(): BelongsTo
    {
        return $this->belongsTo(Penghasilan::class, 'penghasilan_ibu_id');
    }
    
    // ===================================================================
    // RELASI UNTUK DATA WALI
    // ===================================================================

    public function pekerjaanWali(): BelongsTo 
    {
        return $this->belongsTo(Job::class, 'pekerjaan_wali_id');
    }

    public function penghasilanWali(): BelongsTo
    {
        return $this->belongsTo(Penghasilan::class, 'penghasilan_wali_id');
    }
}

