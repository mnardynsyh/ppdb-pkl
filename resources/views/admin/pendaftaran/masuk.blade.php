@extends('layouts.admin')

@section('title', 'Pendaftar Masuk')

@section('content')
<div class="w-full min-h-screen bg-[#F0F2F5] px-4 pt-16 pb-10 lg:px-8 lg:pt-16 lg:pb-10 flex flex-col font-sans text-slate-800">

    <div class="max-w-7xl mx-auto w-full flex-1 flex flex-col">

        {{-- 1. HEADER --}}
        <div class="shrink-0 mb-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-slate-900">Data Pendaftar Masuk</h1>
                    <p class="text-sm text-slate-500 mt-1 font-medium">Daftar calon siswa yang menunggu verifikasi berkas.</p>
                </div>
            </div>
        </div>

       {{-- 2. ALERT & SEARCH --}}
        <div class="shrink-0 flex flex-col gap-4 mb-6">
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition.duration.300ms 
                     class="p-3 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-check-circle"></i>
                        <span class="text-sm font-semibold">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-emerald-600 hover:text-emerald-800"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            {{-- Search Bar --}}
            <form action="{{ route('admin.pendaftaran.diterima') }}" method="GET" 
                  class="bg-white p-2 rounded-xl border border-slate-200 shadow-sm flex items-center gap-2 transition-all focus-within:border-yellow-400 focus-within:ring-2 focus-within:ring-yellow-100">
                
                <button type="submit" class="pl-3 text-slate-400 hover:text-yellow-600 transition-colors">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="flex-1 border-none text-sm focus:ring-0 text-slate-700 placeholder-slate-400 bg-transparent" 
                       placeholder="Cari Nama, NISN, atau Asal Sekolah...">
            </form>
        </div>

        {{-- 4. CONTENT TABLE --}}
        <div class="flex-1 flex flex-col">
            
            {{-- TABLE CONTAINER (DESKTOP) --}}
            <div class="hidden lg:block bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-600 uppercase tracking-wider border-r border-slate-100 w-16 text-center">No</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-600 uppercase tracking-wider border-r border-slate-100">Data Siswa</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-600 uppercase tracking-wider border-r border-slate-100">Asal Sekolah</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-600 uppercase tracking-wider border-r border-slate-100">Tanggal Daftar</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-600 uppercase tracking-wider text-center">Aksi Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse($siswas as $i => $siswa)
                            <tr class="hover:bg-slate-50 transition-colors group">
                                {{-- No --}}
                                <td class="px-6 py-4 text-center border-r border-slate-100">
                                    <span class="text-xs font-bold text-slate-500">{{ $siswas->firstItem() + $i }}</span>
                                </td>

                                {{-- Data Siswa --}}
                                <td class="px-6 py-4 border-r border-slate-100">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center text-sm font-bold shrink-0 border border-amber-200">
                                            {{ substr($siswa->nama_lengkap, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-800">{{ $siswa->nama_lengkap }}</p>
                                            <p class="text-xs text-slate-500 mt-0.5 font-mono">NISN: {{ $siswa->nisn }}</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Sekolah --}}
                                <td class="px-6 py-4 border-r border-slate-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-school text-slate-400 text-xs"></i>
                                        <span class="text-sm font-medium text-slate-700">{{ $siswa->sekolahAsal->nama_sekolah ?? '-' }}</span>
                                    </div>
                                </td>

                                {{-- Tanggal --}}
                                <td class="px-6 py-4 border-r border-slate-100">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-600">
                                        <i class="fa-regular fa-calendar text-slate-400"></i>
                                        {{ $siswa->created_at->isoFormat('D MMM Y') }}
                                    </span>
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        {{-- Detail --}}
                                        <a href="{{ route('admin.pendaftaran.detail', $siswa) }}" 
                                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-slate-300 text-slate-500 hover:text-blue-600 hover:border-blue-300 hover:bg-blue-50 transition-all shadow-sm" 
                                           title="Lihat Detail">
                                            <i class="fa-solid fa-eye text-xs"></i>
                                        </a>

                                        {{-- Terima --}}
                                        <form action="{{ route('admin.pendaftaran.terima', $siswa) }}" method="POST" onsubmit="return confirm('Terima siswa ini?')">
                                            @csrf @method('PATCH')
                                            <button type="submit" 
                                                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-600 hover:bg-emerald-100 hover:text-emerald-700 hover:border-emerald-300 transition-all shadow-sm" 
                                                    title="Terima">
                                                <i class="fa-solid fa-check text-xs"></i>
                                            </button>
                                        </form>

                                        {{-- Tolak --}}
                                        <form action="{{ route('admin.pendaftaran.tolak', $siswa) }}" method="POST" onsubmit="return confirm('Tolak siswa ini?')">
                                            @csrf @method('PATCH')
                                            <button type="submit" 
                                                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-slate-300 text-slate-400 hover:text-rose-600 hover:border-rose-300 hover:bg-rose-50 transition-all shadow-sm" 
                                                    title="Tolak">
                                                <i class="fa-solid fa-xmark text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4 border border-slate-200 shadow-inner">
                                            <i class="fa-solid fa-box-open text-3xl text-slate-400"></i>
                                        </div>
                                        <p class="text-slate-500 text-sm font-medium">Tidak ada pendaftar baru yang perlu diverifikasi.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- MOBILE CARD VIEW --}}
            <div class="lg:hidden space-y-4 mb-6">
                @forelse($siswas as $siswa)
                    <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm relative overflow-hidden">
                        {{-- Stripe Kuning (Pending) --}}
                        <div class="absolute top-0 left-0 w-1.5 h-full bg-amber-400"></div>
                        
                        <div class="pl-3">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center text-sm font-bold border border-amber-200">
                                        {{ substr($siswa->nama_lengkap, 0, 2) }}
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-bold text-slate-900 line-clamp-1">{{ $siswa->nama_lengkap }}</h3>
                                        <p class="text-xs text-slate-500 mt-0.5 font-mono">{{ $siswa->nisn }}</p>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold px-2 py-1 bg-amber-50 text-amber-700 rounded border border-amber-200">
                                    Pending
                                </span>
                            </div>

                            <div class="text-xs text-slate-600 mb-4 flex items-center gap-2 bg-slate-50 p-2 rounded-lg border border-slate-100">
                                <i class="fa-solid fa-school text-slate-400"></i> 
                                <span class="font-medium">{{ $siswa->sekolahAsal->nama_sekolah ?? '-' }}</span>
                            </div>

                            <div class="grid grid-cols-3 gap-2 pt-3 border-t border-slate-100">
                                {{-- Detail --}}
                                <a href="{{ route('admin.pendaftaran.detail', $siswa) }}" class="flex items-center justify-center py-2 bg-white border border-slate-200 text-slate-600 rounded-lg text-xs font-bold hover:bg-slate-50 hover:text-blue-600 transition-colors">
                                    Detail
                                </a>
                                
                                {{-- Terima --}}
                                <form action="{{ route('admin.pendaftaran.terima', $siswa) }}" method="POST" onsubmit="return confirm('Terima?')" class="w-full">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="w-full py-2 bg-emerald-600 text-white rounded-lg text-xs font-bold hover:bg-emerald-700 transition-colors shadow-sm">
                                        Terima
                                    </button>
                                </form>
                                
                                {{-- Tolak --}}
                                <form action="{{ route('admin.pendaftaran.tolak', $siswa) }}" method="POST" onsubmit="return confirm('Tolak?')" class="w-full">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="w-full py-2 bg-white border border-rose-200 text-rose-600 rounded-lg text-xs font-bold hover:bg-rose-50 transition-colors">
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 text-center">
                        <p class="text-sm font-medium text-slate-500">Tidak ada pendaftar baru.</p>
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