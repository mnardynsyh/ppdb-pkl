<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jadwal;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PengaturanController extends Controller
{
    /**
     * Menampilkan halaman pengaturan beserta list jadwal.
     */
    public function index(): View
    {
        $pengaturan = Pengaturan::first() ?? Pengaturan::create([
            'status' => 'Ditutup',
            'tanggal_buka' => null,
            'tanggal_tutup' => null,
        ]);

        $jadwals = Jadwal::orderBy('order', 'asc')->get();

        return view('admin.pengaturan', compact('pengaturan', 'jadwals'));
    }

    /**
     * Memperbarui Konfigurasi Utama (Status, Tahun Ajaran, Tanggal).
     */
    public function update(Request $request): RedirectResponse
    {
        $rules = [
            'status'       => 'required|in:Dibuka,Ditutup',
            'tahun_ajaran' => 'required|string|max:20',
        ];

        if ($request->status === 'Dibuka') {
            $rules['tanggal_buka']  = 'required|date|before_or_equal:tanggal_tutup';
            $rules['tanggal_tutup'] = 'required|date|after_or_equal:tanggal_buka';
        }

        if ($request->status === 'Ditutup') {
            $rules['tanggal_buka']  = 'nullable|date';
            $rules['tanggal_tutup'] = 'nullable|date';
        }

        $validated = $request->validate($rules);

        // LOGIKA SAFETY
        if ($request->status === 'Dibuka' && $request->tanggal_tutup < now()->toDateString()) {
            return back()->withErrors([
                'tanggal_tutup' => 'Tanggal tutup sudah lewat. Harap set ulang tanggal sesuai periode pendaftaran.'
            ])->withInput();
        }

        $pengaturan = Pengaturan::first();
        $pengaturan->update($validated);

        return redirect()->route('admin.pengaturan.index')
                        ->with('success', 'Konfigurasi sistem berhasil diperbarui.');
    }


    /**
     * JADWAL: Menyimpan jadwal baru.
     */
    public function storeJadwal(Request $request): RedirectResponse
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'date_range'  => 'required|string|max:255',
            'description' => 'required|string',
            'order'       => 'required|integer',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('admin.pengaturan.index')
                         ->with('success', 'Jadwal kegiatan baru berhasil ditambahkan.');
    }

    /**
     * JADWAL: Memperbarui jadwal yang ada.
     */
    public function updateJadwal(Request $request, Jadwal $jadwal): RedirectResponse
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'date_range'  => 'required|string|max:255',
            'description' => 'required|string',
            'order'       => 'required|integer',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('admin.pengaturan.index')
                         ->with('success', 'Jadwal kegiatan berhasil diperbarui.');
    }

    /**
     * JADWAL: Menghapus jadwal.
     */
    public function destroyJadwal(Jadwal $jadwal): RedirectResponse
    {
        $jadwal->delete();
        
        return redirect()->route('admin.pengaturan.index')
                         ->with('success', 'Jadwal kegiatan berhasil dihapus.');
    }
}