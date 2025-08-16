<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penghasilan extends Model
{
    protected $table = 'penghasilan';
    protected $primaryKey = 'id_penghasilan';

    protected $fillable = [
        'penghasilan',
    ];
}
