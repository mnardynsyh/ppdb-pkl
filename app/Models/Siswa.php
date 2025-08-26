<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'anak_ke',
        'agama_id',
        'tahun_lulus',
        'pas_foto',
        'status_pendaftaran',
    ];


    protected $hidden = [
        'password',
    ];

    // Relasi ke tabel agama
    public function agama()
    {
        return $this->belongsTo(Agama::class, 'agama_id');
    }
}
