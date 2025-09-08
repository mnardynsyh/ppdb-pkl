@extends('layouts.siswa')

@section('title', 'Status Pendaftaran')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto py-10 sm:py-16 px-4 sm:px-6 lg:px-8">
        
        {{-- Tombol Logout --}}
        <div class="absolute top-4 right-4 md:top-6 md:right-6">
            <form action="{{ route('siswa.logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="px-3 py-2 bg-white/80 backdrop-blur-sm text-gray-700 rounded-lg hover:bg-gray-200 transition duration-300 flex items-center gap-2 text-sm shadow-sm border">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span class="hidden sm:inline">Logout</span>
                </button>
            </form>
        </div>

        {{-- Header Halaman --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Status Pendaftaran Anda</h1>
            <p class="text-gray-500 mt-2">Terima kasih telah melakukan pendaftaran. Berikut adalah ringkasan data Anda.</p>
        </div>

        {{-- [BARU] Kartu Status Utama --}}
        <div @class([
            'p-6 rounded-xl shadow-lg border-t-4 mb-8 text-center',
            'bg-yellow-50 border-yellow-400' => $siswa->status_pendaftaran == 'Pending',
            'bg-green-50 border-green-400' => $siswa->status_pendaftaran == 'Diterima',
            'bg-red-50 border-red-400' => $siswa->status_pendaftaran == 'Ditolak',
        ]) data-aos="fade-up">
            <div @class([
                'mx-auto w-16 h-16 rounded-full flex items-center justify-center mb-4',
                'bg-yellow-100 text-yellow-600' => $siswa->status_pendaftaran == 'Pending',
                'bg-green-100 text-green-600' => $siswa->status_pendaftaran == 'Diterima',
                'bg-red-100 text-red-600' => $siswa->status_pendaftaran == 'Ditolak',
            ])>
                @if($siswa->status_pendaftaran == 'Pending')
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                @elseif($siswa->status_pendaftaran == 'Diterima')
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                @else
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                @endif
            </div>
            <h2 class="text-2xl font-bold uppercase">{{ $siswa->status_pendaftaran }}</h2>
            
            {{-- Pesan Status Dinamis --}}
            <p class="text-gray-600 mt-2 max-w-md mx-auto">
                @if($siswa->status_pendaftaran == 'Pending')
                    Data Anda sedang dalam proses verifikasi oleh panitia. Anda masih dapat mengubah data jika diperlukan.
                @elseif($siswa->status_pendaftaran == 'Diterima')
                    Selamat! Pendaftaran Anda telah kami terima. Silakan cetak bukti pendaftaran dan tunggu informasi selanjutnya.
                @else
                    Mohon maaf, pendaftaran Anda ditolak. Silakan hubungi panitia untuk informasi lebih lanjut.
                @endif
            </p>

            {{-- Tombol Aksi Dinamis --}}
            <div class="mt-6">
                @if($siswa->status_pendaftaran == 'Pending')
                    <a href="{{ route('siswa.dashboard', ['action' => 'edit']) }}" 
                       class="inline-block px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-semibold shadow">
                        Ubah Data Pendaftaran
                    </a>
                @elseif($siswa->status_pendaftaran == 'Diterima')
                     <a href="#" 
                       class="inline-block px-5 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm font-semibold shadow">
                        Cetak Bukti Pendaftaran
                    </a>
                @endif
            </div>
        </div>

        {{-- [DIPERBARUI] Memanggil partial detail siswa yang sudah ada --}}
        @include('partials.siswa.detail-siswa')
        
    </div>
</div>
@endsection

