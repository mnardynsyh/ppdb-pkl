@extends('layouts.siswa')

@section('title', 'Status Pendaftaran')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-2xl rounded-xl p-4 sm:p-8 my-6 sm:my-10 border border-gray-200 relative">
    
    {{-- Tombol Logout --}}
    <div class="absolute top-4 right-4 md:top-6 md:right-6">
        <form action="{{ route('siswa.logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300 flex items-center gap-2 text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span class="hidden sm:inline">Logout</span>
            </button>
        </form>
    </div>

    {{-- Header Halaman --}}
    <div class="text-center">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 pt-10 sm:pt-0">Status Pendaftaran Anda</h1>
        <p class="text-gray-500 mt-2">Terima kasih telah melakukan pendaftaran. Berikut adalah ringkasan data Anda.</p>
    </div>

    {{-- Banner Status Pendaftaran (FIXED) --}}
    <div @class([
        'mt-8 mb-6 p-4 rounded-lg flex flex-col sm:flex-row items-center justify-between text-center sm:text-left',
        'bg-yellow-100 text-yellow-800' => $siswa->status_pendaftaran == 'pending',
        'bg-green-100 text-green-800' => $siswa->status_pendaftaran == 'diterima',
        'bg-red-100 text-red-800' => $siswa->status_pendaftaran == 'ditolak',
    ])>
        <div class="mb-4 sm:mb-0">
            <span class="font-semibold text-lg">Status:</span>
            <span class="font-bold text-lg uppercase ml-2">{{ $siswa->status_pendaftaran }}</span>
        </div>
        <div>
            @if($siswa->status_pendaftaran == 'pending')
                <p class="text-sm mb-2">Data Anda sedang diverifikasi. Anda masih bisa mengubah data.</p>
                <a href="{{ route('siswa.dashboard', ['action' => 'edit']) }}" 
                   class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-semibold">
                    Ubah Data Pendaftaran
                </a>
            @elseif($siswa->status_pendaftaran == 'diterima')
                <p class="text-sm font-medium">Selamat! Pendaftaran Anda diterima. Silakan tunggu informasi selanjutnya.</p>
            @else
                <p class="text-sm font-medium">Mohon maaf, pendaftaran Anda ditolak. Silakan hubungi panitia.</p>
            @endif
        </div>
    </div>

    {{-- Wrapper untuk semua card data --}}
    <div class="space-y-6">
        {{-- Card: Data Calon Siswa --}}
        <div class="p-5 border rounded-lg">
            <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Data Calon Siswa</h3>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 text-sm">
                @php
                    function renderDataRow($label, $value) {
                        echo '<div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4 py-2 border-b border-gray-100">';
                        echo '<dt class="font-medium text-gray-500">' . e($label) . '</dt>';
                        echo '<dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">' . e($value) . '</dd>';
                        echo '</div>';
                    }
                @endphp
                
                @php renderDataRow('Nama Lengkap', $siswa->nama_lengkap ?? '-'); @endphp
                @php renderDataRow('NISN', $siswa->nisn ?? '-'); @endphp
                @php renderDataRow('NIK', $siswa->nik ?? '-'); @endphp
                @php renderDataRow('Jenis Kelamin', ($siswa->jenis_kelamin ?? '-') == 'L' ? 'Laki-laki' : 'Perempuan'); @endphp
                @php renderDataRow('Tempat, Tgl Lahir', ($siswa->tempat_lahir && $siswa->tanggal_lahir) ? $siswa->tempat_lahir . ', ' . \Carbon\Carbon::parse($siswa->tanggal_lahir)->isoFormat('D MMMM Y') : '-'); @endphp
                @php renderDataRow('Agama', $siswa->agama->agama ?? '-'); @endphp
                @php renderDataRow('Anak Ke-', $siswa->anak_ke ?? '-'); @endphp
                @php renderDataRow('Alamat', $siswa->alamat ?? '-'); @endphp
            </dl>
        </div>

        {{-- Card: Data Sekolah Asal --}}
        <div class="p-5 border rounded-lg">
            <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Data Sekolah Asal</h3>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 text-sm">
                @php renderDataRow('Nama Sekolah', $siswa->asal_sekolah ?? '-'); @endphp
                @php renderDataRow('Tahun Lulus', $siswa->tahun_lulus ?? '-'); @endphp
                @php renderDataRow('Alamat Sekolah', $siswa->alamat_sekolah_asal ?? '-'); @endphp
            </dl>
        </div>
        
        {{-- Card: Data Orang Tua & Wali --}}
        @if($siswa->orangTuaWali)
            <div class="p-5 border rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Data Orang Tua & Wali</h3>
                <div class="space-y-6">
                    {{-- Data Ayah --}}
                    <div>
                        <h4 class="font-semibold text-gray-600 mb-2">Data Ayah</h4>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 text-sm">
                            @php renderDataRow('Nama Lengkap', $siswa->orangTuaWali->nama_ayah ?? '-'); @endphp
                            @php renderDataRow('NIK', $siswa->orangTuaWali->nik_ayah ?? '-'); @endphp
                            @php renderDataRow('Pendidikan', $siswa->orangTuaWali->pendidikanAyah->pendidikan ?? '-'); @endphp
                            @php renderDataRow('Pekerjaan', $siswa->orangTuaWali->pekerjaanAyah->pekerjaan ?? '-'); @endphp
                            @php renderDataRow('Penghasilan', $siswa->orangTuaWali->penghasilanAyah->penghasilan ?? '-'); @endphp
                        </dl>
                    </div>
                    {{-- Data Ibu --}}
                    <div class="border-t pt-4">
                        <h4 class="font-semibold text-gray-600 mb-2">Data Ibu</h4>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 text-sm">
                            @php renderDataRow('Nama Lengkap', $siswa->orangTuaWali->nama_ibu ?? '-'); @endphp
                            @php renderDataRow('NIK', $siswa->orangTuaWali->nik_ibu ?? '-'); @endphp
                            @php renderDataRow('Pendidikan', $siswa->orangTuaWali->pendidikanIbu->pendidikan ?? '-'); @endphp
                            @php renderDataRow('Pekerjaan', $siswa->orangTuaWali->pekerjaanIbu->pekerjaan ?? '-'); @endphp
                            @php renderDataRow('Penghasilan', $siswa->orangTuaWali->penghasilanIbu->penghasilan ?? '-'); @endphp
                        </dl>
                    </div>
                    {{-- Data Wali --}}
                    @if($siswa->orangTuaWali->nama_wali)
                        <div class="border-t pt-4">
                            <h4 class="font-semibold text-gray-600 mb-2">Data Wali</h4>
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 text-sm">
                                @php renderDataRow('Nama Lengkap', $siswa->orangTuaWali->nama_wali ?? '-'); @endphp
                                @php renderDataRow('NIK', $siswa->orangTuaWali->nik_wali ?? '-'); @endphp
                                @php renderDataRow('Pekerjaan', $siswa->orangTuaWali->pekerjaanWali->pekerjaan ?? '-'); @endphp
                                @php renderDataRow('Penghasilan', $siswa->orangTuaWali->penghasilanWali->penghasilan ?? '-'); @endphp
                            </dl>
                        </div>
                    @endif
                </div>
            </div>
        @endif
        
        {{-- Card: Berkas Terunggah --}}
        <div class="p-5 border rounded-lg">
            <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Berkas Terunggah</h3>
            <ul class="text-sm space-y-2">
                @forelse ($siswa->lampiran->keyBy('jenis_berkas') as $jenis => $file)
                     <li class="flex items-center justify-between p-2 bg-gray-50 rounded-md">
                        <span class="font-medium text-gray-600">{{ ucwords(str_replace('_', ' ', $jenis)) }}</span>
                        <a href="{{ Storage::url($file->path_file) }}" target="_blank" class="text-blue-600 hover:underline font-semibold">Lihat Berkas</a>
                    </li>
                @empty
                    <p class="text-gray-500">Belum ada berkas yang diunggah.</p>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection

