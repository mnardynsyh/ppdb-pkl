<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Menampilkan pendaftar dengan status 'pending'.
     */
    public function masuk()
    {
        $calonSiswa = Siswa::where('status_pendaftaran', 'pending')->latest()->get();
        return view('admin.pendaftaran.masuk', compact('calonSiswa'));
    }

    /**
     * Menampilkan pendaftar dengan status 'diterima'.
     */
    public function diterima()
    {
        $siswaDiterima = Siswa::where('status_pendaftaran', 'diterima')->latest()->get();
        return view('admin.pendaftaran.diterima', compact('siswaDiterima'));
    }

    /**
     * Menampilkan pendaftar dengan status 'ditolak'.
     */
    public function ditolak()
    {
        $siswaDitolak = Siswa::where('status_pendaftaran', 'ditolak')->latest()->get();
        return view('admin.pendaftaran.ditolak', compact('siswaDitolak'));
    }

    /**
     * Mengubah status pendaftar menjadi 'diterima'.
     */
    public function prosesTerima(Siswa $siswa)
    {
        $siswa->update(['status_pendaftaran' => 'diterima']);
        return redirect()->route('admin.pendaftaran.masuk')->with('success', 'Pendaftar berhasil diterima.');
    }

    /**
     * Mengubah status pendaftar menjadi 'ditolak'.
     */
    public function prosesTolak(Siswa $siswa)
    {
        $siswa->update(['status_pendaftaran' => 'ditolak']);
        return redirect()->route('admin.pendaftaran.masuk')->with('success', 'Pendaftar berhasil ditolak.');
    }

    /**
     * Mengembalikan status pendaftar ke 'pending'.
     */
    public function kembalikanKePending(Siswa $siswa)
    {
        $siswa->update(['status_pendaftaran' => 'pending']);
        return redirect()->back()->with('success', 'Status pendaftar berhasil dikembalikan ke pending.');
    }
}
