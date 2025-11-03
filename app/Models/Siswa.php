<?php

namespace App\Models;

use App\Models\Lampiran;
use App\Models\OrangTuaWali;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    use HasFactory;

    protected $table = 'siswa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'nama_lengkap',
        'nik',
        'nisn',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'alamat',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'desa_id',
        'asal_sekolah',
        'alamat_sekolah_asal',
        'anak_ke',
        'agama',
        'tahun_lulus',
        'status_pendaftaran',
    ];


    protected $hidden = [
        'password',
    ];


    public function orangTuaWali()
    {
        return $this->hasOne(OrangTuaWali::class);
    }

    public function Lampiran(): HasMany
    {
        return $this->hasMany(Lampiran::class);
    }

    
    /**
     * Mendapatkan data provinsi siswa.
     */
    public function provinsi(): BelongsTo
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id', 'id');
    }

    /**
     * Mendapatkan data kabupaten/kota siswa.
     */
    public function kabupaten(): BelongsTo
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id', 'id');
    }

    /**
     * Mendapatkan data kecamatan siswa.
     */
    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id');
    }

    /**
     * Mendapatkan data desa/kelurahan siswa.
     */
    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class, 'desa_id', 'id');
    }
}

