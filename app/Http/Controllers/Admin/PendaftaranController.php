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
     * Helper private untuk logika pencarian.
     */
    private function applySearch($query, $request)
    {
        if ($request->filled('search')) {
            $search = $request->search;
            
            $query->where(function ($q) use ($search) {
                // pencarian Nama & NISN
                $q->where('nama_lengkap', 'like', "%{$search}%")
                ->orWhere('nisn', 'like', "%{$search}%");

                // Opsi Tambahan
                // ->orWhere('nik', 'like', "%{$search}%");

                /*
                ->orWhereHas('sekolahAsal', function ($subQuery) use ($search) {
                    $subQuery->where('nama_sekolah', 'like', "%{$search}%");
                })
                ->orWhereHas('user', function ($subQuery) use ($search) {
                    $subQuery->where('email', 'like', "%{$search}%");
                });
                */
            });
        }
    }

    /**
     * Menampilkan halaman pendaftar yang statusnya 'Pending'.
     */
    public function masuk(Request $request)
    {
        // Load relasi user & sekolahAsal
        $query = Siswa::with(['user', 'sekolahAsal'])->where('status_pendaftaran', 'Pending');

        $this->applySearch($query, $request);

        $siswas = $query->latest()->paginate(10)->withQueryString();

        return view('admin.pendaftaran.masuk', compact('siswas'));
    }

    /**
     * Menampilkan halaman pendaftar yang statusnya 'Diterima'.
     */
    public function diterima(Request $request)
    {
        $query = Siswa::with(['user', 'sekolahAsal'])->where('status_pendaftaran', 'Diterima');

        $this->applySearch($query, $request);

        $siswas = $query->latest()->paginate(10)->withQueryString();

        return view('admin.pendaftaran.diterima', compact('siswas'));
    }

    /**
     * Menampilkan halaman pendaftar yang statusnya 'Ditolak'.
     */
    public function ditolak(Request $request)
    {
        $query = Siswa::with(['user', 'sekolahAsal'])->where('status_pendaftaran', 'Ditolak');

        $this->applySearch($query, $request);

        $siswas = $query->latest()->paginate(10)->withQueryString();

        return view('admin.pendaftaran.ditolak', compact('siswas'));
    }

    /**
     * Menampilkan semua pendaftar.
     */
    public function semuaPendaftar(Request $request)
    {
        $query = Siswa::with(['user', 'sekolahAsal']); // Load User & Sekolah

        if ($request->filled('status')) {
            $query->where('status_pendaftaran', $request->status);
        }

        $this->applySearch($query, $request);

        $siswas = $query->latest()->paginate(10)->withQueryString();

        return view('admin.pendaftaran.semua', compact('siswas'));
    }

    
    public function exportExcel(Request $request)
    {
        $fileName = 'data-pendaftar-' . date('Y-m-d') . '.xlsx';
        return Excel::download(new SiswasExport($request), $fileName);
    }

    public function detail(Siswa $siswa)
    {
        $siswa->load(['lampiran', 'orangTua', 'user', 'sekolahAsal']); // Load user juga
        return view('admin.pendaftaran.detail', compact('siswa'));
    }

    public function terima(Siswa $siswa)
    {
        if ($siswa->status_pendaftaran !== 'Diterima') {
            $siswa->update(['status_pendaftaran' => 'Diterima']);
            return back()->with('success', "Siswa {$siswa->nama_lengkap} berhasil diterima.");
        }
        return back();
    }

    public function tolak(Siswa $siswa)
    {
        if ($siswa->status_pendaftaran !== 'Ditolak') {
            $siswa->update(['status_pendaftaran' => 'Ditolak']);
            return back()->with('success', "Siswa {$siswa->nama_lengkap} berhasil ditolak.");
        }
        return back();
    }

    public function batalkan(Siswa $siswa)
    {
        if ($siswa->status_pendaftaran !== 'Pending') {
            $siswa->update(['status_pendaftaran' => 'Pending']);
            return back()->with('success', "Status {$siswa->nama_lengkap} dikembalikan ke Pending.");
        }
        return back();
    }
}