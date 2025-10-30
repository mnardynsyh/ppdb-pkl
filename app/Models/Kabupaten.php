<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kabupaten extends Model
{
    use HasFactory;

    protected $table = 'kabupaten';
    protected $keyType = 'char';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['id', 'provinsi_id', 'nama'];

    /**
     * Mendapatkan provinsi yang memiliki kabupaten ini.
     */
    public function provinsi(): BelongsTo
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id', 'id');
    }

    /**
     * Mendapatkan daftar kecamatan yang dimiliki oleh kabupaten ini.
     */
    public function kecamatan(): HasMany
    {
        return $this->hasMany(Kecamatan::class, 'kabupaten_id', 'id');
    }
}
