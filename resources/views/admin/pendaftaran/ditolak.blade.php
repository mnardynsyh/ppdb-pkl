@extends('layouts.admin')

@section('title', 'Pendaftar Ditolak')

@section('content')
{{-- ROOT WRAPPER DENGAN ALPINE DATA --}}
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
    }
}" class="w-full min-h-screen bg-neutral-50 px-4 pt-8 lg:px-4 lg:pt-4 flex flex-col font-sans text-neutral-800">

    <div class="max-w-7xl mx-auto w-full flex-1 flex flex-col gap-6">

        {{-- 1. HEADER --}}
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-neutral-900">Data Pendaftar Ditolak</h1>
                <p class="text-sm text-neutral-500 mt-1">Daftar calon siswa yang tidak lolos seleksi verifikasi.</p>
            </div>
            <div class="hidden sm:block">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-50 text-rose-700 text-xs font-bold border border-rose-200">
                    <i class="fa-solid fa-user-xmark"></i>
                    Siswa Tidak Lolos
                </span>
            </div>
        </div>

        {{-- 2. ALERT & SEARCH --}}
        <div class="flex flex-col gap-4">
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition.duration.300ms 
                     class="p-4 rounded-xl bg-primary-50 border border-primary-100 text-primary-800 flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-primary-200 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-check text-primary-700 text-sm"></i>
                        </div>
                        <span class="text-sm font-semibold">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-primary-600 hover:text-primary-800 transition-colors"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            {{-- Search Bar --}}
            <form action="{{ route('admin.pendaftaran.ditolak') }}" method="GET" 
                  class="bg-white p-2 rounded-xl border border-neutral-200 shadow-sm flex items-center gap-2 transition-all focus-within:border-rose-500 focus-within:ring-4 focus-within:ring-rose-500/10">
                
                <button type="submit" class="w-10 h-10 flex items-center justify-center text-neutral-400 hover:text-rose-600 transition-colors rounded-lg hover:bg-neutral-50">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="flex-1 border-none text-sm focus:ring-0 text-neutral-700 placeholder-neutral-400 bg-transparent" 
                       placeholder="Cari Nama, NISN, atau Asal Sekolah...">
            </form>
        </div>

        {{-- 3. CONTENT TABLE --}}
        <div class="flex-1 flex flex-col">

            {{-- TABLE CONTAINER (DESKTOP) --}}
            <div class="hidden lg:block bg-white rounded-2xl border border-neutral-200 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-neutral-50/80 border-b border-neutral-200">
                            <th class="px-6 py-4 text-xs font-bold text-neutral-500 uppercase tracking-wider w-16 text-center">No</th>
                            <th class="px-6 py-4 text-xs font-bold text-neutral-500 uppercase tracking-wider">Data Siswa</th>
                            <th class="px-6 py-4 text-xs font-bold text-neutral-500 uppercase tracking-wider">Asal Sekolah</th>
                            <th class="px-6 py-4 text-xs font-bold text-neutral-500 uppercase tracking-wider">Tanggal Daftar</th>
                            <th class="px-6 py-4 text-xs font-bold text-neutral-500 uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100">

                        @forelse($siswas as $i => $siswa)
                            <tr class="hover:bg-rose-100/30 transition-colors group">
                                
                                {{-- No --}}
                                <td class="px-6 py-4 text-center">
                                    <span class="text-xs font-bold text-neutral-400">{{ $siswas->firstItem() + $i }}</span>
                                </td>

                                {{-- Data Siswa --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-700 flex items-center justify-center text-sm font-bold shrink-0 border border-rose-200">
                                            {{ substr($siswa->nama_lengkap, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-neutral-900 group-hover:text-rose-700 transition-colors">{{ $siswa->nama_lengkap }}</p>
                                            <p class="text-xs text-neutral-500 mt-0.5 font-mono">NISN: {{ $siswa->nisn }}</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Sekolah --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-neutral-100 flex items-center justify-center shrink-0 text-neutral-400">
                                            <i class="fa-solid fa-school text-[10px]"></i>
                                        </div>
                                        <span class="text-sm font-medium text-neutral-700 truncate max-w-[200px]" title="{{ $siswa->sekolahAsal->nama_sekolah }}">{{ $siswa->sekolahAsal->nama_sekolah ?? '-' }}</span>
                                    </div>
                                </td>

                                {{-- Tanggal --}}
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-neutral-50 border border-neutral-200 text-xs font-semibold text-neutral-600">
                                        <i class="fa-regular fa-calendar text-neutral-400"></i>
                                        {{ $siswa->created_at->isoFormat('D MMM Y') }}
                                    </span>
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2 opacity-90 group-hover:opacity-100 transition-opacity">
                                        
                                        {{-- Detail --}}
                                        <a href="{{ route('admin.pendaftaran.detail', $siswa) }}" 
                                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-neutral-200 text-neutral-500 hover:text-primary-600 hover:border-primary-300 hover:bg-white hover:shadow-sm transition-all" 
                                           title="Lihat Detail">
                                            <i class="fa-solid fa-eye text-xs"></i>
                                        </a>

                                        {{-- Batalkan (Modal) - Yellow --}}
                                        <button 
                                            @click="openModal('batalkan', {{ $siswa->id }}, '{{ $siswa->nama_lengkap }}')" 
                                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-neutral-200 text-neutral-400 hover:text-yellow-600 hover:border-yellow-300 hover:bg-yellow-50 transition-all hover:shadow-sm" 
                                            title="Batalkan (Kembali ke Pending)">
                                            <i class="fa-solid fa-rotate-left text-xs"></i>
                                        </button>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-neutral-100 rounded-full flex items-center justify-center mb-4 text-neutral-300">
                                            <i class="fa-solid fa-user-xmark text-3xl"></i>
                                        </div>
                                        <p class="text-neutral-500 text-sm font-medium">Belum ada siswa yang ditolak.</p>
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
                    <div class="bg-white rounded-2xl p-5 border border-neutral-200 shadow-sm relative overflow-hidden">

                        {{-- Stripe Rose --}}
                        <div class="absolute top-0 left-0 w-1.5 h-full bg-rose-500"></div>
                        
                        <div class="pl-3">

                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-700 flex items-center justify-center text-sm font-bold border border-rose-200">
                                        {{ substr($siswa->nama_lengkap, 0, 2) }}
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-bold text-neutral-900 line-clamp-1">{{ $siswa->nama_lengkap }}</h3>
                                        <p class="text-xs text-neutral-500 mt-0.5 font-mono">{{ $siswa->nisn }}</p>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold px-2 py-1 bg-rose-50 text-rose-700 rounded border border-rose-200">
                                    Ditolak
                                </span>
                            </div>

                            <div class="text-xs text-neutral-600 mb-4 flex items-center gap-2 bg-neutral-50 p-2.5 rounded-xl border border-neutral-100">
                                <i class="fa-solid fa-school text-neutral-400"></i> 
                                <span class="font-medium truncate">{{ $siswa->sekolahAsal->nama_sekolah ?? '-' }}</span>
                            </div>

                            <div class="grid grid-cols-2 gap-2 pt-2">

                                <a href="{{ route('admin.pendaftaran.detail', $siswa) }}" 
                                   class="flex items-center justify-center py-2 bg-white border border-neutral-200 text-neutral-600 rounded-lg text-xs font-bold hover:bg-neutral-50 hover:text-primary-600 hover:border-primary-200 transition-colors">
                                    Detail
                                </a>
                                
                                <button 
                                    @click="openModal('batalkan', {{ $siswa->id }}, '{{ $siswa->nama_lengkap }}')" 
                                    class="w-full py-2 bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-lg text-xs font-bold hover:bg-yellow-100 transition-colors flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-rotate-left"></i> Batalkan
                                </button>
                            </div>
                        </div>

                    </div>

                @empty
                    <div class="bg-white rounded-2xl border border-neutral-200 shadow-sm p-8 text-center">
                        <p class="text-sm font-medium text-neutral-500">Belum ada siswa yang ditolak.</p>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            @if($siswas->hasPages())
                <div class="bg-white rounded-2xl border border-neutral-200 shadow-sm px-4 py-3 flex items-center justify-between sm:px-6 mt-auto">
                    {{-- Desktop --}}
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-neutral-500">
                                Menampilkan <span class="font-bold text-neutral-800">{{ $siswas->firstItem() }}</span> - <span class="font-bold text-neutral-800">{{ $siswas->lastItem() }}</span> dari <span class="font-bold text-neutral-800">{{ $siswas->total() }}</span>
                            </p>
                        </div>

                        <div>
                            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                                @if ($siswas->onFirstPage())
                                    <span class="relative inline-flex items-center px-4 py-2 rounded-l-lg border border-neutral-200 bg-neutral-50 text-sm font-medium text-neutral-400 cursor-not-allowed">Prev</span>
                                @else
                                    <a href="{{ $siswas->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 rounded-l-lg border border-neutral-200 bg-white text-sm font-bold text-neutral-600 hover:bg-primary-50 hover:text-primary-600 hover:border-primary-200 transition-all">Prev</a>
                                @endif

                                @if ($siswas->hasMorePages())
                                    <a href="{{ $siswas->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 rounded-r-lg border-l-0 border border-neutral-200 bg-white text-sm font-bold text-neutral-600 hover:bg-primary-50 hover:text-primary-600 hover:border-primary-200 transition-all">Next</a>
                                @else
                                    <span class="relative inline-flex items-center px-4 py-2 rounded-r-lg border-l-0 border border-neutral-200 bg-neutral-50 text-sm font-medium text-neutral-400 cursor-not-allowed">Next</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    {{-- Mobile --}}
                    <div class="flex justify-between w-full sm:hidden gap-2">
                         <a href="{{ $siswas->previousPageUrl() }}" class="flex-1 text-center px-4 py-2 border border-neutral-200 text-sm font-bold rounded-lg {{ $siswas->onFirstPage() ? 'bg-neutral-50 text-neutral-400 pointer-events-none' : 'bg-white text-neutral-600 hover:border-primary-500 hover:text-primary-600' }}">Prev</a>
                         <a href="{{ $siswas->nextPageUrl() }}" class="flex-1 text-center px-4 py-2 border border-neutral-200 text-sm font-bold rounded-lg {{ $siswas->hasMorePages() ? 'bg-white text-neutral-600 hover:border-primary-500 hover:text-primary-600' : 'bg-neutral-50 text-neutral-400 pointer-events-none' }}">Next</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- MODAL BATALKAN (YELLOW THEME) --}}
    <div x-show="activeModal === 'batalkan'" style="display: none;" 
        class="fixed inset-0 z-50 flex items-center justify-center px-4"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">

        {{-- Overlay --}}
        <div @click="closeModal()" class="absolute inset-0 bg-neutral-900/60 backdrop-blur-sm transition-opacity"></div>

        {{-- Modal Box --}}
        <div class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl transform transition-all"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0">

            <div class="text-center">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-yellow-50 text-yellow-600 ring-4 ring-yellow-50/50">
                    <i class="fa-solid fa-rotate-left text-3xl"></i>
                </div>

                <h3 class="text-lg font-bold text-neutral-900">Batalkan Penolakan?</h3>

                <p class="mt-2 text-sm text-neutral-500 leading-relaxed">
                    Data siswa <b x-text="selectedName" class="text-neutral-800"></b> akan 
                    <span class="font-bold text-yellow-600">dikembalikan ke status Pending</span>.
                    Proses penerimaan sebelumnya akan dibatalkan.
                </p>
            </div>

            <div class="mt-6 flex gap-3">

                <button @click="closeModal()" 
                    class="w-full rounded-xl border border-neutral-200 bg-white py-2.5 text-sm font-bold text-neutral-600 hover:bg-neutral-50 transition-colors">
                    Batal
                </button>

                <form :action="'{{ url('admin/pendaftaran') }}/' + selectedId + '/batalkan'" 
                      method="POST" class="w-full">
                    @csrf
                    @method('PATCH')

                    <button type="submit" 
                        class="w-full rounded-xl bg-yellow-600 py-2.5 text-sm font-bold text-white hover:bg-yellow-700 shadow-lg shadow-yellow-200 transition-colors">
                        Ya, Batalkan
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection