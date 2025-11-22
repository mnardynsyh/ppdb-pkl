<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    protected $table = 'orang_tua';

    protected $fillable = [
        'siswa_id',
        'hubungan',
        'nama_lengkap',
        'nik',
        'agama',
        'tempat_lahir',
        'tanggal_lahir',
        'pendidikan_terakhir',
        'pekerjaan',
        'penghasilan_bulanan',
        'no_hp',
        'alamat',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}

