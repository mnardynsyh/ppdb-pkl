<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nisn', 'name', 'email', 'password', 'alamat', 'sekolah_asal', 'no_hp'
    ];

    protected $hidden = [
        'password',
    ];
}
