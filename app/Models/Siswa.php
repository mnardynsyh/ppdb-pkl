<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    /**
     * Kolom yang bisa diisi massal.
     * HARUS sesuai tabel di database.
     */
    protected $fillable = [
        'user_id',

        'nama_lengkap',
        'nik',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',

        'alamat',

        // Wilayah
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'desa_id',

        // Lainnya
        'anak_ke',
        'status_pendaftaran',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];  
    /**
     * Sinkronkan nama siswa ke tabel users.name
     */
    protected static function booted()
    {
        static::created(function ($siswa) {
            if ($siswa->user) {
                $siswa->user->update(['name' => $siswa->nama_lengkap]);
            }
        });

        static::updated(function ($siswa) {
            if ($siswa->wasChanged('nama_lengkap') && $siswa->user) {
                $siswa->user->update(['name' => $siswa->nama_lengkap]);
            }
        });
    }

    // ==============================================================
    // RELASI KE USERS
    // ==============================================================
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ==============================================================
    // RELASI ORANG TUA (Ayah / Ibu / Wali)
    // ==============================================================
    public function orangTua(): HasMany
    {
        return $this->hasMany(OrangTua::class, 'siswa_id');
    }

    public function ayah(): HasOne
    {
        return $this->hasOne(OrangTua::class, 'siswa_id')->where('hubungan', 'Ayah');
    }

    public function ibu(): HasOne
    {
        return $this->hasOne(OrangTua::class, 'siswa_id')->where('hubungan', 'Ibu');
    }

    public function wali(): HasOne
    {
        return $this->hasOne(OrangTua::class, 'siswa_id')->where('hubungan', 'Wali');
    }

    // ==============================================================
    // RELASI SEKOLAH ASAL
    // ==============================================================
    public function sekolahAsal(): HasOne
    {
        return $this->hasOne(SekolahAsal::class, 'siswa_id');
    }

    // ==============================================================
    // RELASI LAMPIRAN
    // ==============================================================
    public function lampiran(): HasMany
    {
        return $this->hasMany(Lampiran::class, 'siswa_id');
    }

    // ==============================================================
    // RELASI WILAYAH
    // ==============================================================
    public function provinsi(): BelongsTo
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }

    public function kabupaten(): BelongsTo
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }
}
