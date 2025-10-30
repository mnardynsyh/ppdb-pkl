<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';
    protected $keyType = 'char';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['id', 'kabupaten_id', 'nama'];

    /**
     * Mendapatkan kabupaten yang memiliki kecamatan ini.
     */
    public function kabupaten(): BelongsTo
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id', 'id');
    }

    /**
     * Mendapatkan daftar desa yang dimiliki oleh kecamatan ini.
     */
    public function desa(): HasMany
    {
        return $this->hasMany(Desa::class, 'kecamatan_id', 'id');
    }
}
