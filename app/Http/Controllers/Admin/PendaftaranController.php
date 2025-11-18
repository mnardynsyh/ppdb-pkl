<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SiswasExport;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class PendaftaranController extends Controller
{
    /**
     * Helper private untuk logika pencarian agar tidak menulis ulang kode.
     */
    private function applySearch($query, $request)
    {
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('asal_sekolah', 'like', "%{$search}%");
            });
        }
    }

    /**
     * Menampilkan halaman pendaftar yang statusnya 'Pending'.
     */
    public function masuk(Request $request)
    {
        // 1. Filter Status
        $query = Siswa::where('status_pendaftaran', 'Pending');

        // 2. Terapkan Pencarian
        $this->applySearch($query, $request);

        // 3. Paginate dengan query string (agar search tidak hilang saat ganti halaman)
        $siswas = $query->latest()->paginate(10)->withQueryString();

        return view('admin.pendaftaran.masuk', compact('siswas'));
    }

    /**
     * Menampilkan halaman pendaftar yang statusnya 'Diterima'.
     */
    public function diterima(Request $request)
    {
        $query = Siswa::where('status_pendaftaran', 'Diterima');

        $this->applySearch($query, $request);

        $siswas = $query->latest()->paginate(10)->withQueryString();

        return view('admin.pendaftaran.diterima', compact('siswas'));
    }

    /**
     * Menampilkan halaman pendaftar yang statusnya 'Ditolak'.
     */
    public function ditolak(Request $request)
    {
        $query = Siswa::where('status_pendaftaran', 'Ditolak');

        $this->applySearch($query, $request);

        $siswas = $query->latest()->paginate(10)->withQueryString();

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

        $this->applySearch($query, $request);

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