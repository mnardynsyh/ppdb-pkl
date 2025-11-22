<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Lampiran;
use App\Models\OrangTua;
use App\Models\Provinsi;
use App\Models\SekolahAsal;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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

    /** Helper */
    private function getSiswa()
    {
        return Siswa::with(['orangTua', 'lampiran', 'sekolahAsal', 'provinsi', 'kabupaten', 'kecamatan', 'desa'])
            ->where('user_id', Auth::id())
            ->first();
    }

    /** Dashboard */
    public function index()
    {
        $siswa = $this->getSiswa();

        return view('siswa.dashboard', compact('siswa'));
    }

    /** STATUS PENDAFTARAN */
    public function showStatus()
    {
        $siswa = $this->getSiswa();

        if (!$siswa) {
            return redirect()->route('siswa.formulir');
        }

        return view('siswa.status', compact('siswa'));
    }

    /** Form Pendaftaran */
    public function showForm()
    {
        $siswa = $this->getSiswa() ?? new Siswa();
        $provinsi = Provinsi::orderBy('nama')->get();

        return view('siswa.form-pendaftaran', [
            'siswa'             => $siswa,
            'agamaOptions'      => $this->agama,
            'pendidikanOptions' => $this->pendidikan,
            'penghasilanOptions'=> $this->penghasilan,
            'pekerjaanOptions'  => $this->pekerjaan,
            'provinsi'          => $provinsi,
        ]);
    }

    /** Simpan Formulir */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'   => 'required|string|max:255',

            'nik' => [
                'required',
                'digits:16',
                Rule::unique('siswa', 'nik')->ignore(Auth::id(), 'user_id'),
            ],
            'nisn' => [
                'required',
                'digits:10',
                Rule::unique('siswa', 'nisn')->ignore(Auth::id(), 'user_id'),
            ],

            'jenis_kelamin'  => 'required|in:L,P',
            'tempat_lahir'   => 'required|string|max:100',
            'tanggal_lahir'  => 'required|date',
            'agama'          => ['required', Rule::in($this->agama)],
            'anak_ke'        => 'nullable|integer|min:1',
            'alamat'         => 'required|string',
            'provinsi_id'    => 'required|exists:provinsi,id',
            'kabupaten_id'   => 'required|exists:kabupaten,id',
            'kecamatan_id'   => 'required|exists:kecamatan,id',
            'desa_id'        => 'required|exists:desa,id',

            // Ayah
            'nama_ayah'           => 'required|string|max:255',
            'nik_ayah'            => 'nullable|digits:16',
            'tempat_lahir_ayah'   => 'nullable|string|max:100',
            'tanggal_lahir_ayah'  => 'nullable|date',
            'pekerjaan_ayah'      => ['required', Rule::in($this->pekerjaan)],
            'pendidikan_ayah'     => ['required', Rule::in($this->pendidikan)],
            'penghasilan_ayah'    => ['required', Rule::in($this->penghasilan)],
            'no_hp_ayah'          => 'nullable|string|max:20',
            'agama_ayah'          => ['required', Rule::in($this->agama)],

            // Ibu
            'nama_ibu'            => 'required|string|max:255',
            'nik_ibu'             => 'nullable|digits:16',
            'tempat_lahir_ibu'    => 'nullable|string|max:100',
            'tanggal_lahir_ibu'   => 'nullable|date',
            'pekerjaan_ibu'       => ['required', Rule::in($this->pekerjaan)],
            'pendidikan_ibu'      => ['required', Rule::in($this->pendidikan)],
            'penghasilan_ibu'     => ['required', Rule::in($this->penghasilan)],
            'no_hp_ibu'           => 'nullable|string|max:20',
            'agama_ibu'           => ['required', Rule::in($this->agama)],

            // Wali
            'tinggal_dengan_wali' => 'nullable',
            'nama_wali'           => 'required_if:tinggal_dengan_wali,on|nullable|string|max:255',
            'nik_wali'            => 'nullable|digits:16',
            'tempat_lahir_wali'   => 'nullable|string|max:100',
            'tanggal_lahir_wali'  => 'nullable|date',
            'pekerjaan_wali'      => ['nullable', Rule::in($this->pekerjaan)],
            'pendidikan_wali'     => ['nullable', Rule::in($this->pendidikan)],
            'penghasilan_wali'    => ['nullable', Rule::in($this->penghasilan)],
            'no_hp_wali'          => 'nullable|string|max:20',
            'agama_wali'          => ['nullable', Rule::in($this->agama)],

            // Sekolah asal
            'asal_sekolah'        => 'required|string|max:255',
            'alamat_sekolah_asal' => 'nullable|string',
            'tahun_lulus'         => 'required|digits:4',

            // Berkas
            'berkas'              => 'nullable|array',
            'berkas.*'            => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        DB::transaction(function () use ($request, $validated) {

            // Siswa
            $siswa = Siswa::updateOrCreate(
                ['user_id' => Auth::id()],
                array_merge($validated, [
                    'status_pendaftaran' => 'pending',
                ])
            );

            // Ayah
            OrangTua::updateOrCreate(
                ['siswa_id' => $siswa->id, 'hubungan' => 'Ayah'],
                [
                    'nama_lengkap'        => $validated['nama_ayah'],
                    'nik'                 => $validated['nik_ayah'],
                    'tempat_lahir'        => $validated['tempat_lahir_ayah'],
                    'tanggal_lahir'       => $validated['tanggal_lahir_ayah'],
                    'pendidikan_terakhir' => $validated['pendidikan_ayah'],
                    'pekerjaan'           => $validated['pekerjaan_ayah'],
                    'penghasilan_bulanan' => $validated['penghasilan_ayah'],
                    'no_hp'               => $validated['no_hp_ayah'],
                    'agama'               => $validated['agama_ayah'],
                    'alamat'              => $validated['alamat'],
                ]
            );

            // Ibu
            OrangTua::updateOrCreate(
                ['siswa_id' => $siswa->id, 'hubungan' => 'Ibu'],
                [
                    'nama_lengkap'        => $validated['nama_ibu'],
                    'nik'                 => $validated['nik_ibu'],
                    'tempat_lahir'        => $validated['tempat_lahir_ibu'],
                    'tanggal_lahir'       => $validated['tanggal_lahir_ibu'],
                    'pendidikan_terakhir' => $validated['pendidikan_ibu'],
                    'pekerjaan'           => $validated['pekerjaan_ibu'],
                    'penghasilan_bulanan' => $validated['penghasilan_ibu'],
                    'no_hp'               => $validated['no_hp_ibu'],
                    'agama'               => $validated['agama_ibu'],
                    'alamat'              => $validated['alamat'],
                ]
            );

            // Wali
            if ($request->filled('nama_wali')) {
                OrangTua::updateOrCreate(
                    ['siswa_id' => $siswa->id, 'hubungan' => 'Wali'],
                    [
                        'nama_lengkap'        => $validated['nama_wali'],
                        'nik'                 => $validated['nik_wali'],
                        'tempat_lahir'        => $validated['tempat_lahir_wali'],
                        'tanggal_lahir'       => $validated['tanggal_lahir_wali'],
                        'pendidikan_terakhir' => $validated['pendidikan_wali'],
                        'pekerjaan'           => $validated['pekerjaan_wali'],
                        'penghasilan_bulanan' => $validated['penghasilan_wali'],
                        'no_hp'               => $validated['no_hp_wali'],
                        'agama'               => $validated['agama_wali'],
                        'alamat'              => $validated['alamat'],
                    ]
                );
            } else {
                OrangTua::where('siswa_id', $siswa->id)
                    ->where('hubungan', 'Wali')
                    ->delete();
            }

            // Sekolah Asal
            SekolahAsal::updateOrCreate(
                ['siswa_id' => $siswa->id],
                [
                    'nama_sekolah'    => $validated['asal_sekolah'],
                    'alamat_sekolah'  => $validated['alamat_sekolah_asal'],
                    'tahun_lulus'     => $validated['tahun_lulus'],
                ]
            );

            // Berkas upload
            if ($request->hasFile('berkas')) {
                foreach ($request->file('berkas') as $jenis => $file) {
                    $path = $file->storeAs(
                        "lampiran/{$siswa->id}",
                        $jenis.'.'.$file->getClientOriginalExtension(),
                        'public'
                    );

                    Lampiran::updateOrCreate(
                        ['siswa_id' => $siswa->id, 'jenis_berkas' => $jenis],
                        [
                            'path_file'      => $path,
                            'nama_file_asli' => $file->getClientOriginalName(),
                        ]
                    );
                }
            }
        });

        return redirect()->route('siswa.dashboard')
            ->with('success', 'Data pendaftaran berhasil disimpan.');
    }

    /** Cetak bukti */
    public function cetakBukti()
    {
        $siswa = $this->getSiswa();

        if ($siswa->status_pendaftaran !== 'diterima') {
            return redirect()->route('siswa.dashboard')
                ->with('error', 'Belum dapat mencetak bukti. Status harus diterima.');
        }

        $pdf = Pdf::loadView('siswa.cetak-bukti', compact('siswa'));
        return $pdf->stream('bukti-pendaftaran-' . $siswa->nisn . '.pdf');
    }
}
