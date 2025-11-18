@extends('layouts.admin')

@section('title', 'Pendaftaran Masuk')

@section('content')
{{-- ROOT WRAPPER --}}
<div class="w-full min-h-screen lg:h-screen bg-[#F0F2F5] px-4 pt-16 pb-6 lg:px-8 lg:pt-16 lg:pb-6 flex flex-col font-sans text-slate-800">

    <div class="max-w-7xl mx-auto w-full flex-1 flex flex-col lg:overflow-hidden">

        {{-- 1. HEADER & STATS --}}
        <div class="shrink-0 mb-6">
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

            {{-- Search Bar Simple --}}
            <form action="{{ route('admin.pendaftaran.masuk') }}" method="GET" 
                  class="bg-white p-2 rounded-xl border border-slate-200 shadow-sm flex items-center gap-2 transition-all focus-within:border-blue-400 focus-within:ring-2 focus-within:ring-blue-100">
                
                {{-- Tombol Search (Sekarang bisa diklik) --}}
                <button type="submit" class="pl-3 text-slate-400 hover:text-blue-600 transition-colors">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                
                {{-- Input --}}
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="flex-1 border-none text-sm focus:ring-0 text-slate-700 placeholder-slate-400 bg-transparent" 
                       placeholder="Cari nama calon siswa...">
            </form>
        </div>

        {{-- 3. CONTENT TABLE (FIT SCREEN) --}}
        <div class="flex-1 lg:overflow-y-auto lg:pr-2 scrollbar-hide pb-4 relative">
            
            {{-- TABLE CONTAINER --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                
                {{-- DESKTOP TABLE --}}
                <table class="w-full text-left border-collapse hidden lg:table">
                    <thead class="bg-slate-50 border-b border-slate-200 sticky top-0 z-10">
                        <tr>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-600 uppercase tracking-wider border-r border-slate-100 w-16 text-center">No</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-600 uppercase tracking-wider border-r border-slate-100">Data Siswa</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-600 uppercase tracking-wider border-r border-slate-100">Asal Sekolah</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-600 uppercase tracking-wider border-r border-slate-100">Tanggal Daftar</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-600 uppercase tracking-wider text-center">Aksi Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($siswas as $i => $siswa)
                            <tr class="hover:bg-slate-50 transition-colors group">
                                {{-- No --}}
                                <td class="px-6 py-4 text-center border-r border-slate-50">
                                    <span class="text-xs font-bold text-slate-500">{{ $siswas->firstItem() + $i }}</span>
                                </td>

                                {{-- Data Siswa --}}
                                <td class="px-6 py-4 border-r border-slate-50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center text-xs font-bold shrink-0 border border-amber-200">
                                            {{ substr($siswa->nama_lengkap, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-800">{{ $siswa->nama_lengkap }}</p>
                                            <p class="text-xs text-slate-500 font-mono mt-0.5">NISN: {{ $siswa->nisn }}</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Sekolah --}}
                                <td class="px-6 py-4 border-r border-slate-50">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-school text-slate-400 text-xs"></i>
                                        <span class="text-sm font-medium text-slate-700">{{ $siswa->asal_sekolah }}</span>
                                    </div>
                                </td>

                                {{-- Tanggal --}}
                                <td class="px-6 py-4 border-r border-slate-50">
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
                                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-slate-200 text-slate-500 hover:text-blue-600 hover:border-blue-200 hover:bg-blue-50 transition-all shadow-sm" 
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
                                                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-slate-200 text-slate-400 hover:text-rose-600 hover:border-rose-200 hover:bg-rose-50 transition-all shadow-sm" 
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

                {{-- MOBILE CARD VIEW --}}
                <div class="lg:hidden p-4 space-y-4 bg-slate-50">
                    @forelse($siswas as $siswa)
                        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-1 h-full bg-amber-400"></div>
                            
                            <div class="pl-3">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h3 class="text-sm font-bold text-slate-900">{{ $siswa->nama_lengkap }}</h3>
                                        <p class="text-xs text-slate-500 mt-0.5 font-mono">{{ $siswa->nisn }}</p>
                                    </div>
                                    <span class="text-[10px] font-bold px-2 py-1 bg-amber-50 text-amber-700 rounded border border-amber-100">
                                        Pending
                                    </span>
                                </div>

                                <div class="text-xs text-slate-600 mb-4 flex items-center gap-2">
                                    <i class="fa-solid fa-school text-slate-400"></i> {{ $siswa->asal_sekolah }}
                                </div>

                                <div class="grid grid-cols-3 gap-2 pt-3 border-t border-slate-100">
                                    <a href="{{ route('admin.pendaftaran.detail', $siswa) }}" class="flex items-center justify-center py-2 bg-slate-50 text-slate-600 rounded-lg text-xs font-bold border border-slate-200">
                                        Detail
                                    </a>
                                    <form action="{{ route('admin.pendaftaran.terima', $siswa) }}" method="POST" onsubmit="return confirm('Terima?')">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="w-full py-2 bg-emerald-600 text-white rounded-lg text-xs font-bold hover:bg-emerald-700">
                                            Terima
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.pendaftaran.tolak', $siswa) }}" method="POST" onsubmit="return confirm('Tolak?')">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="w-full py-2 bg-rose-50 text-rose-600 border border-rose-200 rounded-lg text-xs font-bold hover:bg-rose-100">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10">
                            <p class="text-slate-500 text-sm">Belum ada pendaftar baru.</p>
                        </div>
                    @endforelse
                </div>

            </div>
            
            {{-- PAGINATION --}}
            @if($siswas->hasPages())
                <div class="mt-6 flex justify-center">
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm px-4 py-2">
                        {{ $siswas->withQueryString()->links('pagination::tailwind') }}
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection