@extends('layouts.siswa')

@section('title', 'Detail Pendaftaran')

@section('content')
<div class="w-full min-h-screen bg-[#F0F2F5] px-4 pt-6 pb-12 sm:px-6 lg:px-8 font-sans text-slate-800">

    <div class="max-w-7xl mx-auto">

        {{-- HEADER --}}
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('siswa.dashboard') }}" 
               class="group flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-500 shadow-sm transition-all hover:border-slate-300 hover:text-slate-900 hover:shadow-md">
                <i class="fa-solid fa-arrow-left transition-transform group-hover:-translate-x-0.5"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900">Detail Pendaftaran</h1>
                <p class="text-sm font-medium text-slate-500">Lihat informasi data diri dan status pendaftaran Anda.</p>
            </div>
        </div>

        {{-- STATUS & TOMBOL CETAK (KHUSUS DITERIMA) --}}
        <div class="mb-8 rounded-2xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">

            {{-- Status --}}
            <div class="flex items-center gap-4">
                @php
                    $statusColor = match($siswa->status_pendaftaran) {
                        'Diterima' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700', 'icon' => 'fa-circle-check'],
                        'Ditolak' => ['bg' => 'bg-rose-100', 'text' => 'text-rose-700', 'icon' => 'fa-circle-xmark'],
                        default => ['bg' => 'bg-amber-100', 'text' => 'text-amber-700', 'icon' => 'fa-clock'],
                    };
                @endphp

                <div class="flex h-14 w-14 items-center justify-center rounded-full {{ $statusColor['bg'] }} {{ $statusColor['text'] }}">
                    <i class="fa-solid {{ $statusColor['icon'] }} text-2xl"></i>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Status Pendaftaran</p>
                    <h2 class="text-2xl font-extrabold uppercase {{ $statusColor['text'] }}">
                        {{ $siswa->status_pendaftaran }}
                    </h2>
                </div>
            </div>

            {{-- Tombol Cetak Bukti Hanya Jika Diterima --}}
            @if($siswa->status_pendaftaran === 'Diterima')
                <a href="{{ route('siswa.cetak-bukti', $siswa) }}" 
                    target="_blank"
                    class="flex w-full md:w-auto items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-3 text-sm font-bold text-white shadow-sm hover:bg-blue-700 hover:shadow-md transition-all">
                    <i class="fa-solid fa-print"></i> Cetak Bukti Pendaftaran
                </a>
            @endif
        </div>

        {{-- GRID CONTENT --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

            {{-- KIRI --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- IDENTITAS --}}
                <div class="overflow-hidden rounded-2xl bg-white border border-slate-200 shadow-sm">
                    <div class="border-b border-slate-100 bg-slate-50/50 px-6 py-4 flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <h2 class="text-base font-bold text-slate-800">Identitas Pribadi</h2>
                    </div>

                    <div class="p-6">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 mb-6 pb-6 border-b border-slate-100">
                            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-slate-100 text-xl font-bold text-slate-500 border border-slate-200">
                                {{ substr($siswa->nama_lengkap, 0, 2) }}
                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-slate-900">{{ $siswa->nama_lengkap }}</h3>
                                <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm text-slate-500">
                                    <span><i class="fa-regular fa-id-card mr-1"></i>{{ $siswa->nik }}</span>
                                    <span><i class="fa-solid fa-graduation-cap mr-1"></i>{{ $siswa->nisn }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <p class="text-xs font-bold uppercase text-slate-400 mb-1">TTL</p>
                                <p class="text-sm font-semibold text-slate-700">
                                    {{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->isoFormat('D MMMM Y') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs font-bold uppercase text-slate-400 mb-1">Jenis Kelamin</p>
                                <p class="text-sm font-semibold text-slate-700">
                                    {{ $siswa->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs font-bold uppercase text-slate-400 mb-1">Agama</p>
                                <p class="text-sm font-semibold text-slate-700">{{ $siswa->agama }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-bold uppercase text-slate-400 mb-1">Anak Ke</p>
                                <p class="text-sm font-semibold text-slate-700">{{ $siswa->anak_ke }}</p>
                            </div>

                            <div class="sm:col-span-2 bg-slate-50 p-4 rounded-xl border border-slate-100">
                                <p class="text-xs font-bold uppercase text-slate-400 mb-1">Alamat</p>
                                <p class="text-sm font-medium text-slate-700 leading-relaxed">{{ $siswa->alamat }}</p>
                                <div class="mt-2 text-xs text-slate-500">
                                    {{ $siswa->desa->nama ?? '-' }},
                                    {{ $siswa->kecamatan->nama ?? '-' }},
                                    {{ $siswa->kabupaten->nama ?? '-' }},
                                    {{ $siswa->provinsi->nama ?? '-' }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- SEKOLAH --}}
                <div class="overflow-hidden rounded-2xl bg-white border border-slate-200 shadow-sm">
                    <div class="border-b border-slate-100 bg-slate-50/50 px-6 py-4 flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                            <i class="fa-solid fa-school"></i>
                        </div>
                        <h2 class="text-base font-bold text-slate-800">Sekolah Asal</h2>
                    </div>

                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs font-bold uppercase text-slate-400 mb-1">Nama Sekolah</p>
                            <p class="font-semibold text-slate-800">
                                {{ $siswa->sekolahAsal->nama_sekolah ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-bold uppercase text-slate-400 mb-1">Tahun Lulus</p>
                            <p class="font-semibold text-slate-800">
                                {{ $siswa->sekolahAsal->tahun_lulus ?? '-' }}
                            </p>
                        </div>

                        <div class="sm:col-span-2">
                            <p class="text-xs font-bold uppercase text-slate-400 mb-1">Alamat Sekolah</p>
                            <p class="text-sm text-slate-600">
                                {{ $siswa->sekolahAsal->alamat_sekolah ?? '-' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- ORANG TUA --}}
                <div class="overflow-hidden rounded-2xl bg-white border border-slate-200 shadow-sm">
                    <div class="border-b border-slate-100 bg-slate-50/50 px-6 py-4 flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-100 text-purple-600">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <h2 class="text-base font-bold text-slate-800">Data Orang Tua</h2>
                    </div>

                    <div class="divide-y divide-slate-100">

                        @foreach(['Ayah', 'Ibu', 'Wali'] as $hub)
                            @php
                                $ortu = $siswa->orangTua->firstWhere('hubungan', $hub);
                            @endphp

                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="flex h-2 w-2 rounded-full bg-purple-500"></span>
                                    <h3 class="text-sm font-bold uppercase">{{ $hub }}</h3>

                                    @if(!$ortu)
                                        <span class="ml-2 text-[10px] font-bold text-slate-300 bg-slate-100 px-2 py-0.5 rounded">KOSONG</span>
                                    @endif
                                </div>

                                @if($ortu)
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-8 text-sm">
                                        <div>
                                            <span class="text-xs text-slate-400 block">Nama:</span>
                                            <span class="font-semibold text-slate-800">{{ $ortu->nama_lengkap }}</span>
                                        </div>

                                        <div>
                                            <span class="text-xs text-slate-400 block">NIK:</span>
                                            <span class="font-mono text-slate-600">{{ $ortu->nik ?? '-' }}</span>
                                        </div>

                                        <div>
                                            <span class="text-xs text-slate-400 block">Pekerjaan:</span>
                                            <span class="text-slate-700">{{ $ortu->pekerjaan ?? '-' }}</span>
                                        </div>

                                        <div>
                                            <span class="text-xs text-slate-400 block">No. HP:</span>
                                            <span class="text-slate-700">{{ $ortu->no_hp ?? '-' }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>

                        @endforeach

                    </div>
                </div>

            </div>

            {{-- KANAN — BERKAS --}}
            <div class="lg:col-span-1">

                <div class="overflow-hidden rounded-2xl bg-white border border-slate-200 shadow-sm">

                    <div class="border-b border-slate-100 bg-slate-50/50 px-5 py-4 flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-paperclip text-slate-400"></i>
                            <h3 class="text-sm font-bold text-slate-900">Berkas Lampiran</h3>
                        </div>
                        <span class="rounded bg-blue-100 text-blue-700 px-2 py-0.5 text-[10px] font-bold">
                            {{ $siswa->lampiran->count() }} File
                        </span>
                    </div>

                    <div class="p-4 space-y-3">

                        @forelse ($siswa->lampiran as $file)

                            @php
                                $ext = pathinfo($file->path_file, PATHINFO_EXTENSION);
                                $isImage = in_array(strtolower($ext), ['jpg','jpeg','png','webp']);
                            @endphp

                            <div class="group flex items-center gap-3 rounded-xl border border-slate-100 bg-white p-3 transition-all hover:border-blue-300 hover:shadow-md">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg {{ $isImage ? 'bg-sky-50 text-sky-600' : 'bg-rose-50 text-rose-600' }}">
                                    <i class="fa-regular {{ $isImage ? 'fa-image' : 'fa-file-pdf' }} text-lg"></i>
                                </div>

                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-xs font-bold text-slate-800">{{ $file->jenis_berkas }}</p>
                                    <p class="truncate text-[10px] text-slate-500">{{ $file->nama_file_asli }}</p>
                                </div>

                                <a href="{{ asset('storage/'.$file->path_file) }}" 
                                   target="_blank"
                                   class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 bg-slate-50 transition-colors hover:bg-blue-600 hover:text-white">
                                    <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                </a>
                            </div>

                        @empty
                            <div class="flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-slate-100 py-8 text-center bg-slate-50/50">
                                <i class="fa-regular fa-folder-open text-2xl text-slate-300 mb-2"></i>
                                <p class="text-xs font-medium text-slate-400">Tidak ada berkas.</p>
                            </div>
                        @endforelse

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
@endsection
