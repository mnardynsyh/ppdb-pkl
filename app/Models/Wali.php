<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali extends Model
{
    use HasFactory;

    protected $table = 'wali';

    protected $fillable = [
        'nama_wali',
        'email',
        'password',
        'no_hp',
        'alamat',
    ];

    // Relasi: 1 wali bisa punya banyak siswa
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_wali');
    }
}
