{{-- ====================== DATA SISWA ====================== --}}
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pb-3 mb-4">
        Data Siswa
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
        <div>
            <p class="font-medium text-gray-700">Nama Lengkap</p>
            <p>{{ $siswa->nama_lengkap }}</p>
        </div>

        <div>
            <p class="font-medium text-gray-700">NISN</p>
            <p>{{ $siswa->nisn ?? '-' }}</p>
        </div>

        <div>
            <p class="font-medium text-gray-700">NIK</p>
            <p>{{ $siswa->nik ?? '-' }}</p>
        </div>

        <div>
            <p class="font-medium text-gray-700">Jenis Kelamin</p>
            <p>{{ $siswa->jenis_kelamin ?? '-' }}</p>
        </div>

        <div>
            <p class="font-medium text-gray-700">Tempat Lahir</p>
            <p>{{ $siswa->tempat_lahir ?? '-' }}</p>
        </div>

        <div>
            <p class="font-medium text-gray-700">Tanggal Lahir</p>
            <p>{{ $siswa->tanggal_lahir ?? '-' }}</p>
        </div>

        <div class="md:col-span-2">
            <p class="font-medium text-gray-700">Alamat Lengkap</p>
            <p>{{ $siswa->alamat ?? '-' }}</p>
        </div>
    </div>
</div>


{{-- ====================== DATA SEKOLAH ASAL ====================== --}}
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 mt-6">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pb-3 mb-4">
        Data Sekolah Asal
    </h2>

    @php
        $sekolah = $siswa->sekolahAsal;
    @endphp

    @if($sekolah)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
                <p class="font-medium text-gray-700">Nama Sekolah</p>
                <p>{{ $sekolah->nama_sekolah }}</p>
            </div>

            <div>
                <p class="font-medium text-gray-700">Tahun Lulus</p>
                <p>{{ $sekolah->tahun_lulus }}</p>
            </div>

            <div class="md:col-span-2">
                <p class="font-medium text-gray-700">Alamat Sekolah</p>
                <p>{{ $sekolah->alamat_sekolah }}</p>
            </div>
        </div>
    @else
        <p class="italic text-gray-500">Data sekolah asal belum diisi.</p>
    @endif
</div>


{{-- ====================== DATA ORANG TUA ====================== --}}
@php
    $ayah = $siswa->orangTua->firstWhere('hubungan', 'Ayah');
    $ibu  = $siswa->orangTua->firstWhere('hubungan', 'Ibu');
    $wali = $siswa->orangTua->firstWhere('hubungan', 'Wali');
@endphp

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 mt-6">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pb-3 mb-4">
        Data Orang Tua / Wali
    </h2>

    {{-- AYAH --}}
    <h3 class="text-lg font-bold mb-2">Ayah</h3>
    @if ($ayah)
        @include('partials.siswa.orang-tua-items', ['data' => $ayah])
    @else
        <p class="italic text-gray-500 mb-6">Data Ayah belum diisi.</p>
    @endif

    {{-- IBU --}}
    <h3 class="text-lg font-bold mb-2">Ibu</h3>
    @if ($ibu)
        @include('partials.siswa.orang-tua-items', ['data' => $ibu])
    @else
        <p class="italic text-gray-500 mb-6">Data Ibu belum diisi.</p>
    @endif

    {{-- WALI --}}
    <h3 class="text-lg font-bold mb-2">Wali</h3>
    @if ($wali)
        @include('partials.siswa.orang-tua-items', ['data' => $wali])
    @else
        <p class="italic text-gray-500">Data Wali belum diisi.</p>
    @endif
</div>


{{-- ====================== LAMPIRAN ====================== --}}
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 mt-6">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pb-3 mb-4">
        Lampiran
    </h2>

    @if ($siswa->lampiran && $siswa->lampiran->count())
        <ul class="space-y-2 text-sm">
            @foreach ($siswa->lampiran as $file)
                <li>
                    <a href="{{ asset('storage/'.$file->path) }}"
                       target="_blank"
                       class="text-blue-600 hover:underline">
                        {{ $file->jenis }} — Klik untuk lihat
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500 italic">Belum ada lampiran.</p>
    @endif
</div>
