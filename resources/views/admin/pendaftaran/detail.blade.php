@extends('layouts.admin')

@section('title', 'Detail Pendaftar')

@section('content')
<div class="p-4 sm:p-6 mt-12">
    {{-- Header Halaman --}}
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Detail Pendaftar
            </h1>
            <p class="text-sm text-gray-500 mt-1">Lihat rincian lengkap data calon siswa.</p>
        </div>
        {{-- Mengganti url()->previous() dengan javascript:history.back() untuk memastikan fungsionalitas kembali --}}
        <a href="javascript:history.back()" class="mt-4 sm:mt-0 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">
            &larr; Kembali
        </a>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Kontainer Utama --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Kolom Kiri: Detail Data --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Memanggil partial yang menampilkan detail data siswa --}}
            @include('partials.siswa.detail-siswa')
        </div>

        {{-- Kolom Kanan: Aksi & Status --}}
        <div class="lg:col-span-1 space-y-6">
            {{-- Card Aksi --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white border-b dark:border-gray-600 pb-3 mb-4">Aksi Verifikasi</h3>
                <p class="text-sm text-gray-500 mb-4">Ubah status pendaftaran untuk siswa ini.</p>
                <div class="flex flex-col space-y-3">
                    @if ($siswa->status_pendaftaran == 'Pending')
                        <form action="{{ route('admin.pendaftaran.terima', $siswa) }}" method="POST" onsubmit="return confirm('Yakin ingin MENERIMA siswa ini?')">
                            @csrf @method('PATCH')
                            <button type="submit" class="w-full text-center text-white bg-green-500 hover:bg-green-600 font-medium rounded-lg text-sm px-5 py-2.5">
                                Terima Pendaftaran
                            </button>
                        </form>
                        <form action="{{ route('admin.pendaftaran.tolak', $siswa) }}" method="POST" onsubmit="return confirm('Yakin ingin MENOLAK siswa ini?')">
                            @csrf @method('PATCH')
                            <button type="submit" class="w-full text-center text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-5 py-2.5">
                                Tolak Pendaftaran
                            </button>
                        </form>
                    @else
                         <form action="{{ route('admin.pendaftaran.batalkan', $siswa) }}" method="POST" onsubmit="return confirm('Yakin ingin MEMBATALKAN status siswa ini?')">
                            @csrf @method('PATCH')
                            <button type="submit" class="w-full text-center text-white bg-gray-500 hover:bg-gray-600 font-medium rounded-lg text-sm px-5 py-2.5">
                                Kembalikan ke Pending
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            {{-- Card Status --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5">
                 <h3 class="text-lg font-semibold text-gray-800 dark:text-white border-b dark:border-gray-600 pb-3 mb-4">Status Saat Ini</h3>
                 <div @class([
                        'p-4 rounded-lg text-center',
                        'bg-yellow-100 text-yellow-800' => $siswa->status_pendaftaran == 'Pending',
                        'bg-green-100 text-green-800' => $siswa->status_pendaftaran == 'Diterima',
                        'bg-red-100 text-red-800' => $siswa->status_pendaftaran == 'Ditolak',
                    ])>
                    <span class="font-bold text-lg uppercase">{{ $siswa->status_pendaftaran }}</span>
                 </div>
            </div>

        </div>
    </div>
</div>
@endsection

