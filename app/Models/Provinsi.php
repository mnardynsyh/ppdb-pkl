<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provinsi extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model.
     *
     * @var string
     */
    protected $table = 'provinsi';

    /**
     * Tipe data primary key.
     *
     * @var string
     */
    protected $keyType = 'char';

    /**
     * Menunjukkan apakah ID auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Menunjukkan apakah model memiliki timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = ['id', 'nama'];

    /**
     * Mendapatkan daftar kabupaten yang dimiliki oleh provinsi ini.
     */
    public function kabupaten(): HasMany
    {
        return $this->hasMany(Kabupaten::class, 'provinsi_id', 'id');
    }
}
