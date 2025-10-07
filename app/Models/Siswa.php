<?php

namespace App\Models;

use App\Models\Agama;
use App\Models\Lampiran;
use App\Models\OrangTuaWali;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    use HasFactory;

    protected $table = 'siswa';

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
        'asal_sekolah',
        'alamat_sekolah_asal',
        'anak_ke',
        'agama_id',
        'tahun_lulus',
        'status_pendaftaran',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
    ];


    protected $hidden = [
        'password',
    ];

    // Relasi ke tabel agama
    public function agama()
    {
        return $this->belongsTo(Agama::class, 'agama_id');
    }

    public function orangTuaWali()
    {
        return $this->hasOne(OrangTuaWali::class);
    }

    public function Lampiran(): HasMany
    {
        return $this->hasMany(Lampiran::class);
    }
}
