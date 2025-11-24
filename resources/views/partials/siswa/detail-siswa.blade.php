@extends('layouts.admin')

@section('title', 'Detail Calon Siswa')

@section('content')
{{-- WRAPPER UTAMA DENGAN ALPINE DATA --}}
<div x-data="{ activeModal: null }" class="w-full min-h-screen bg-[#F0F2F5] px-4 pt-16 pb-12 sm:px-6 lg:px-8 font-sans text-slate-800">

    <div class="max-w-7xl mx-auto">

        {{-- 1. HEADER (JUDUL & KEMBALI) --}}
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ url()->previous() }}" 
               class="group flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-500 shadow-sm transition-all hover:border-slate-300 hover:text-slate-900 hover:shadow-md">
                <i class="fa-solid fa-arrow-left transition-transform group-hover:-translate-x-0.5"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900">Detail Pendaftar</h1>
                <p class="text-sm font-medium text-slate-500">Verifikasi data dan berkas calon siswa.</p>
            </div>
        </div>

        {{-- 2. CONTROL PANEL --}}
        <div class="mb-8 rounded-2xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            
            {{-- Status Display --}}
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
                    <h2 class="text-2xl font-extrabold uppercase {{ $statusColor['text'] }}">{{ $siswa->status_pendaftaran }}</h2>
                </div>
            </div>

            {{-- Tombol Trigger Modal --}}
            <div class="flex w-full md:w-auto flex-col sm:flex-row gap-3">
                @if($siswa->status_pendaftaran == 'Pending')
                    {{-- Tombol Terima --}}
                    <button @click="activeModal = 'accept'" type="button" class="flex w-full sm:w-auto items-center justify-center gap-2 rounded-xl bg-emerald-600 px-6 py-3 text-sm font-bold text-white shadow-sm hover:bg-emerald-700 hover:shadow-md transition-all active:scale-[0.98]">
                        <i class="fa-solid fa-check"></i> Terima Siswa
                    </button>

                    {{-- Tombol Tolak --}}
                    <button @click="activeModal = 'reject'" type="button" class="flex w-full sm:w-auto items-center justify-center gap-2 rounded-xl bg-white border-2 border-rose-100 text-rose-600 px-6 py-3 text-sm font-bold hover:bg-rose-50 hover:border-rose-200 transition-all active:scale-[0.98]">
                        <i class="fa-solid fa-xmark"></i> Tolak
                    </button>
                @else
                    {{-- Tombol Reset --}}
                    <button @click="activeModal = 'reset'" type="button" class="flex w-full sm:w-auto items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-6 py-3 text-sm font-bold text-slate-700 hover:bg-slate-50 hover:text-slate-900 transition-all shadow-sm">
                        <i class="fa-solid fa-rotate-left"></i> Batalkan Status
                    </button>
                @endif
            </div>
        </div>

        {{-- 3. GRID DATA --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            
            {{-- === KOLOM KIRI (DATA) === --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Identitas --}}
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
                                    <span><i class="fa-regular fa-id-card mr-1"></i> {{ $siswa->nik }}</span>
                                    <span><i class="fa-solid fa-graduation-cap mr-1"></i> {{ $siswa->nisn }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <p class="text-xs font-bold uppercase text-slate-400 mb-1">TTL</p>
                                <p class="text-sm font-semibold text-slate-700">{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->isoFormat('D MMMM Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold uppercase text-slate-400 mb-1">Jenis Kelamin</p>
                                <p class="text-sm font-semibold text-slate-700">{{ $siswa->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</p>
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
                                    {{ $siswa->desa->nama ?? '-' }}, {{ $siswa->kecamatan->nama ?? '-' }}, {{ $siswa->kabupaten->nama ?? '-' }}, {{ $siswa->provinsi->nama ?? '-' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sekolah --}}
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
                            <p class="text-base font-bold text-slate-800">{{ $siswa->sekolahAsal->nama_sekolah ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase text-slate-400 mb-1">Tahun Lulus</p>
                            <p class="text-base font-bold text-slate-800">{{ $siswa->sekolahAsal->tahun_lulus ?? '-' }}</p>
                        </div>
                        <div class="sm:col-span-2">
                            <p class="text-xs font-bold uppercase text-slate-400 mb-1">Alamat Sekolah</p>
                            <p class="text-sm text-slate-600">{{ $siswa->sekolahAsal->alamat_sekolah ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Orang Tua --}}
                <div class="overflow-hidden rounded-2xl bg-white border border-slate-200 shadow-sm">
                    <div class="border-b border-slate-100 bg-slate-50/50 px-6 py-4 flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-100 text-purple-600">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <h2 class="text-base font-bold text-slate-800">Data Orang Tua</h2>
                    </div>
                    <div class="divide-y divide-slate-100">
                        @foreach(['Ayah', 'Ibu', 'Wali'] as $hubungan)
                            @php $ortu = $siswa->orangTua->firstWhere('hubungan', $hubungan); @endphp
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="flex h-2 w-2 rounded-full bg-purple-500"></span>
                                    <h3 class="text-sm font-bold uppercase text-slate-900">{{ $hubungan }}</h3>
                                    @if(!$ortu) <span class="ml-2 text-[10px] font-bold text-slate-300 bg-slate-100 px-2 py-0.5 rounded">KOSONG</span> @endif
                                </div>
                                @if($ortu)
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-8 text-sm">
                                        <div><span class="text-slate-400 text-xs block">Nama:</span> <span class="font-semibold text-slate-800">{{ $ortu->nama_lengkap }}</span></div>
                                        <div><span class="text-slate-400 text-xs block">NIK:</span> <span class="font-mono text-slate-600">{{ $ortu->nik ?? '-' }}</span></div>
                                        <div><span class="text-slate-400 text-xs block">Pekerjaan:</span> <span class="text-slate-700">{{ $ortu->pekerjaan ?? '-' }}</span></div>
                                        <div><span class="text-slate-400 text-xs block">No. HP:</span> <span class="text-slate-700">{{ $ortu->no_hp ?? '-' }}</span></div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- === KOLOM KANAN (LAMPIRAN) === --}}
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
                                $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'webp']);
                            @endphp
                            <div class="group flex items-center gap-3 rounded-xl border border-slate-100 bg-white p-3 transition-all hover:border-blue-300 hover:shadow-md">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg {{ $isImage ? 'bg-sky-50 text-sky-600' : 'bg-rose-50 text-rose-600' }}">
                                    <i class="fa-regular {{ $isImage ? 'fa-image' : 'fa-file-pdf' }} text-lg"></i>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-xs font-bold text-slate-800">{{ $file->jenis_berkas }}</p>
                                    <p class="truncate text-[10px] text-slate-500">{{ $file->nama_file_asli }}</p>
                                </div>
                                <a href="{{ asset('storage/'.$file->path_file) }}" target="_blank" class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 bg-slate-50 transition-colors hover:bg-blue-600 hover:text-white" title="Buka File">
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

    {{-- ======================================================= --}}
    {{--                  MODAL SECTION (POP-UPS)                --}}
    {{-- ======================================================= --}}

    {{-- 1. MODAL TERIMA --}}
    <div x-show="activeModal === 'accept'" style="display: none;" 
         class="fixed inset-0 z-50 flex items-center justify-center px-4"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        {{-- Backdrop --}}
        <div @click="activeModal = null" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

        {{-- Content --}}
        <div class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl transform transition-all"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4">
            
            <div class="text-center">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                    <i class="fa-solid fa-check text-3xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Terima Pendaftaran?</h3>
                <p class="mt-2 text-sm text-slate-500">
                    Status siswa <b>{{ $siswa->nama_lengkap }}</b> akan diubah menjadi <span class="font-bold text-emerald-600">DITERIMA</span>. Siswa dapat mencetak bukti kelulusan.
                </p>
            </div>

            <div class="mt-6 flex gap-3">
                <button @click="activeModal = null" class="w-full rounded-xl border border-slate-200 bg-white py-2.5 text-sm font-bold text-slate-600 hover:bg-slate-50 transition-colors">Batal</button>
                <form action="{{ route('admin.pendaftaran.terima', $siswa) }}" method="POST" class="w-full">
                    @csrf @method('PATCH')
                    <button type="submit" class="w-full rounded-xl bg-emerald-600 py-2.5 text-sm font-bold text-white hover:bg-emerald-700 transition-colors shadow-lg shadow-emerald-200">Ya, Terima</button>
                </form>
            </div>
        </div>
    </div>

    {{-- 2. MODAL TOLAK --}}
    <div x-show="activeModal === 'reject'" style="display: none;"
         class="fixed inset-0 z-50 flex items-center justify-center px-4"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        {{-- Backdrop --}}
        <div @click="activeModal = null" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

        {{-- Content --}}
        <div class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl transform transition-all"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            
            <div class="text-center">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-rose-100 text-rose-600">
                    <i class="fa-solid fa-xmark text-3xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Tolak Pendaftaran?</h3>
                <p class="mt-2 text-sm text-slate-500">
                    Status siswa akan diubah menjadi <span class="font-bold text-rose-600">DITOLAK</span>. Pastikan berkas tidak memenuhi syarat.
                </p>
            </div>

            <div class="mt-6 flex gap-3">
                <button @click="activeModal = null" class="w-full rounded-xl border border-slate-200 bg-white py-2.5 text-sm font-bold text-slate-600 hover:bg-slate-50 transition-colors">Batal</button>
                <form action="{{ route('admin.pendaftaran.tolak', $siswa) }}" method="POST" class="w-full">
                    @csrf @method('PATCH')
                    <button type="submit" class="w-full rounded-xl bg-rose-600 py-2.5 text-sm font-bold text-white hover:bg-rose-700 transition-colors shadow-lg shadow-rose-200">Ya, Tolak</button>
                </form>
            </div>
        </div>
    </div>

    {{-- 3. MODAL RESET --}}
    <div x-show="activeModal === 'reset'" style="display: none;"
         class="fixed inset-0 z-50 flex items-center justify-center px-4"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div @click="activeModal = null" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

        <div class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl transform transition-all"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            
            <div class="text-center">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-amber-100 text-amber-600">
                    <i class="fa-solid fa-rotate-left text-3xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Reset Status?</h3>
                <p class="mt-2 text-sm text-slate-500">
                    Status akan dikembalikan menjadi <span class="font-bold text-amber-600">PENDING</span>. Siswa akan masuk kembali ke antrian verifikasi.
                </p>
            </div>

            <div class="mt-6 flex gap-3">
                <button @click="activeModal = null" class="w-full rounded-xl border border-slate-200 bg-white py-2.5 text-sm font-bold text-slate-600 hover:bg-slate-50 transition-colors">Batal</button>
                <form action="{{ route('admin.pendaftaran.batalkan', $siswa) }}" method="POST" class="w-full">
                    @csrf @method('PATCH')
                    <button type="submit" class="w-full rounded-xl bg-amber-500 py-2.5 text-sm font-bold text-white hover:bg-amber-600 transition-colors shadow-lg shadow-amber-200">Ya, Reset</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection