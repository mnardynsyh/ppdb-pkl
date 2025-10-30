<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'desa';
    protected $keyType = 'char';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['id', 'kecamatan_id', 'nama'];

    /**
     * Mendapatkan kecamatan yang memiliki desa ini.
     */
    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id');
    }
}
