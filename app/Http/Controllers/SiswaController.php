<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function create()
    {
        $pendidikan = DB::table('pendidikan')->get();
        $pekerjaan = DB::table('job')->get();
        $penghasilan = DB::table('penghasilan')->get();
        $agama = DB::table('agama')->get();

        
        $jenisDokumen = ['KK', 'Akta', 'Pas Foto Siswa'];

        return view('wali.input-siswa', compact('pendidikan', 'pekerjaan', 'penghasilan', 'agama', 'jenisDokumen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'id_pendidikan' => 'nullable|exists:pendidikan,id',
            'id_pekerjaan' => 'nullable|exists:pekerjaan,id',
            'id_penghasilan' => 'nullable|exists:penghasilan,id',
            'id_agama' => 'nullable|exists:agama,id',

            // validasi file dokumen
            'jenis_dokumen' => 'required|in:KK,Akta,Pas Foto Siswa',
            'file_dokumen' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'keterangan' => 'nullable|string'
        ]);

        // Simpan data siswa
        $siswa = Siswa::create([
            'id_wali' => Auth::guard('wali')->id(),
            'nama_siswa' => $request->nama_siswa,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'id_pendidikan' => $request->id_pendidikan,
            'id_pekerjaan' => $request->id_pekerjaan,
            'id_penghasilan' => $request->id_penghasilan,
            'id_agama' => $request->id_agama,
        ]);

        // Upload file dokumen ke folder storage/app/public/uploads
        if ($request->hasFile('file_dokumen')) {
            $filePath = $request->file('file_dokumen')->store('uploads', 'public');

            Upload::create([
                'id_siswa' => $siswa->id_siswa,
                'jenis_dokumen' => $request->jenis_dokumen,
                'path_file' => $filePath,
                'keterangan' => $request->keterangan
            ]);
        }

        return redirect()->route('wali.input-siswa')->with('success', 'Data siswa dan dokumen berhasil disimpan!');
    }
}
