@extends('layouts.siswa')

@section('title', 'Detail Pendaftaran')

@section('content')
<div class="max-w-6xl mx-auto space-y-8 mb-16">

    {{-- HEADER & TOMBOL KEMBALI --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('siswa.dashboard') }}" 
           class="group flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white border border-neutral-200 text-neutral-500 shadow-sm transition-all hover:border-primary-200 hover:text-primary-600 hover:shadow-md">
            <i class="fa-solid fa-arrow-left transition-transform group-hover:-translate-x-0.5"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-neutral-900">Detail Pendaftaran</h1>
            <p class="text-sm font-medium text-neutral-500">Informasi lengkap data diri dan berkas pendaftaran.</p>
        </div>
    </div>

    {{-- STATUS CARD --}}
    @php
        $statusConfig = match($siswa->status_pendaftaran) {
            'Diterima' => ['bg' => 'bg-primary-50', 'border' => 'border-primary-100', 'text' => 'text-primary-700', 'icon' => 'fa-circle-check', 'icon_bg' => 'bg-primary-100'],
            'Ditolak' => ['bg' => 'bg-rose-50', 'border' => 'border-rose-100', 'text' => 'text-rose-700', 'icon' => 'fa-circle-xmark', 'icon_bg' => 'bg-rose-100'],
            default => ['bg' => 'bg-yellow-50', 'border' => 'border-yellow-100', 'text' => 'text-yellow-700', 'icon' => 'fa-clock', 'icon_bg' => 'bg-yellow-100'],
        };
    @endphp

    <div class="rounded-3xl border {{ $statusConfig['border'] }} {{ $statusConfig['bg'] }} p-6 md:p-8 flex flex-col md:flex-row items-center justify-between gap-6 shadow-sm">
        <div class="flex items-center gap-5">
            <div class="flex h-14 w-14 items-center justify-center rounded-2xl {{ $statusConfig['icon_bg'] }} {{ $statusConfig['text'] }}">
                <i class="fa-solid {{ $statusConfig['icon'] }} text-2xl"></i>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-neutral-500 mb-1">Status Pendaftaran</p>
                <h2 class="text-2xl font-extrabold {{ $statusConfig['text'] }}">
                    {{ $siswa->status_pendaftaran }}
                </h2>
            </div>
        </div>

        {{-- Tombol Cetak (Hanya jika Diterima) --}}
        @if($siswa->status_pendaftaran === 'Diterima')
            <a href="{{ route('siswa.cetak-bukti', $siswa) }}" target="_blank"
               class="flex w-full md:w-auto items-center justify-center gap-2 rounded-xl bg-primary-600 px-8 py-3.5 text-sm font-bold text-white shadow-lg shadow-primary-500/30 hover:bg-primary-700 hover:-translate-y-0.5 transition-all">
                <i class="fa-solid fa-print"></i> Cetak Bukti
            </a>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

        {{-- KOLOM KIRI (DATA DIRI & SEKOLAH) --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- 1. IDENTITAS DIRI --}}
            <div class="bg-white rounded-2xl border border-neutral-200 shadow-sm overflow-hidden">
                <div class="border-b border-neutral-100 bg-neutral-50/50 px-6 py-4 flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary-100 text-primary-600">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <h2 class="text-base font-bold text-neutral-900">Identitas Pribadi</h2>
                </div>

                <div class="p-6 md:p-8">
                    {{-- Header Nama --}}
                    <div class="flex items-start gap-4 mb-8 pb-6 border-b border-neutral-100">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-primary-50 text-xl font-bold text-primary-600 border border-primary-100">
                            {{ substr($siswa->nama_lengkap, 0, 2) }}
                        </div>
                        <div>
                            <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-1">Nama Lengkap</p>
                            <h3 class="text-xl font-bold text-neutral-900">{{ $siswa->nama_lengkap }}</h3>
                            <div class="flex flex-wrap gap-4 mt-2">
                                <span class="inline-flex items-center gap-1 text-xs font-medium text-neutral-500 bg-neutral-100 px-2 py-1 rounded">
                                    <i class="fa-regular fa-id-card"></i> {{ $siswa->nik }}
                                </span>
                                <span class="inline-flex items-center gap-1 text-xs font-medium text-neutral-500 bg-neutral-100 px-2 py-1 rounded">
                                    <i class="fa-solid fa-graduation-cap"></i> {{ $siswa->nisn }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Grid Data --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                        <div>
                            <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider mb-1">Tempat, Tanggal Lahir</p>
                            <p class="text-sm font-semibold text-neutral-800">
                                {{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->isoFormat('D MMMM Y') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider mb-1">Jenis Kelamin</p>
                            <p class="text-sm font-semibold text-neutral-800">
                                {{ $siswa->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider mb-1">Agama</p>
                            <p class="text-sm font-semibold text-neutral-800">{{ $siswa->agama }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider mb-1">Anak Ke-</p>
                            <p class="text-sm font-semibold text-neutral-800">{{ $siswa->anak_ke }}</p>
                        </div>
                        <div class="sm:col-span-2">
                            <div class="bg-neutral-50 p-4 rounded-xl border border-neutral-100">
                                <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider mb-2">Alamat Domisili</p>
                                <p class="text-sm font-medium text-neutral-800 leading-relaxed">{{ $siswa->alamat }}</p>
                                <p class="mt-1 text-xs text-neutral-500">
                                    {{ $siswa->desa->nama ?? '' }}, {{ $siswa->kecamatan->nama ?? '' }}, 
                                    {{ $siswa->kabupaten->nama ?? '' }}, {{ $siswa->provinsi->nama ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. SEKOLAH ASAL --}}
            <div class="bg-white rounded-2xl border border-neutral-200 shadow-sm overflow-hidden">
                <div class="border-b border-neutral-100 bg-neutral-50/50 px-6 py-4 flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary-100 text-primary-600">
                        <i class="fa-solid fa-school"></i>
                    </div>
                    <h2 class="text-base font-bold text-neutral-900">Sekolah Asal</h2>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider mb-1">Nama Sekolah</p>
                        <p class="text-sm font-bold text-neutral-800">{{ $siswa->sekolahAsal->nama_sekolah ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider mb-1">Tahun Lulus</p>
                        <p class="text-sm font-bold text-neutral-800">{{ $siswa->sekolahAsal->tahun_lulus ?? '-' }}</p>
                    </div>
                    <div class="sm:col-span-2">
                        <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider mb-1">Alamat Sekolah</p>
                        <p class="text-sm text-neutral-700">{{ $siswa->sekolahAsal->alamat_sekolah ?? '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- 3. DATA ORANG TUA --}}
            <div class="bg-white rounded-2xl border border-neutral-200 shadow-sm overflow-hidden">
                <div class="border-b border-neutral-100 bg-neutral-50/50 px-6 py-4 flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary-100 text-primary-600">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h2 class="text-base font-bold text-neutral-900">Data Orang Tua / Wali</h2>
                </div>

                <div class="divide-y divide-neutral-100">
                    @foreach(['Ayah', 'Ibu', 'Wali'] as $hub)
                        @php $ortu = $siswa->orangTua->firstWhere('hubungan', $hub); @endphp
                        
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-sm font-bold uppercase tracking-wider text-primary-700 bg-primary-50 px-3 py-1 rounded-lg inline-block">
                                    {{ $hub }}
                                </h3>
                                @if(!$ortu && $hub == 'Wali')
                                    <span class="text-xs text-neutral-400 italic">Tidak ada data</span>
                                @endif
                            </div>

                            @if($ortu)
                                {{-- Include Partial Items --}}
                                @include('partials.siswa.orang-tua-items', ['data' => $ortu])
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN (BERKAS) --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-neutral-200 shadow-sm overflow-hidden sticky top-24">
                <div class="border-b border-neutral-100 bg-neutral-50/50 px-5 py-4 flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-paperclip text-neutral-400"></i>
                        <h3 class="text-sm font-bold text-neutral-900">Berkas Lampiran</h3>
                    </div>
                    <span class="bg-primary-100 text-primary-700 text-[10px] font-bold px-2 py-0.5 rounded">
                        {{ $siswa->lampiran->count() }} File
                    </span>
                </div>

                <div class="p-4 space-y-3">
                    @forelse ($siswa->lampiran as $file)
                        @php
                            $ext = pathinfo($file->path_file, PATHINFO_EXTENSION);
                            $isImage = in_array(strtolower($ext), ['jpg','jpeg','png','webp']);
                        @endphp

                        <div class="group flex items-center gap-3 p-3 rounded-xl border border-neutral-100 bg-white hover:border-primary-200 hover:shadow-md transition-all">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg {{ $isImage ? 'bg-primary-50 text-primary-600' : 'bg-rose-50 text-rose-600' }}">
                                <i class="fa-regular {{ $isImage ? 'fa-image' : 'fa-file-pdf' }} text-lg"></i>
                            </div>

                            <div class="min-w-0 flex-1">
                                <p class="truncate text-xs font-bold text-neutral-800">{{ $file->jenis_berkas }}</p>
                                <p class="truncate text-[10px] text-neutral-400 mt-0.5">{{ $file->nama_file_asli }}</p>
                            </div>

                            <a href="{{ asset('storage/'.$file->path_file) }}" target="_blank"
                               class="flex h-8 w-8 items-center justify-center rounded-lg text-neutral-400 hover:bg-primary-600 hover:text-white transition-colors">
                                <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                            </a>
                        </div>
                    @empty
                        <div class="py-8 text-center">
                            <p class="text-xs text-neutral-400 italic">Belum ada berkas diunggah.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
@endsection