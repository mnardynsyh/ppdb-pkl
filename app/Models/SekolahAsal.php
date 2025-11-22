<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SekolahAsal extends Model
{
    use HasFactory;

    protected $table = 'sekolah_asal';

    protected $fillable = [
        'siswa_id',
        'nama_sekolah',
        'alamat_sekolah',
        'tahun_lulus',
    ];

    /**
     * Relasi ke tabel Siswa.
     * sekolah_asal.siswa_id -> siswa.id
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
