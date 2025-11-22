<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $pengaturan = Pengaturan::first();
        return view('admin.kontak', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'email'   => 'required|email',
            'telepon' => 'required|string|max:50',
            'alamat_sekolah' => 'required|string|max:255',
        ]);

        $pengaturan = Pengaturan::first();
        $pengaturan->update([
            'email'   => $request->email,
            'telepon' => $request->telepon,
            'alamat_sekolah' => $request->alamat_sekolah,
        ]);

        return redirect()->route('admin.kontak.index')->with('success', 'Informasi kontak berhasil diperbarui.');
    }
}
