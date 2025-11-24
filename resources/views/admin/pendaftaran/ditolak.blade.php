@extends('layouts.admin')
@section('title', 'Pendaftar Ditolak')

@section('content')
<div x-data="{ 
    activeModal: null, 
    selectedId: null, 
    selectedName: null,
    
    openModal(action, id, name) {
        this.activeModal = action;
        this.selectedId = id;
        this.selectedName = name;
    },
    closeModal() {
        this.activeModal = null;
        setTimeout(() => {
            this.selectedId = null;
            this.selectedName = null;
        }, 300);
    }
}" class="w-full min-h-screen bg-[#F0F2F5] px-4 pt-16 pb-10 lg:px-8 lg:pt-16 lg:pb-10 flex flex-col font-sans text-slate-800">

    <div class="max-w-7xl mx-auto w-full flex-1 flex flex-col">

        {{-- 1. HEADER --}}
        <div class="shrink-0 mb-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-slate-900">Data Pendaftar Ditolak</h1>
                    <p class="text-sm text-slate-500 mt-1 font-medium">Daftar calon siswa yang tidak lolos seleksi verifikasi.</p>
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
            <form action="{{ route('admin.pendaftaran.ditolak') }}" method="GET" 
                  class="bg-white p-2 rounded-xl border border-slate-200 shadow-sm flex items-center gap-2 transition-all focus-within:border-rose-400 focus-within:ring-2 focus-within:ring-rose-100">
                
                <button type="submit" class="pl-3 text-slate-400 hover:text-rose-600 transition-colors">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="flex-1 border-none text-sm focus:ring-0 text-slate-700 placeholder-slate-400 bg-transparent" 
                       placeholder="Cari Nama, NISN, atau Asal Sekolah...">
            </form>
        </div>

        {{-- 4. CONTENT TABLE --}}
        <div class="flex-1 flex flex-col">

            {{-- TABLE DESKTOP --}}
            <div class="hidden lg:block bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-600 uppercase tracking-wider border-r border-slate-100 w-16 text-center">No</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-600 uppercase tracking-wider border-r border-slate-100">Data Siswa</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-600 uppercase tracking-wider border-r border-slate-100">Asal Sekolah</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-600 uppercase tracking-wider border-r border-slate-100">Tanggal Daftar</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-600 uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">

                        @forelse($siswas as $i => $siswa)
                            <tr class="hover:bg-rose-50/40 transition-colors group">
                                
                                {{-- No --}}
                                <td class="px-6 py-4 text-center border-r border-slate-100">
                                    <span class="text-xs font-bold text-slate-500">{{ $siswas->firstItem() + $i }}</span>
                                </td>

                                {{-- Data Siswa --}}
                                <td class="px-6 py-4 border-r border-slate-100">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-rose-100 text-rose-700 flex items-center justify-center text-sm font-bold border border-rose-200">
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
                                        <span class="text-sm font-medium text-slate-700">
                                            {{ $siswa->sekolahAsal->nama_sekolah ?? '-' }}
                                        </span>
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
                                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-slate-300 text-slate-500 hover:text-blue-600 hover:border-blue-300 hover:bg-blue-50 transition-all shadow-sm">
                                            <i class="fa-solid fa-eye text-xs"></i>
                                        </a>

                                        {{-- Batalkan --}}
                                        <button 
                                            @click="openModal('batalkan', {{ $siswa->id }}, '{{ $siswa->nama_lengkap }}')" 
                                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-slate-300 text-slate-400 hover:text-amber-600 hover:border-amber-300 hover:bg-amber-50 transition-all shadow-sm">
                                            <i class="fa-solid fa-rotate-left text-xs"></i>
                                        </button>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4 border border-slate-200 shadow-inner">
                                            <i class="fa-solid fa-user-xmark text-3xl text-slate-400"></i>
                                        </div>
                                        <p class="text-slate-500 text-sm font-medium">Belum ada siswa yang ditolak.</p>
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

                        {{-- Garis merah --}}
                        <div class="absolute top-0 left-0 w-1.5 h-full bg-rose-500"></div>
                        
                        <div class="pl-3">

                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-rose-100 text-rose-700 flex items-center justify-center text-sm font-bold border border-rose-200">
                                        {{ substr($siswa->nama_lengkap, 0, 2) }}
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-bold text-slate-900 line-clamp-1">{{ $siswa->nama_lengkap }}</h3>
                                        <p class="text-xs text-slate-500 mt-0.5 font-mono">{{ $siswa->nisn }}</p>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold px-2 py-1 bg-rose-50 text-rose-700 rounded border border-rose-200">
                                    Ditolak
                                </span>
                            </div>

                            <div class="text-xs text-slate-600 mb-4 flex items-center gap-2 bg-slate-50 p-2 rounded-lg border border-slate-100">
                                <i class="fa-solid fa-school text-slate-400"></i> 
                                <span class="font-medium">{{ $siswa->sekolahAsal->nama_sekolah ?? '-' }}</span>
                            </div>

                            <div class="grid grid-cols-2 gap-2 pt-3 border-t border-slate-100">

                                <a href="{{ route('admin.pendaftaran.detail', $siswa) }}" 
                                   class="flex items-center justify-center py-2 bg-white border border-slate-200 text-slate-600 rounded-lg text-xs font-bold hover:bg-slate-50 hover:text-blue-600 transition-colors">
                                    Detail
                                </a>
                                
                                <button 
                                    @click="openModal('batalkan', {{ $siswa->id }}, '{{ $siswa->nama_lengkap }}')" 
                                    class="w-full py-2 bg-amber-50 border border-amber-200 text-amber-700 rounded-lg text-xs font-bold hover:bg-amber-100 transition-colors flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-rotate-left"></i> Batalkan
                                </button>
                            </div>
                        </div>

                    </div>

                @empty
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 text-center">
                        <p class="text-sm font-medium text-slate-500">Belum ada siswa yang ditolak.</p>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            @if($siswas->hasPages())
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm px-4 py-3 flex items-center justify-between sm:px-6 mt-auto">
                    
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
                                    <span class="relative inline-flex items-center px-3 py-2 rounded-l-lg border border-slate-200 bg-slate-50 text-sm font-medium text-slate-400 cursor-not-allowed">Prev</span>
                                @else
                                    <a href="{{ $siswas->previousPageUrl() }}" 
                                       class="relative inline-flex items-center px-3 py-2 rounded-l-lg border border-slate-200 bg-white text-sm font-bold text-slate-600 hover:bg-slate-50 hover:text-blue-600">
                                        Prev
                                    </a>
                                @endif

                                {{-- Next --}}
                                @if ($siswas->hasMorePages())
                                    <a href="{{ $siswas->nextPageUrl() }}" 
                                       class="relative inline-flex items-center px-3 py-2 rounded-r-lg border border-slate-200 border-l-0 bg-white text-sm font-bold text-slate-600 hover:bg-slate-50 hover:text-blue-600">
                                        Next
                                    </a>
                                @else
                                    <span class="relative inline-flex items-center px-3 py-2 rounded-r-lg border border-slate-200 border-l-0 bg-slate-50 text-sm font-medium text-slate-400 cursor-not-allowed">Next</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    {{-- MOBILE --}}
                    <div class="flex items-center justify-between w-full sm:hidden">

                        @if ($siswas->onFirstPage())
                            <span class="px-4 py-2 border border-slate-200 text-sm font-medium rounded-lg text-slate-400 bg-slate-50">Prev</span>
                        @else
                            <a href="{{ $siswas->previousPageUrl() }}" class="px-4 py-2 border border-slate-200 text-sm font-bold rounded-lg text-slate-600 bg-white hover:bg-slate-50">Prev</a>
                        @endif

                        <span class="text-xs font-bold text-slate-500">
                            Hal. {{ $siswas->currentPage() }}
                        </span>

                        @if ($siswas->hasMorePages())
                            <a href="{{ $siswas->nextPageUrl() }}" class="px-4 py-2 border border-slate-200 text-sm font-bold rounded-lg text-slate-600 bg-white hover:bg-slate-50">Next</a>
                        @else
                            <span class="px-4 py-2 border border-slate-200 text-sm font-medium rounded-lg text-slate-400 bg-slate-50">Next</span>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- MODAL BATALKAN --}}
    <div x-show="activeModal === 'batalkan'" style="display: none;" 
        class="fixed inset-0 z-50 flex items-center justify-center px-4"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">

        {{-- Overlay --}}
        <div @click="closeModal()" class="absolute inset-0 bg-slate-900/70"></div>

        {{-- Modal Box --}}
        <div class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl transform transition-all"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0">

            <div class="text-center">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-amber-100 text-amber-600">
                    <i class="fa-solid fa-rotate-left text-3xl"></i>
                </div>

                <h3 class="text-lg font-bold text-slate-900">Batalkan Penolakan?</h3>

                <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                    Data siswa <b x-text="selectedName"></b> akan 
                    <span class="font-bold text-amber-600">dikembalikan ke status Pending</span>.
                    Proses penerimaan sebelumnya akan dibatalkan.
                </p>
            </div>

            <div class="mt-6 flex gap-3">

                <button @click="closeModal()" 
                    class="w-full rounded-xl border border-slate-200 bg-white py-2.5 text-sm font-bold text-slate-600 hover:bg-slate-50">
                    Batal
                </button>

                <form :action="'{{ url('admin/pendaftaran') }}/' + selectedId + '/batalkan'" 
                      method="POST" class="w-full">
                    @csrf
                    @method('PATCH')

                    <button type="submit" 
                        class="w-full rounded-xl bg-amber-600 py-2.5 text-sm font-bold text-white hover:bg-amber-700 shadow-lg shadow-amber-200">
                        Ya, Batalkan
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
