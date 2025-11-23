@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')

@section('content')
{{-- Logic Penentuan Status & Warna --}}
@php

    $statusData = [
        'bg_card' => 'bg-gradient-to-br from-white to-blue-50 border-blue-100',
        'text_accent' => 'text-blue-600',
        'badge_class' => 'bg-blue-100 text-blue-700 border-blue-200',
        'icon' => '<svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>',
        'judul' => 'Lengkapi Formulir',
        'pesan' => 'Pendaftaran Anda belum lengkap. Silakan isi biodata, data orang tua, dan sekolah asal untuk mendapatkan Nomor Pendaftaran.',
        'tombol_teks' => 'Lanjutkan Pengisian',
        'tombol_link' => route('siswa.formulir'),
        'tombol_class' => 'bg-blue-600 hover:bg-blue-700 text-white shadow-blue-200',
        'progress' => 1
    ];

    if (!empty($siswa->status_pendaftaran)) {
        switch ($siswa->status_pendaftaran) {
            case 'Pending':
                $statusData = [
                    'bg_card' => 'bg-gradient-to-br from-white to-amber-50 border-amber-100',
                    'text_accent' => 'text-amber-600',
                    'badge_class' => 'bg-amber-100 text-amber-700 border-amber-200',
                    'icon' => '<svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                    'judul' => 'Menunggu Verifikasi',
                    'pesan' => 'Data Anda sedang dalam proses verifikasi oleh panitia. Mohon cek secara berkala, notifikasi akan muncul di sini.',
                    'tombol_teks' => 'Cek Kelengkapan',
                    'tombol_link' => route('siswa.formulir'),
                    'tombol_class' => 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50',
                    'progress' => 2
                ];
                break;

            case 'Diterima':
                $statusData = [
                    'bg_card' => 'bg-gradient-to-br from-white to-emerald-50 border-emerald-100',
                    'text_accent' => 'text-emerald-600',
                    'badge_class' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                    'icon' => '<svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                    'judul' => 'Selamat! Anda Diterima',
                    'pesan' => 'Selamat bergabung! Anda dinyatakan LULUS seleksi. Silakan unduh bukti penerimaan untuk keperluan daftar ulang.',
                    'tombol_teks' => 'Cetak Bukti Lulus',
                    'tombol_link' => route('siswa.cetak-bukti'),
                    'tombol_class' => 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-200',
                    'progress' => 3
                ];
                break;

            case 'Ditolak':
                $statusData = [
                    'bg_card' => 'bg-gradient-to-br from-white to-red-50 border-red-100',
                    'text_accent' => 'text-red-600',
                    'badge_class' => 'bg-red-100 text-red-700 border-red-200',
                    'icon' => '<svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                    'judul' => 'Mohon Maaf',
                    'pesan' => 'Berdasarkan hasil seleksi, Anda dinyatakan TIDAK LULUS. Tetap semangat dan jangan menyerah.',
                    'tombol_teks' => 'Lihat Detail',
                    'tombol_link' => route('siswa.status'),
                    'tombol_class' => 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50',
                    'progress' => 3
                ];
                break;
        }
    }
@endphp

<div class="min-h-screen pb-12">
    <div class="max-w-6xl mx-auto space-y-8">

        {{-- Section 1: Header Welcome --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-2">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                    Selamat Datang, <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">{{ strtok($siswa->nama_lengkap ?? 'Calon Siswa', ' ') }}</span>
                </h1>
            </div>
            
            {{-- Quick Badge --}}
            @if($siswa->no_pendaftaran)
                <div class="bg-white px-4 py-2 rounded-xl border border-gray-200 shadow-sm flex items-center gap-3">
                    <div class="text-right">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">No. Pendaftaran</p>
                        <p class="text-sm font-mono font-bold text-gray-800">{{ $siswa->no_pendaftaran }}</p>
                    </div>
                    <div class="h-8 w-px bg-gray-100"></div>
                    <div class="bg-gray-100 p-1.5 rounded-lg">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                    </div>
                </div>
            @endif
        </div>

        {{-- Flash Message --}}
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition class="rounded-xl bg-white border border-green-100 p-4 shadow-sm flex justify-between items-center mb-6">
                <div class="flex items-center gap-3">
                    <div class="bg-green-50 p-1.5 rounded-full text-green-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <p class="text-gray-700 text-sm font-medium">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            {{-- Left Column: Main Status (2/3 width) --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- MAIN STATUS CARD --}}
                <div class="rounded-2xl border shadow-sm overflow-hidden transition-all {{ $statusData['bg_card'] }}">
                    <div class="p-6 md:p-8">
                        <div class="flex flex-col sm:flex-row items-start gap-5">
                            {{-- Icon Wrapper with Soft Glow --}}
                            <div class="shrink-0 relative">
                                <div class="w-12 h-12 rounded-xl bg-white border border-white/50 shadow-sm flex items-center justify-center relative z-10">
                                    {!! $statusData['icon'] !!}
                                </div>
                                <div class="absolute inset-0 bg-white/40 blur-lg z-0"></div>
                            </div>
                            
                            {{-- Text Content --}}
                            <div class="flex-1 w-full">
                                <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                                    <h2 class="text-xl font-bold text-gray-900">{{ $statusData['judul'] }}</h2>
                                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $statusData['badge_class'] }}">
                                        {{ $siswa->status_pendaftaran ?? 'Draft' }}
                                    </span>
                                </div>
                                <p class="text-gray-600 text-sm leading-relaxed mb-6">
                                    {{ $statusData['pesan'] }}
                                </p>
                                
                                <a href="{{ $statusData['tombol_link'] }}" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold rounded-lg shadow-sm transition-all transform hover:-translate-y-0.5 {{ $statusData['tombol_class'] }}">
                                    {{ $statusData['tombol_teks'] }}
                                    <svg class="ml-2 w-4 h-4 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TIMELINE --}}
                <div class="bg-white rounded-2xl border border-gray-200 p-6 md:p-8">
                    <h3 class="text-sm font-bold text-gray-900 mb-8 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Tracking Pendaftaran
                    </h3>
                    
                    <div class="relative px-2">
                        {{-- Connecting Line --}}
                        <div class="absolute left-0 top-3.5 w-full h-0.5 bg-gray-100" aria-hidden="true">
                            <div class="h-full bg-blue-500 transition-all duration-1000 ease-out" style="width: {{ ($statusData['progress'] - 1) * 50 }}%"></div>
                        </div>
                        
                        <ul class="relative flex justify-between w-full">
                            {{-- Step 1 --}}
                            <li class="relative">
                                <div class="flex flex-col items-center group cursor-default">
                                    <div class="w-8 h-8 flex items-center justify-center rounded-full text-xs font-bold z-10 transition-all duration-300
                                        {{ $statusData['progress'] >= 1 ? 'bg-blue-600 text-white shadow-lg shadow-blue-200 scale-110' : 'bg-white border-2 border-gray-200 text-gray-400' }}">
                                        @if($statusData['progress'] > 1) ✓ @else 1 @endif
                                    </div>
                                    <span class="absolute top-10 text-[10px] md:text-xs font-semibold text-center w-24 transition-colors {{ $statusData['progress'] >= 1 ? 'text-gray-900' : 'text-gray-400' }}">
                                        Isi Formulir
                                    </span>
                                </div>
                            </li>

                            {{-- Step 2 --}}
                            <li class="relative">
                                <div class="flex flex-col items-center group cursor-default">
                                    <div class="w-8 h-8 flex items-center justify-center rounded-full text-xs font-bold z-10 transition-all duration-300
                                        {{ $statusData['progress'] >= 2 ? 'bg-blue-600 text-white shadow-lg shadow-blue-200 scale-110' : ($statusData['progress'] == 1 && $siswa->status_pendaftaran != null ? 'bg-amber-500 text-white animate-pulse' : 'bg-white border-2 border-gray-200 text-gray-400') }}">
                                        @if($statusData['progress'] > 2) ✓ @else 2 @endif
                                    </div>
                                    <span class="absolute top-10 text-[10px] md:text-xs font-semibold text-center w-24 transition-colors {{ $statusData['progress'] >= 2 ? 'text-gray-900' : 'text-gray-400' }}">
                                        Verifikasi
                                    </span>
                                </div>
                            </li>

                            {{-- Step 3 --}}
                            <li class="relative">
                                <div class="flex flex-col items-center group cursor-default">
                                    <div class="w-8 h-8 flex items-center justify-center rounded-full text-xs font-bold z-10 transition-all duration-300
                                        {{ $statusData['progress'] >= 3 ? ($statusData['warna'] == 'red' ? 'bg-red-500 text-white' : 'bg-emerald-600 text-white shadow-lg shadow-emerald-200 scale-110') : 'bg-white border-2 border-gray-200 text-gray-400' }}">
                                        3
                                    </div>
                                    <span class="absolute top-10 text-[10px] md:text-xs font-semibold text-center w-24 transition-colors {{ $statusData['progress'] >= 3 ? 'text-gray-900' : 'text-gray-400' }}">
                                        Pengumuman
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="h-8"></div> {{-- Spacer --}}
                </div>
            </div>

            {{-- Right Column: Info Akun & Summary (1/3 width) --}}
            <div class="space-y-6">
                
                {{-- Data Ringkas (Grid Style) --}}
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                    <h3 class="text-sm font-bold text-gray-900 mb-4 flex items-center justify-between">
                        Informasi Akun
                        <span class="text-[10px] bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full">Personal</span>
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-center p-3 rounded-lg bg-gray-50 border border-gray-100">
                            <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-gray-400 border border-gray-100 mr-3 shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <div class="overflow-hidden">
                                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Nama Lengkap</p>
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $siswa->nama_lengkap ?? Auth::user()->name }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 rounded-lg bg-gray-50 border border-gray-100">
                            <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-gray-400 border border-gray-100 mr-3 shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div class="overflow-hidden">
                                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Email</p>
                                <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->email }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 rounded-lg bg-gray-50 border border-gray-100">
                            <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-gray-400 border border-gray-100 mr-3 shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Tanggal Daftar</p>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $siswa->created_at ? $siswa->created_at->format('d M Y') : '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    @if(!$siswa->status_pendaftaran)
                        <div class="mt-4">
                            <a href="{{ route('siswa.formulir') }}" class="block w-full text-center py-2 text-xs font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                                Edit Profil
                            </a>
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
</div>
@endsection