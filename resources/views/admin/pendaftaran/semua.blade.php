@extends('layouts.admin')

@section('title', 'Semua Pendaftar')

@section('content')
<div class="w-full min-h-screen bg-[#F0F2F5] px-4 pt-16 pb-10 lg:px-8 lg:pt-16 lg:pb-10 flex flex-col font-sans text-slate-800">

    <div class="max-w-7xl mx-auto w-full flex-1 flex flex-col">

        {{-- 1. HEADER SECTION --}}
        <div class="shrink-0 mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-slate-900">Data Pendaftar</h1>
                    <p class="text-sm text-slate-500 mt-1 font-medium">Kelola dan verifikasi semua data calon peserta didik baru.</p>
                </div>
            </div>
        </div>

        {{-- 2. ALERTS --}}
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition.duration.300ms
                 class="shrink-0 mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-200 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-check text-emerald-600 text-sm"></i>
                    </div>
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-emerald-600 hover:text-emerald-800 transition-colors"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @endif

        {{-- 3. FILTER & SEARCH BAR --}}
        <div class="shrink-0 mb-8 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative z-10">
            <form action="{{ route('admin.pendaftaran.semua') }}" method="GET" class="grid grid-cols-1 lg:grid-cols-12 gap-5">
                
                {{-- Search Input --}}
                <div class="lg:col-span-5">
                    <label for="search" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Cari Data</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" 
                               class="w-full pl-10 pr-4 py-3 rounded-xl border-2 border-slate-200 bg-slate-50 text-sm font-medium focus:border-blue-500 focus:ring-0 focus:bg-white transition-colors placeholder-slate-400 text-slate-700" 
                               placeholder="Nama, NISN, atau Asal Sekolah...">
                    </div>
                </div>

                {{-- Status Filter --}}
                <div class="lg:col-span-3">
                    <label for="status" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Filter Status</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-filter"></i>
                        </div>
                        <select name="status" id="status" 
                                class="w-full pl-10 pr-8 py-3 rounded-xl border-2 border-slate-200 bg-slate-50 text-sm font-semibold text-slate-700 focus:border-blue-500 focus:ring-0 focus:bg-white appearance-none cursor-pointer transition-colors">
                            <option value="">Semua Status</option>
                            <option value="Pending" @selected(request('status') == 'Pending')>Pending</option>
                            <option value="Diterima" @selected(request('status') == 'Diterima')>Diterima</option>
                            <option value="Ditolak" @selected(request('status') == 'Ditolak')>Ditolak</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="lg:col-span-4 flex items-end gap-3">
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl text-sm font-bold shadow-sm transition-colors flex items-center justify-center gap-2">
                        <i class="fa-solid fa-magnifying-glass text-white/80"></i>
                        Filter
                    </button>
                    
                    <a href="{{ route('admin.pendaftaran.export', request()->query()) }}" 
                       class="px-5 py-3 bg-emerald-600 text-white text-sm font-bold rounded-xl shadow-sm hover:bg-emerald-700 transition-colors flex items-center justify-center gap-2" 
                       title="Ekspor Data ke Excel">
                        <i class="fa-solid fa-file-csv text-lg"></i>
                        <span class="hidden sm:inline">Export CSV</span>
                    </a>
                </div>
            </form>
        </div>

        {{-- 4. CONTENT TABLE / CARDS --}}
        <div class="flex-1 flex flex-col">
            
            {{-- DESKTOP VIEW (TABLE) --}}
            <div class="hidden lg:block bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-600 uppercase tracking-wider border-r border-slate-100">Calon Siswa</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-600 uppercase tracking-wider border-r border-slate-100">NISN</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-600 uppercase tracking-wider border-r border-slate-100">Asal Sekolah</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-600 uppercase tracking-wider text-center border-r border-slate-100">Status</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-600 uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse($siswas as $siswa)
                            <tr class="hover:bg-yellow-50 transition-colors group">
                                {{-- Nama & Email --}}
                                <td class="px-6 py-4 border-r border-slate-100">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-sm font-bold shrink-0">
                                            {{ substr($siswa->nama_lengkap, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-800">{{ $siswa->nama_lengkap }}</p>
                                            <p class="text-xs text-slate-500 mt-0.5">{{ $siswa->user->email ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                
                                {{-- NISN --}}
                                <td class="px-6 py-4 border-r border-slate-100">
                                    <span class="font-mono text-xs font-bold text-slate-600 bg-slate-100 px-2.5 py-1 rounded border border-slate-200">
                                        {{ $siswa->nisn }}
                                    </span>
                                </td>

                                {{-- Asal Sekolah (DIPERBAIKI) --}}
                                <td class="px-6 py-4 border-r border-slate-100">
                                    <p class="text-sm font-medium text-slate-700 flex items-center gap-2">
                                        <i class="fa-solid fa-school text-slate-400 text-xs"></i>
                                        {{-- Panggil dari Relasi --}}
                                        {{ $siswa->sekolahAsal->nama_sekolah ?? '-' }}
                                    </p>
                                </td>

                                {{-- Status Pendaftaran --}}
                                <td class="px-6 py-4 text-center border-r border-slate-100">
                                    @php
                                        $statusClass = match($siswa->status_pendaftaran) {
                                            'Diterima' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                            'Ditolak' => 'bg-rose-100 text-rose-700 border-rose-200',
                                            default => 'bg-amber-100 text-amber-700 border-amber-200',
                                        };
                                        $statusIcon = match($siswa->status_pendaftaran) {
                                            'Diterima' => 'fa-check-circle',
                                            'Ditolak' => 'fa-circle-xmark',
                                            default => 'fa-clock',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $statusClass }}">
                                        <i class="fa-solid {{ $statusIcon }}"></i>
                                        {{ $siswa->status_pendaftaran }}
                                    </span>
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.pendaftaran.detail', $siswa) }}" class="w-8 h-8 rounded-lg flex items-center justify-center bg-white border border-slate-300 text-slate-600 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors" title="Lihat Detail">
                                            <i class="fa-solid fa-eye text-xs"></i>
                                        </a>

                                        @if($siswa->status_pendaftaran == 'Pending')
                                            <form action="{{ route('admin.pendaftaran.terima', $siswa) }}" method="POST" onsubmit="return confirm('Terima {{ $siswa->nama_lengkap }}?')">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center bg-white border border-slate-300 text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-300 transition-colors" title="Terima">
                                                    <i class="fa-solid fa-check text-xs"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.pendaftaran.tolak', $siswa) }}" method="POST" onsubmit="return confirm('Tolak {{ $siswa->nama_lengkap }}?')">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center bg-white border border-slate-300 text-slate-600 hover:bg-rose-50 hover:text-rose-600 hover:border-rose-300 transition-colors" title="Tolak">
                                                    <i class="fa-solid fa-xmark text-xs"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.pendaftaran.batalkan', $siswa) }}" method="POST" onsubmit="return confirm('Reset status?')">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center bg-white border border-slate-300 text-slate-600 hover:bg-amber-50 hover:text-amber-600 hover:border-amber-300 transition-colors" title="Reset Status">
                                                    <i class="fa-solid fa-rotate-left text-xs"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                                            <i class="fa-solid fa-user-slash text-3xl text-slate-400"></i>
                                        </div>
                                        <h3 class="text-slate-900 font-bold text-lg">Data Tidak Ditemukan</h3>
                                        <p class="text-slate-500 text-sm mt-1">Coba ubah filter pencarian Anda.</p>
                                        <a href="{{ route('admin.pendaftaran.semua') }}" class="mt-4 text-sm font-bold text-blue-600 hover:underline">Reset Filter</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- MOBILE VIEW (CARDS) --}}
            <div class="lg:hidden space-y-4 mb-6">
                @forelse($siswas as $siswa)
                    @php
                        $statusState = match($siswa->status_pendaftaran) {
                            'Diterima' => ['stripe' => 'bg-emerald-500', 'badge' => 'bg-emerald-50 text-emerald-700 border-emerald-200', 'icon' => 'fa-circle-check'],
                            'Ditolak' => ['stripe' => 'bg-rose-500', 'badge' => 'bg-rose-50 text-rose-700 border-rose-200', 'icon' => 'fa-circle-xmark'],
                            default => ['stripe' => 'bg-amber-500', 'badge' => 'bg-amber-50 text-amber-700 border-amber-200', 'icon' => 'fa-clock'],
                        };
                    @endphp

                    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-1.5 h-full {{ $statusState['stripe'] }}"></div>
                        <div class="pl-3"> 
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 font-bold text-sm border border-slate-200">
                                        {{ substr($siswa->nama_lengkap, 0, 2) }}
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-bold text-slate-900 line-clamp-1">{{ $siswa->nama_lengkap }}</h3>
                                        <p class="text-xs text-slate-500 font-mono mt-0.5">{{ $siswa->nisn }}</p>
                                    </div>
                                </div>
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg text-[10px] font-bold border {{ $statusState['badge'] }}">
                                    <i class="fa-solid {{ $statusState['icon'] }}"></i> {{ $siswa->status_pendaftaran }}
                                </span>
                            </div>

                            <div class="space-y-1.5 mb-4 text-slate-600 bg-slate-50 p-3 rounded-lg border border-slate-100">
                                <div class="flex items-center gap-2 text-xs">
                                    <i class="fa-solid fa-school w-4 text-center text-slate-400"></i>
                                    <span class="font-medium">{{ $siswa->sekolahAsal->nama_sekolah ?? '-' }}</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-2">
                                <a href="{{ route('admin.pendaftaran.detail', $siswa) }}" class="col-span-2 flex items-center justify-center gap-2 py-2.5 bg-white border border-slate-200 text-slate-600 text-xs font-bold rounded-lg hover:bg-slate-50 transition-colors">
                                    <i class="fa-solid fa-eye text-blue-500"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 text-center">
                        <p class="text-sm font-medium text-slate-500">Tidak ada data ditemukan.</p>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION CUSTOM (FULL WIDTH TOOLBAR) --}}
            @if($siswas->hasPages())
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm px-4 py-3 flex items-center justify-between sm:px-6 mt-auto">
                    {{-- Desktop Pagination --}}
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-slate-600">
                                Menampilkan
                                <span class="font-bold text-slate-800">{{ $siswas->firstItem() }}</span>
                                sampai
                                <span class="font-bold text-slate-800">{{ $siswas->lastItem() }}</span>
                                dari
                                <span class="font-bold text-slate-800">{{ $siswas->total() }}</span>
                                data
                            </p>
                        </div>
                        <div>
                            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                                {{-- Prev --}}
                                @if ($siswas->onFirstPage())
                                    <span class="relative inline-flex items-center px-3 py-2 rounded-l-lg border border-slate-200 bg-slate-50 text-sm font-medium text-slate-400 cursor-not-allowed">
                                        Prev
                                    </span>
                                @else
                                    <a href="{{ $siswas->previousPageUrl() }}" class="relative inline-flex items-center px-3 py-2 rounded-l-lg border border-slate-200 bg-white text-sm font-bold text-slate-600 hover:bg-slate-50 hover:text-blue-600 transition-colors">
                                        Prev
                                    </a>
                                @endif

                                {{-- Next --}}
                                @if ($siswas->hasMorePages())
                                    <a href="{{ $siswas->nextPageUrl() }}" class="relative inline-flex items-center px-3 py-2 rounded-r-lg border-l-0 border border-slate-200 bg-white text-sm font-bold text-slate-600 hover:bg-slate-50 hover:text-blue-600 transition-colors">
                                        Next
                                    </a>
                                @else
                                    <span class="relative inline-flex items-center px-3 py-2 rounded-r-lg border-l-0 border border-slate-200 bg-slate-50 text-sm font-medium text-slate-400 cursor-not-allowed">
                                        Next
                                    </span>
                                @endif
                            </span>
                        </div>
                    </div>

                    {{-- Mobile Pagination --}}
                    <div class="flex items-center justify-between w-full sm:hidden">
                        @if ($siswas->onFirstPage())
                             <span class="px-4 py-2 border border-slate-200 text-sm font-medium rounded-lg text-slate-400 bg-slate-50">Prev</span>
                        @else
                             <a href="{{ $siswas->previousPageUrl() }}" class="px-4 py-2 border border-slate-200 text-sm font-bold rounded-lg text-slate-600 bg-white hover:bg-slate-50 hover:text-blue-600">Prev</a>
                        @endif

                        <span class="text-xs font-bold text-slate-500">
                            Hal. {{ $siswas->currentPage() }}
                        </span>

                        @if ($siswas->hasMorePages())
                            <a href="{{ $siswas->nextPageUrl() }}" class="px-4 py-2 border border-slate-200 text-sm font-bold rounded-lg text-slate-600 bg-white hover:bg-slate-50 hover:text-blue-600">Next</a>
                        @else
                            <span class="px-4 py-2 border border-slate-200 text-sm font-medium rounded-lg text-slate-400 bg-slate-50">Next</span>
                        @endif
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection