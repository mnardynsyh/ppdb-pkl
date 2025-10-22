<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SiswasExport;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\OrangTuaWali; // Pastikan model ini di-use
use App\Models\Pendidikan; // Pastikan model ini di-use
use App\Models\Penghasilan; // Pastikan model ini di-use
use App\Models\Job as Pekerjaan; // Pastikan model ini di-use

class PendaftaranController extends Controller
{
    /**
     * Menampilkan halaman pendaftar yang statusnya 'Pending'.
     */
    public function masuk()
    {
        $siswas = Siswa::where('status_pendaftaran', 'Pending')->latest()->paginate(10);
        return view('admin.pendaftaran.masuk', compact('siswas'));
    }

    /**
     * Menampilkan halaman pendaftar yang statusnya 'Diterima'.
     */
    public function diterima()
    {
        $siswas = Siswa::where('status_pendaftaran', 'Diterima')->latest()->paginate(10);
        return view('admin.pendaftaran.diterima', compact('siswas'));
    }

    /**
     * Menampilkan halaman pendaftar yang statusnya 'Ditolak'.
     */
    public function ditolak()
    {
        $siswas = Siswa::where('status_pendaftaran', 'Ditolak')->latest()->paginate(10);
        return view('admin.pendaftaran.ditolak', compact('siswas'));
    }

    /**
     * Menampilkan semua pendaftar dengan filter dan pencarian.
     */
    public function semuaPendaftar(Request $request)
    {
        $query = Siswa::query();

        if ($request->filled('status')) {
            $query->where('status_pendaftaran', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('asal_sekolah', 'like', "%{$search}%");
            });
        }

        $siswas = $query->latest()->paginate(10)->withQueryString();

        return view('admin.pendaftaran.semua', compact('siswas'));
    }

    /**
     * Mengekspor data pendaftar ke file Excel (.xlsx).
     */
    public function exportExcel(Request $request)
    {
        $fileName = 'data-pendaftar-' . date('Y-m-d') . '.xlsx';
        
        return Excel::download(new SiswasExport($request), $fileName);
    }
    
    /**
     * Menampilkan halaman detail pendaftar.
     */
    public function detail(Siswa $siswa)
    {
        $siswa->load([
            'lampiran',
            'orangTuaWali.pekerjaanAyah', 'orangTuaWali.pendidikanAyah', 'orangTuaWali.penghasilanAyah',
            'orangTuaWali.pekerjaanIbu', 'orangTuaWali.pendidikanIbu', 'orangTuaWali.penghasilanIbu',
            'orangTuaWali.pekerjaanWali', 'orangTuaWali.pendidikanWali', 'orangTuaWali.penghasilanWali'
        ]);
        return view('admin.pendaftaran.detail', compact('siswa'));
    }

    /**
     * Mengubah status siswa menjadi 'Diterima'.
     */
    public function terima(Siswa $siswa)
    {
        if ($siswa->status_pendaftaran !== 'Diterima') {
            $siswa->update(['status_pendaftaran' => 'Diterima']);
            return back()->with('success', "Siswa dengan nama {$siswa->nama_lengkap} berhasil diterima.");
        }
        return back();
    }

    /**
     * Mengubah status siswa menjadi 'Ditolak'.
     */
    public function tolak(Siswa $siswa)
    {
        if ($siswa->status_pendaftaran !== 'Ditolak') {
            $siswa->update(['status_pendaftaran' => 'Ditolak']);
            return back()->with('success', "Siswa dengan nama {$siswa->nama_lengkap} berhasil ditolak.");
        }
        return back();
    }

    /**
     * Mengembalikan status siswa menjadi 'Pending'.
     */
    public function batalkan(Siswa $siswa)
    {
        if ($siswa->status_pendaftaran !== 'Pending') {
            $siswa->update(['status_pendaftaran' => 'Pending']);
            return back()->with('success', "Status untuk {$siswa->nama_lengkap} berhasil dikembalikan ke Pending.");
        }
        return back();
    }
}
