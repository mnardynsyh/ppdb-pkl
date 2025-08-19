<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'nama_siswa',
        'email',
        'password',
        'no_hp',
        'alamat',
        'id_wali', // Foreign key to Wali
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
