<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PengaturanController extends Controller
{
    /**
     * Menampilkan halaman pengaturan.
     */
    public function index(): View
    {

        $pengaturan = Pengaturan::first() ?? Pengaturan::create([
            'status' => 'Ditutup',
            'tanggal_buka' => null,
            'tanggal_tutup' => null,
            'alamat_sekolah' => '',
            'telepon' => '',
            'email_kontak' => '',
        ]);

        return view('admin.pengaturan', compact('pengaturan'));
    }

    /**
     * Memperbarui pengaturan.
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


        $pengaturan = Pengaturan::first() ?? new Pengaturan();

        $pengaturan->update($validatedData);

        return redirect()->route('admin.pengaturan.index')
                         ->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
