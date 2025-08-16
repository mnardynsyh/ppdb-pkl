<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job';
    protected $primaryKey = 'id_job';

    protected $fillable = ['pekerjaan'];

    public function getRouteKeyName(): string
    {
        return 'id_job';
    }
}
