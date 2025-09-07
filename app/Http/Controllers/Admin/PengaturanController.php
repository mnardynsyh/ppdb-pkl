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
     * Menampilkan halaman untuk melihat dan mengedit semua pengaturan.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // Mengambil data pengaturan umum dan semua data jadwal
        $pengaturan = Pengaturan::firstOrFail(); 
        $jadwals = Jadwal::orderBy('order')->get();
        
        return view('admin.pengaturan', compact('pengaturan', 'jadwals'));
    }

    /**
     * Memperbarui pengaturan pendaftaran dan kontak.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'status' => 'required|in:Dibuka,Ditutup',
            'tanggal_buka' => 'required|date',
            'tanggal_tutup' => 'required|date|after_or_equal:tanggal_buka',
            'alamat_sekolah' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email_kontak' => 'nullable|email|max:255',
        ]);

        $pengaturan = Pengaturan::firstOrFail();
        $pengaturan->update($validatedData);

        return redirect()->route('admin.pengaturan.index')
                         ->with('success', 'Pengaturan berhasil diperbarui.');
    }

    /**
     * [BARU] Menyimpan jadwal baru.
     */
    public function storeJadwal(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date_range' => 'required|string|max:255',
            'description' => 'required|string',
            'order' => 'required|integer',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('admin.pengaturan.index')->with('success', 'Jadwal baru berhasil ditambahkan.');
    }

    /**
     * [BARU] Memperbarui jadwal yang ada.
     */
    public function updateJadwal(Request $request, Jadwal $jadwal): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date_range' => 'required|string|max:255',
            'description' => 'required|string',
            'order' => 'required|integer',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('admin.pengaturan.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * [BARU] Menghapus jadwal.
     */
    public function destroyJadwal(Jadwal $jadwal): RedirectResponse
    {
        $jadwal->delete();
        return redirect()->route('admin.pengaturan.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}

