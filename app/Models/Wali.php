<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Wali extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'wali';

    protected $fillable = [
        'nama_wali',
        'email',
        'password',
        'no_hp',
        'alamat',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi: 1 wali bisa punya banyak siswa
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_wali');
    }
}
