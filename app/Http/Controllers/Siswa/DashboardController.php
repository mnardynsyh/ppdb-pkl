<?php

namespace App\Http\Controllers\Siswa;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Provinsi;
use App\Models\Siswa;
use App\Models\OrangTuaWali;
use App\Models\Lampiran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    private array $agama = ['Islam','Kristen Protestan','Kristen Katolik','Hindu','Buddha','Konghucu'];
    private array $pendidikan = [
        'Tidak Sekolah','SD/Sederajat','SMP/Sederajat','SMA/Sederajat',
        'Diploma (D1/D2/D3)','Sarjana (S1)','Magister (S2)','Doktor (S3)'
    ];
    private array $penghasilan = [
        '< Rp 1 juta','Rp 1–3 juta','Rp 3–5 juta','> Rp 5 juta','Tidak Berpenghasilan'
    ];
    private array $pekerjaan = [
        'PNS','TNI/POLRI','Karyawan Swasta','Wiraswasta','Petani',
        'Buruh','Guru/Dosen','Nelayan','Tidak Bekerja','Lainnya'
    ];

    private function siswa()
    {
        return Siswa::with(['orangTuaWali','lampiran'])
            ->find(Auth::guard('siswa')->id());
    }

    /** Dashboard */
    public function index()
    {
        $siswa = $this->siswa();

        if (!$siswa->orangTuaWali) {
            return redirect()->route('siswa.formulir');
        }

        return view('siswa.dashboard', compact('siswa'));
    }

    /** Halaman Formulir */
    public function showForm()
    {
        $siswa = $this->siswa();
        $provinsi = Provinsi::orderBy('nama')->get();

        return view('siswa.form-pendaftaran', [
            'siswa' => $siswa,
            'agamaOptions' => $this->agama,
            'pendidikanOptions' => $this->pendidikan,
            'penghasilanOptions' => $this->penghasilan,
            'pekerjaanOptions' => $this->pekerjaan,
            'provinsi' => $provinsi,
        ]);
    }

    /** Halaman Status */
    public function showStatus()
    {
        $siswa = Siswa::with([
            'lampiran','provinsi','kabupaten','kecamatan','desa','orangTuaWali'
        ])->find(Auth::guard('siswa')->id());

        return view('siswa.status', compact('siswa'));
    }

    /** Simpan Formulir */
    public function store(Request $request)
    {
        $siswa = $this->siswa();
        $orangTuaWaliId = $siswa->orangTuaWali->id ?? null;

        $validated = $request->validate([
            // STEP 1 - Data Diri
            'nama_lengkap'    => 'required|max:255',
            'nik'             => ['required','digits:16',Rule::unique('siswa')->ignore($siswa->id)],
            'nisn'            => ['required','digits:10',Rule::unique('siswa')->ignore($siswa->id)],
            'jenis_kelamin'   => 'required|in:L,P',
            'tempat_lahir'    => 'required|max:100',
            'tanggal_lahir'   => 'required|date',
            'agama'           => ['required', Rule::in($this->agama)],
            'anak_ke'         => 'nullable|integer|min:1',
            'alamat'          => 'required|string',
            'provinsi_id'     => 'required|exists:provinsi,id',
            'kabupaten_id'    => 'required|exists:kabupaten,id',
            'kecamatan_id'    => 'required|exists:kecamatan,id',
            'desa_id'         => 'required|exists:desa,id',

            // STEP 2 - Orang Tua
            'nama_ayah'             => 'required|string|max:255',
            'nik_ayah'              => ['required','digits:16',Rule::unique('orang_tua_wali','nik_ayah')->ignore($orangTuaWaliId)],
            'tempat_lahir_ayah'     => 'required|string|max:100',
            'tanggal_lahir_ayah'    => 'required|date',
            'pekerjaan_ayah'        => ['required', Rule::in($this->pekerjaan)],
            'pekerjaan_ayah_lainnya'=> 'nullable|string|max:100',
            'penghasilan_ayah'      => ['required', Rule::in($this->penghasilan)],
            'pendidikan_ayah'       => ['required', Rule::in($this->pendidikan)],
            'agama_ayah'            => ['required', Rule::in($this->agama)],

            'nama_ibu'              => 'required|string|max:255',
            'nik_ibu'               => ['required','digits:16',Rule::unique('orang_tua_wali','nik_ibu')->ignore($orangTuaWaliId)],
            'tempat_lahir_ibu'      => 'required|string|max:100',
            'tanggal_lahir_ibu'     => 'required|date',
            'pekerjaan_ibu'         => ['required', Rule::in($this->pekerjaan)],
            'pekerjaan_ibu_lainnya' => 'nullable|string|max:100',
            'penghasilan_ibu'       => ['required', Rule::in($this->penghasilan)],
            'pendidikan_ibu'        => ['required', Rule::in($this->pendidikan)],
            'agama_ibu'             => ['required', Rule::in($this->agama)],

            // STEP 2 (opsional wali)
            'tinggal_dengan_wali'   => 'nullable',
            'nama_wali'             => 'required_if:tinggal_dengan_wali,on|nullable|string|max:255',
            'nik_wali'              => ['required_if:tinggal_dengan_wali,on','nullable','digits:16', Rule::unique('orang_tua_wali','nik_wali')->ignore($orangTuaWaliId)],
            'tempat_lahir_wali'     => 'required_if:tinggal_dengan_wali,on|nullable|string|max:100',
            'tanggal_lahir_wali'    => 'required_if:tinggal_dengan_wali,on|nullable|date',
            'pekerjaan_wali'        => ['nullable', Rule::in($this->pekerjaan)],
            'pekerjaan_wali_lainnya'=> 'nullable|string|max:100',
            'penghasilan_wali'      => ['nullable', Rule::in($this->penghasilan)],
            'pendidikan_wali'       => ['nullable', Rule::in($this->pendidikan)],
            'agama_wali'            => ['nullable', Rule::in($this->agama)],

            // STEP 3 - Sekolah Asal
            'asal_sekolah'          => 'required|string|max:255',
            'alamat_sekolah_asal'   => 'nullable|string',
            'tahun_lulus'           => 'required|digits:4|integer|min:2000|max:' . date('Y'),

            // STEP 4 - Berkas
            'berkas'      => 'nullable|array',
            'berkas.*'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        /** Update Siswa */
        $siswa->update($validated);

        /** Update Orang Tua / Wali */
        OrangTuaWali::updateOrCreate(['siswa_id' => $siswa->id], $validated);

        /** Upload Berkas */
        if ($request->hasFile('berkas')) {
            foreach ($request->file('berkas') as $jenis => $file) {

                $old = Lampiran::where('siswa_id',$siswa->id)->where('jenis_berkas',$jenis)->first();
                if ($old && Storage::disk('public')->exists($old->path_file)) {
                    Storage::disk('public')->delete($old->path_file);
                }

                $path = $file->store("berkas_siswa/{$siswa->id}", 'public');

                Lampiran::updateOrCreate(
                    ['siswa_id'=>$siswa->id,'jenis_berkas'=>$jenis],
                    ['path_file'=>$path,'nama_file_asli'=>$file->getClientOriginalName()]
                );
            }
        }

        return redirect()->route('siswa.dashboard')->with('success','Data berhasil disimpan.');
    }

    /** Cetak Bukti */
    public function cetakBukti()
    {
        $siswa = $this->siswa();

        if ($siswa->status_pendaftaran !== 'Diterima') {
            return redirect()->route('siswa.dashboard')->with('error','Belum bisa mencetak bukti.');
        }

        $pdf = Pdf::loadView('siswa.cetak-bukti', compact('siswa'));
        return $pdf->stream('bukti-pendaftaran-'.$siswa->id.'.pdf');
    }
}