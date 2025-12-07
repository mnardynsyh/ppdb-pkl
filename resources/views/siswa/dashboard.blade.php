@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')

@section('content')
@php
    $dataBelumLengkap = !$siswa || empty($siswa->alamat) || empty($siswa->sekolahAsal);
    $status = $dataBelumLengkap ? null : $siswa->status_pendaftaran;

    $statusData = [];

    // CASE 0: DATA BELUM LENGKAP
    if ($dataBelumLengkap) {
        $statusData = [
            'bg_card' => 'bg-white border border-neutral-200',
            'text_accent' => 'text-neutral-500',
            'badge_class' => 'bg-neutral-100 text-neutral-600 border-neutral-200',
            'icon' => '<div class="w-12 h-12 bg-neutral-50 rounded-2xl flex items-center justify-center text-neutral-400 border border-neutral-100"><i class="fa-solid fa-file-pen text-xl"></i></div>',
            'judul' => 'Lengkapi Pendaftaran',
            'pesan' => 'Halo! Akun Anda telah aktif. Langkah selanjutnya adalah melengkapi formulir biodata, data orang tua, dan sekolah asal untuk mendapatkan Nomor Pendaftaran.',
            'tombol_teks' => 'Mulai Isi Formulir',
            'tombol_link' => route('siswa.formulir'),
            'tombol_class' => 'bg-primary-600 hover:bg-primary-700 text-white shadow-lg shadow-primary-200',
            'progress' => 0, 
            'step3_color' => 'primary'
        ];
    }
    // CASE 1: PENDING (Menunggu Verifikasi)
    elseif ($status === 'Pending') {
        $statusData = [
            'bg_card' => 'bg-gradient-to-br from-white to-yellow-50 border border-yellow-100',
            'text_accent' => 'text-yellow-600',
            'badge_class' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
            'icon' => '<div class="w-12 h-12 bg-yellow-100 rounded-2xl flex items-center justify-center text-yellow-600 border border-yellow-200"><i class="fa-solid fa-hourglass-half text-xl animate-pulse"></i></div>',
            'judul' => 'Menunggu Verifikasi',
            'pesan' => 'Terima kasih! Data pendaftaran Anda telah lengkap dan sedang dalam proses pemeriksaan oleh Panitia PPDB.',
            'tombol_teks' => 'Perbarui Data',
            'tombol_link' => route('siswa.formulir'),
            'tombol_class' => 'bg-yellow-600 hover:bg-yellow-700 text-white shadow-lg shadow-yellow-200',
            'progress' => 2, 
            'step3_color' => 'primary'
        ];
    }
    // CASE 2: DITERIMA (Gunakan Primary Teal)
    elseif ($status === 'Diterima') {
        $statusData = [
            'bg_card' => 'bg-gradient-to-br from-white to-primary-50 border border-primary-100',
            'text_accent' => 'text-primary-600',
            'badge_class' => 'bg-primary-100 text-primary-700 border-primary-200',
            'icon' => '<div class="w-12 h-12 bg-primary-100 rounded-2xl flex items-center justify-center text-primary-600 border border-primary-200"><i class="fa-solid fa-circle-check text-xl"></i></div>',
            'judul' => 'Selamat! Anda Diterima',
            'pesan' => 'Selamat! Anda dinyatakan LULUS seleksi penerimaan siswa baru. Silakan cetak bukti pendaftaran sebagai syarat daftar ulang.',
            'tombol_teks' => 'Cetak Bukti',
            'tombol_link' => route('siswa.cetak-bukti'),
            'tombol_class' => 'bg-primary-600 hover:bg-primary-700 text-white shadow-lg shadow-primary-200',
            'tombol_secondary' => [
                'text' => 'Lihat Detail',
                'link' => route('siswa.detail'),
            ],
            'progress' => 3,
            'step3_color' => 'primary'
        ];
    }
    // CASE 3: DITOLAK
    elseif ($status === 'Ditolak') {
        $statusData = [
            'bg_card' => 'bg-gradient-to-br from-white to-rose-50 border border-rose-100',
            'text_accent' => 'text-rose-600',
            'badge_class' => 'bg-rose-100 text-rose-700 border-rose-200',
            'icon' => '<div class="w-12 h-12 bg-rose-100 rounded-2xl flex items-center justify-center text-rose-600 border border-rose-200"><i class="fa-solid fa-circle-xmark text-xl"></i></div>',
            'judul' => 'Mohon Maaf',
            'pesan' => 'Berdasarkan hasil seleksi dan kuota yang tersedia, Anda dinyatakan TIDAK LULUS. Tetap semangat!',
            'tombol_teks' => 'Lihat Detail',
            'tombol_link' => route('siswa.detail'),
            'tombol_class' => 'bg-white border border-neutral-300 text-neutral-700 hover:bg-neutral-50',
            'progress' => 3,
            'step3_color' => 'rose'
        ];
    }
@endphp

<div class="space-y-8">

    {{-- Section 1: Header Welcome --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-4 border-b border-neutral-200">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-neutral-900 tracking-tight">
                Selamat Datang, 
                <span class="text-primary-600">
                    {{ strtok($siswa->nama_lengkap ?? Auth::user()->name, ' ') }}
                </span>!
            </h1>
            <p class="text-neutral-500 text-sm mt-1">Pantau status pendaftaran Anda secara berulang di sini.</p>
        </div>
        
        <div class="hidden md:block text-right">
            <p class="text-xs font-bold text-neutral-400 uppercase tracking-widest">{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
        </div>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition.opacity class="rounded-xl bg-primary-50 border border-primary-100 p-4 shadow-sm flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-primary-100 p-1.5 rounded-full text-primary-600">
                    <i class="fa-solid fa-check text-xs"></i>
                </div>
                <p class="text-primary-800 text-sm font-bold">{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="text-primary-400 hover:text-primary-600 transition-colors">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        {{-- Left Column: Main Status & Timeline --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- MAIN STATUS CARD --}}
            <div class="rounded-3xl border shadow-sm overflow-hidden transition-all relative {{ $statusData['bg_card'] }}">
                
                {{-- Decorative Blob --}}
                @if(!$dataBelumLengkap)
                    <div class="absolute top-0 right-0 w-48 h-48 bg-white opacity-40 rounded-full blur-3xl -z-0 translate-x-1/3 -translate-y-1/3"></div>
                @endif

                <div class="p-6 md:p-8 relative z-10">
                    <div class="flex flex-col sm:flex-row items-start gap-6">
                        
                        {{-- Icon --}}
                        <div class="shrink-0">
                            {!! $statusData['icon'] !!}
                        </div>
                        
                        {{-- Text Content --}}
                        <div class="flex-1 w-full">
                            <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                                <h2 class="text-xl font-bold text-neutral-900">{{ $statusData['judul'] }}</h2>
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $statusData['badge_class'] }}">
                                    {{ $dataBelumLengkap ? 'Belum Daftar' : ($siswa->status_pendaftaran ?? 'Draft') }}
                                </span>
                            </div>
                            
                            <p class="text-neutral-600 text-sm leading-relaxed mb-6">
                                {{ $statusData['pesan'] }}
                            </p>
                            
                            {{-- Action Buttons --}}
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ $statusData['tombol_link'] }}" 
                                   class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-bold rounded-xl shadow-sm transition-all transform hover:-translate-y-0.5 hover:shadow-md {{ $statusData['tombol_class'] }}"
                                   @if($status === 'Diterima' && $statusData['tombol_teks'] == 'Cetak Bukti') target="_blank" @endif>
                                    {{ $statusData['tombol_teks'] }}
                                    <i class="fa-solid fa-arrow-right ml-2 text-xs opacity-80"></i>
                                </a>

                                @if(isset($statusData['tombol_secondary']))
                                    <a href="{{ $statusData['tombol_secondary']['link'] }}"
                                       class="inline-flex items-center px-5 py-2.5 text-sm font-bold rounded-xl border border-neutral-200 bg-white text-neutral-600 hover:bg-neutral-50 hover:text-neutral-900 transition-colors">
                                        {{ $statusData['tombol_secondary']['text'] }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TIMELINE PROGRESS --}}
            <div class="bg-white rounded-3xl border border-neutral-200 p-6 md:p-8 shadow-sm">
                <h3 class="text-xs font-bold text-neutral-400 uppercase tracking-widest mb-8 flex items-center gap-2">
                    <i class="fa-solid fa-list-check text-primary-600"></i>
                    Tahapan Pendaftaran
                </h3>
                
                <div class="relative px-2">
                    {{-- Connecting Line Background --}}
                    <div class="absolute left-0 top-3.5 w-full h-1 bg-neutral-100 rounded-full" aria-hidden="true">
                        {{-- Active Progress Line --}}
                        <div class="h-full bg-primary-500 rounded-full transition-all duration-1000 ease-out" 
                             style="width: {{ $statusData['progress'] == 0 ? '0' : ($statusData['progress'] - 1) * 50 }}%"></div>
                    </div>
                    
                    <ul class="relative flex justify-between w-full">
                        {{-- Step 1 --}}
                        <li class="relative">
                            <div class="flex flex-col items-center group cursor-default">
                                <div class="w-8 h-8 flex items-center justify-center rounded-full text-xs font-bold z-10 transition-all duration-300 ring-4 ring-white
                                    {{ $statusData['progress'] >= 1 ? 'bg-primary-600 text-white shadow-lg shadow-primary-200 scale-110' : 'bg-white border-2 border-primary-500 text-primary-600' }}">
                                    @if($statusData['progress'] > 1) <i class="fa-solid fa-check"></i> @else 1 @endif
                                </div>
                                <span class="absolute top-10 text-[10px] md:text-xs font-bold text-center w-24 transition-colors {{ $statusData['progress'] >= 1 ? 'text-neutral-900' : 'text-primary-600' }}">
                                    Isi Formulir
                                </span>
                            </div>
                        </li>

                        {{-- Step 2 --}}
                        <li class="relative">
                            <div class="flex flex-col items-center group cursor-default">
                                <div class="w-8 h-8 flex items-center justify-center rounded-full text-xs font-bold z-10 transition-all duration-300 ring-4 ring-white
                                    {{ $statusData['progress'] >= 2 ? 'bg-primary-600 text-white shadow-lg shadow-primary-200 scale-110' : ($statusData['progress'] == 2 ? 'bg-yellow-500 text-white animate-pulse' : 'bg-white border-2 border-neutral-200 text-neutral-400') }}">
                                    @if($statusData['progress'] > 2) <i class="fa-solid fa-check"></i> @else 2 @endif
                                </div>
                                <span class="absolute top-10 text-[10px] md:text-xs font-bold text-center w-24 transition-colors {{ $statusData['progress'] >= 2 ? 'text-neutral-900' : 'text-neutral-400' }}">
                                    Verifikasi
                                </span>
                            </div>
                        </li>

                        {{-- Step 3 --}}
                        <li class="relative">
                            <div class="flex flex-col items-center group cursor-default">
                                <div class="w-8 h-8 flex items-center justify-center rounded-full text-xs font-bold z-10 transition-all duration-300 ring-4 ring-white
                                    @if($statusData['progress'] >= 3)
                                        {{ $statusData['step3_color'] === 'rose'
                                            ? 'bg-rose-600 text-white shadow-lg shadow-rose-200 scale-110'
                                            : 'bg-primary-600 text-white shadow-lg shadow-primary-200 scale-110'
                                        }}
                                    @else
                                        bg-white border-2 border-neutral-200 text-neutral-400
                                    @endif
                                ">
                                    3
                                </div>
                                <span class="absolute top-10 text-[10px] md:text-xs font-bold text-center w-24 transition-colors {{ $statusData['progress'] >= 3 ? 'text-neutral-900' : 'text-neutral-400' }}">
                                    Pengumuman
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="h-6"></div>
            </div>
        </div>

        {{-- Right Column: Info Akun (1/3 width) --}}
        <div class="space-y-6">
            
            <div class="bg-white rounded-3xl border border-neutral-200 p-6 shadow-sm">
                <h3 class="text-xs font-bold text-neutral-400 uppercase tracking-widest mb-6 flex items-center justify-between">
                    Informasi Akun
                </h3>
                
                <div class="space-y-4">
                    {{-- Nama Lengkap --}}
                    <div class="flex items-center p-3 rounded-xl bg-neutral-50 border border-neutral-100">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-neutral-400 border border-neutral-100 mr-3 shadow-sm">
                            <i class="fa-solid fa-user text-sm"></i>
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-[10px] text-neutral-400 uppercase font-bold tracking-wider mb-0.5">Nama Lengkap</p>
                            <p class="text-sm font-bold text-neutral-900 truncate">{{ $siswa->nama_lengkap ?? Auth::user()->name }}</p>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="flex items-center p-3 rounded-xl bg-neutral-50 border border-neutral-100">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-neutral-400 border border-neutral-100 mr-3 shadow-sm">
                            <i class="fa-solid fa-envelope text-sm"></i>
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-[10px] text-neutral-400 uppercase font-bold tracking-wider mb-0.5">Email</p>
                            <p class="text-sm font-bold text-neutral-900 truncate">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    {{-- Tanggal Daftar --}}
                    <div class="flex items-center p-3 rounded-xl bg-neutral-50 border border-neutral-100">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-neutral-400 border border-neutral-100 mr-3 shadow-sm">
                            <i class="fa-regular fa-calendar text-sm"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-neutral-400 uppercase font-bold tracking-wider mb-0.5">Terdaftar Sejak</p>
                            <p class="text-sm font-bold text-neutral-900">
                                {{ ($siswa && $siswa->created_at) ? $siswa->created_at->isoFormat('dddd, D MMMM Y') : '-' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Tombol Edit Profil hanya jika data sudah ada dan masih pending --}}
                @if(!$dataBelumLengkap && $status === 'Pending')
                    <div class="mt-6 pt-4 border-t border-neutral-100">
                        <a href="{{ route('siswa.formulir') }}" class="flex items-center justify-center gap-2 w-full py-3 text-xs font-bold text-primary-700 bg-primary-50 hover:bg-primary-100 rounded-xl transition-colors border border-primary-100">
                            <i class="fa-solid fa-pen-to-square"></i> Edit Biodata
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection