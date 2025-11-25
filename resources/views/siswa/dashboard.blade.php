@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')

@section('content')
@php
    $status = $siswa->status_pendaftaran;

    // CASE 1: DRAFT / BELUM LENGKAP
    if ($status === null || $status === '') {
        $statusData = [
            'bg_card' => 'bg-gradient-to-br from-white to-blue-50 border-blue-100',
            'text_accent' => 'text-blue-600',
            'badge_class' => 'bg-blue-100 text-blue-700 border-blue-200',
            'icon' => '<svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414
                a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>',
            'judul' => 'Lengkapi Formulir',
            'pesan' => 'Lengkapi biodata Anda untuk mendapatkan nomor pendaftaran.',
            'tombol_teks' => 'Lanjutkan Pengisian',
            'tombol_link' => route('siswa.formulir'),
            'tombol_class' => 'bg-blue-600 hover:bg-blue-700 text-white shadow-blue-200',
            'progress' => 1,
            'step3_color' => 'emerald'
        ];
    }

    // CASE 2: PENDING (Masih bisa edit)
    if ($status === 'Pending') {
        $statusData = [
            'bg_card' => 'bg-gradient-to-br from-white to-amber-50 border-amber-100',
            'text_accent' => 'text-amber-600',
            'badge_class' => 'bg-amber-100 text-amber-700 border-amber-200',
            'icon' => '<svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor"
                viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
            'judul' => 'Menunggu Verifikasi',
            'pesan' => 'Data Anda sedang diperiksa. Anda masih boleh memperbaiki formulir.',
            'tombol_teks' => 'Perbaiki Formulir',
            'tombol_link' => route('siswa.formulir'),
            'tombol_class' => 'bg-amber-600 hover:bg-amber-700 text-white shadow-amber-200',
            'progress' => 2,
            'step3_color' => 'emerald'
        ];
    }

    // CASE 3: DITERIMA → Ada 2 tombol
    if ($status === 'Diterima') {
        $statusData = [
            'bg_card' => 'bg-gradient-to-br from-white to-emerald-50 border-emerald-100',
            'text_accent' => 'text-emerald-600',
            'badge_class' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
            'icon' => '<svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor"
                viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
            'judul' => 'Selamat! Anda Diterima',
            'pesan' => 'Anda dinyatakan lulus. Silakan cetak bukti pendaftaran.',
            'tombol_teks' => 'Cetak Bukti Pendaftaran',
            'tombol_link' => route('siswa.cetak-bukti'),
            'tombol_class' => 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-200',
            'tombol_secondary' => [
                'text' => 'Lihat Detail Data',
                'link' => route('siswa.detail'),
            ],
            'progress' => 3,
            'step3_color' => 'emerald'
        ];
    }

    // CASE 4: DITOLAK → 1 tombol "Lihat Detail"
    if ($status === 'Ditolak') {
        $statusData = [
            'bg_card' => 'bg-gradient-to-br from-white to-red-50 border-red-100',
            'text_accent' => 'text-red-600',
            'badge_class' => 'bg-red-100 text-red-700 border-red-200',
            'icon' => '<svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
            'judul' => 'Tidak Lulus Seleksi',
            'pesan' => 'Anda dinyatakan tidak lulus. Anda masih dapat melihat detail data.',
            'tombol_teks' => 'Lihat Detail Data',
            'tombol_link' => route('siswa.detail'),
            'tombol_class' => 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50',
            'progress' => 3,
            'step3_color' => 'red'
        ];
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
        </div>

        {{-- Jika Pendaftaran Ditutup --}}
        @if(isset($pengaturan) && $pengaturan->status === 'Ditutup')
            <div class="rounded-2xl bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200 p-6 md:p-8 shadow-sm mb-6">
                <div class="flex items-start gap-4">
                    <div class="shrink-0">
                        <div class="w-12 h-12 rounded-xl bg-white border border-gray-200 flex items-center justify-center">
                            <svg class="w-7 h-7 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M5.07 19h13.86A2.07 2.07 0 0021 16.93V7.07A2.07 2.07 0 0018.93 5.07H5.07A2.07 2.07 0 003 7.07v9.86A2.07 2.07 0 005.07 19z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="flex-1">
                        <h2 class="text-lg font-bold text-gray-800 mb-1">Pendaftaran Sedang Ditutup</h2>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Saat ini proses pendaftaran belum dibuka atau sedang dalam tahap finalisasi oleh panitia.
                            Silakan cek kembali secara berkala. Informasi terbaru akan ditampilkan di dashboard ini.
                        </p>
                    </div>
                </div>
            </div>
        @endif


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
                                @if(isset($statusData['tombol_secondary']))
                                    <a href="{{ $statusData['tombol_secondary']['link'] }}"
                                    class="ml-3 inline-flex items-center px-5 py-2.5 text-sm font-semibold rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                                        {{ $statusData['tombol_secondary']['text'] }}
                                    </a>
                                @endif
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
                                    <div class="
                                        w-8 h-8 flex items-center justify-center rounded-full text-xs font-bold z-10
                                        transition-all duration-300
                                        @if($statusData['progress'] >= 3)
                                            {{ $statusData['step3_color'] === 'red'
                                                ? 'bg-red-600 text-white shadow-lg shadow-red-200 scale-110'
                                                : 'bg-emerald-600 text-white shadow-lg shadow-emerald-200 scale-110'
                                            }}
                                        @else
                                            bg-white border-2 border-gray-200 text-gray-400
                                        @endif
                                    ">
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