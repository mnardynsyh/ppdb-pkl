<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengaturanController extends Controller
{
    /**
     * Menampilkan halaman pengaturan pendaftaran.
     */
    public function index()
    {
        // Mengambil satu-satunya baris pengaturan dari database.
        $pengaturan = Pengaturan::first();
        return view('admin.pengaturan', compact('pengaturan'));
    }

    /**
     * Memperbarui pengaturan pendaftaran.
     */
    public function update(Request $request)
    {
        $request->validate([
            'status' => 'required|in:Dibuka,Ditutup',
            'tanggal_buka' => 'required|date',
            'tanggal_tutup' => 'required|date|after_or_equal:tanggal_buka',
        ]);

        // Cari pengaturan yang ada dan perbarui.
        $pengaturan = Pengaturan::first();
        if ($pengaturan) {
            $pengaturan->update($request->all());
        }

        return redirect()->route('admin.pengaturan.index')->with('success', 'Pengaturan pendaftaran berhasil diperbarui.');
    }
}
