<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model.
     *
     * @var string
     */
    protected $table = 'sliders';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'image_path',
        'order',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * [Accessor] 
     * Mendapatkan URL lengkap untuk gambar.
     */
    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            // Memeriksa apakah path adalah URL eksternal (misal: placeholder)
            if (filter_var($this->image_path, FILTER_VALIDATE_URL)) {
                return $this->image_path;
            }
            // Jika bukan, ambil dari storage 'public'
            return Storage::url($this->image_path);
        }
        
        // Mengembalikan placeholder default jika tidak ada gambar
        return 'https://placehold.co/1920x1080/e2e8f0/94a3b8?text=Gambar+Tidak+Tersedia';
    }
}
