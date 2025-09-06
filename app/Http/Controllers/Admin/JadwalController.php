<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JadwalController extends Controller
{
    /**
     * Menampilkan halaman manajemen jadwal.
     */
    public function index()
    {
        $jadwals = Jadwal::orderBy('order')->get();
        return view('admin.jadwal', compact('jadwals'));
    }

    /**
     * Menyimpan jadwal baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date_range' => 'required|string|max:255',
            'description' => 'required|string',
            'order' => 'required|integer',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal baru berhasil ditambahkan.');
    }

    /**
     * Memperbarui jadwal yang ada.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date_range' => 'required|string|max:255',
            'description' => 'required|string',
            'order' => 'required|integer',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Menghapus jadwal.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
