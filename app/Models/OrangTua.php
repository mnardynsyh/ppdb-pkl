<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrangTua extends Model
{

    use HasFactory;
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
    public $timestamps = false;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}

