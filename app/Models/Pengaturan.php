<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengaturan extends Model
{
    use HasFactory;

    protected $table = 'pengaturan';

    /**
     * [DIPERBARUI] Menambahkan kolom kontak ke fillable.
     */
    protected $fillable = [
        'status',
        'tanggal_buka',
        'tanggal_tutup',
        'alamat_sekolah',
        'telepon',
        'email_kontak',
    ];

    /**
     * Mengubah kolom tanggal menjadi objek Carbon secara otomatis.
     */
    protected $casts = [
        'tanggal_buka' => 'date',
        'tanggal_tutup' => 'date',
    ];

    /**
     * Metode ini berisi semua logika untuk menentukan status pendaftaran.
     */
    public function getStatusDetails(): array
    {
        $sekarang = Carbon::now();
        
        if ($this->status === 'Ditutup') {
            return [
                'status' => 'Ditutup',
                'pesan' => 'Pendaftaran saat ini sedang ditutup oleh panitia.',
                'warna' => 'bg-red-100 border-red-500 text-red-700',
            ];
        }

        if (!$this->tanggal_buka || !$this->tanggal_tutup) {
             return [
                'status' => 'Ditutup',
                'pesan' => 'Jadwal pendaftaran belum diatur oleh panitia.',
                'warna' => 'bg-yellow-100 border-yellow-500 text-yellow-700',
            ];
        }

        if ($sekarang->isBefore($this->tanggal_buka)) {
            return [
                'status' => 'Segera Dibuka',
                'pesan' => 'Pendaftaran akan dibuka pada tanggal ' . $this->tanggal_buka->isoFormat('D MMMM YYYY') . '.',
                'warna' => 'bg-yellow-100 border-yellow-500 text-yellow-700',
            ];
        }

        if ($sekarang->isAfter($this->tanggal_tutup)) {
            return [
                'status' => 'Ditutup',
                'pesan' => 'Periode pendaftaran telah berakhir pada tanggal ' . $this->tanggal_tutup->isoFormat('D MMMM YYYY') . '.',
                'warna' => 'bg-red-100 border-red-500 text-red-700',
            ];
        }

        return [
            'status' => 'Dibuka',
            'pesan' => 'Pendaftaran sedang dibuka! Akan berakhir pada tanggal ' . $this->tanggal_tutup->isoFormat('D MMMM YYYY') . '.',
            'warna' => 'bg-green-100 border-green-500 text-green-700',
        ];
    }
}

