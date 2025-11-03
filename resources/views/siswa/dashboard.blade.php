@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto py-10 sm:py-16 px-4 sm:px-6 lg:px-8">
        

        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">
                Selamat Datang, {{ strtok(Auth::user()->nama_lengkap, ' ') }}!
            </h1>
            <p class="text-gray-500 mt-2">Ini adalah pusat informasi pendaftaran Anda.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Menentukan Status Pendaftaran --}}
        @php
            $status = 'Belum Lengkap';
            $pesan = 'Anda belum melengkapi formulir pendaftaran. Silakan lengkapi data Anda sekarang.';
            $warna = 'blue';
            $tombolTeks = 'Lengkapi Pendaftaran';
            $tombolLink = route('siswa.formulir');
            $ikon = '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>';

            if ($siswa->orangTuaWali) { // Jika form sudah pernah di-submit
                switch ($siswa->status_pendaftaran) {
                    case 'Pending':
                        $status = 'Menunggu Verifikasi';
                        $pesan = 'Data Anda telah kami terima dan sedang dalam proses verifikasi oleh panitia.';
                        $warna = 'yellow';
                        $tombolTeks = 'Lihat Detail Pendaftaran';
                        $tombolLink = route('siswa.status');
                        $ikon = '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
                        break;
                    case 'Diterima':
                        $status = 'Pendaftaran Diterima';
                        $pesan = 'Selamat! Anda telah diterima. Lihat detail dan langkah selanjutnya.';
                        $warna = 'green';
                        $tombolTeks = 'Lihat Pengumuman Kelulusan';
                        $tombolLink = route('siswa.status');
                        $ikon = '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
                        break;
                    case 'Ditolak':
                        $status = 'Pendaftaran Ditolak';
                        $pesan = 'Mohon maaf, pendaftaran Anda ditolak. Lihat detail untuk informasi lebih lanjut.';
                        $warna = 'red';
                        $tombolTeks = 'Lihat Detail Pendaftaran';
                        $tombolLink = route('siswa.status');
                        $ikon = '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>';
                        break;
                }
            }
        @endphp

        {{-- Kartu Status Utama --}}
        <div class="p-6 rounded-xl shadow-lg border-t-4 mb-8 text-center bg-white border-{{$warna}}-400" data-aos="fade-up">
            <div class="mx-auto w-16 h-16 rounded-full flex items-center justify-center mb-4 bg-{{$warna}}-100 text-{{$warna}}-600">
                {!! $ikon !!}
            </div>
            <h2 class="text-2xl font-bold">{{ $status }}</h2>
            <p class="text-gray-600 mt-2 max-w-md mx-auto">{{ $pesan }}</p>
            <div class="mt-6">
                <a href="{{ $tombolLink }}" class="inline-block px-5 py-2.5 bg-{{$warna}}-600 text-white rounded-lg hover:bg-{{$warna}}-700 transition text-sm font-semibold shadow">
                    {{ $tombolTeks }}
                </a>
            </div>
        </div>
        
    </div>
</div>
@endsection

