@extends('layouts.admin')

@section('title', 'Semua Pendaftar')

@section('content')
<div x-data="{
    activeModal: null,
    selectedId: null,
    selectedName: null,
    openModal(type, id, name) {
        this.activeModal = type;
        this.selectedId = id;
        this.selectedName = name;
    },
    closeModal() {
        this.activeModal = null;
    }
}">
<div class="w-full min-h-screen bg-neutral-50 px-4 pt-8 pb-4 lg:px-4 lg:pt-4 flex flex-col font-sans text-neutral-800">

    <div class="max-w-7xl mx-auto w-full flex-1 flex flex-col gap-6">

        {{-- 1. HEADER SECTION (Lebih Ringkas) --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-neutral-900">Data Pendaftar</h1>
                <p class="text-sm text-neutral-500 mt-1">Kelola data calon siswa baru dengan mudah.</p>
            </div>
        </div>

        {{-- 2. ALERTS --}}
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

        {{-- 3. FILTER & SEARCH BAR --}}
        <div class="bg-white p-5 rounded-2xl border border-neutral-200 shadow-sm">
            <form action="{{ route('admin.pendaftaran.semua') }}" method="GET" class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-end">
                
                {{-- Search Input --}}
                <div class="lg:col-span-5 space-y-2">
                    <label for="search" class="text-xs font-semibold text-neutral-500 uppercase tracking-wider ml-1">Cari Data</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-neutral-400 group-focus-within:text-primary-500 transition-colors">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" 
                               class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-neutral-300 bg-neutral-50 text-sm font-medium focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 focus:bg-white transition-all placeholder-neutral-400 text-neutral-700 shadow-sm" 
                               placeholder="Cari Nama atau NISN...">
                    </div>
                </div>

                {{-- Status Filter --}}
                <div class="lg:col-span-3 space-y-2">
                    <label for="status" class="text-xs font-semibold text-neutral-500 uppercase tracking-wider ml-1">Status</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-neutral-400 group-focus-within:text-primary-500 transition-colors">
                            <i class="fa-solid fa-filter"></i>
                        </div>
                        <select name="status" id="status" 
                                class="w-full pl-11 pr-10 py-2.5 rounded-xl border border-neutral-300 bg-neutral-50 text-sm font-medium text-neutral-700 focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 focus:bg-white appearance-none cursor-pointer transition-all shadow-sm">
                            <option value="">Semua Status</option>
                            <option value="Pending" @selected(request('status') == 'Pending')>Pending</option>
                            <option value="Diterima" @selected(request('status') == 'Diterima')>Diterima</option>
                            <option value="Ditolak" @selected(request('status') == 'Ditolak')>Ditolak</option>
                        </select>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="lg:col-span-4 flex gap-3">
                    <button type="submit" class="flex-1 bg-neutral-800 hover:bg-neutral-900 text-white px-4 py-2.5 rounded-xl text-sm font-bold shadow-sm hover:shadow-md transition-all flex items-center justify-center gap-2 transform active:scale-95">
                        <i class="fa-solid fa-magnifying-glass text-neutral-400 text-xs"></i>
                        Filter
                    </button>
                    
                    <a href="{{ route('admin.pendaftaran.export', request()->query()) }}" 
                       class="flex-1 bg-primary-600 hover:bg-primary-700 text-white px-4 py-2.5 rounded-xl text-sm font-bold shadow-sm hover:shadow-md hover:shadow-primary-600/20 transition-all flex items-center justify-center gap-2 transform active:scale-95">
                        <i class="fa-solid fa-file-excel text-primary-200"></i>
                        Export
                    </a>
                </div>
            </form>
        </div>

        <div class="flex-1 flex flex-col">
            
            {{-- DESKTOP VIEW --}}
            <div class="hidden lg:block bg-white rounded-2xl border border-neutral-200 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        {{-- Header Table Soft --}}
                        <tr class="bg-neutral-50/80 border-b border-neutral-200 text-left">
                            <th class="px-6 py-4 text-xs font-bold text-neutral-500 uppercase tracking-wider">Calon Siswa</th>
                            <th class="px-6 py-4 text-xs font-bold text-neutral-500 uppercase tracking-wider">NISN</th>
                            <th class="px-6 py-4 text-xs font-bold text-neutral-500 uppercase tracking-wider">Asal Sekolah</th>
                            <th class="px-6 py-4 text-xs font-bold text-neutral-500 uppercase tracking-wider text-center">Status</th>
                            <th class="px-6 py-4 text-xs font-bold text-neutral-500 uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100">
                        @forelse($siswas as $siswa)
                            <tr class="hover:bg-primary-100/40 transition-colors group">
                                {{-- Nama & Email --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-primary-50 text-primary-600 flex items-center justify-center text-sm font-bold shrink-0 ring-1 ring-primary-100/50">
                                            {{ substr($siswa->nama_lengkap, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-neutral-800 group-hover:text-primary-700 transition-colors">{{ $siswa->nama_lengkap }}</p>
                                            <p class="text-xs text-neutral-500 mt-0.5">{{ $siswa->user->email ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                
                                {{-- NISN --}}
                                <td class="px-6 py-4">
                                    <span class="font-mono text-xs font-medium text-neutral-600 bg-neutral-100 px-2 py-1 rounded-md border border-neutral-200">
                                        {{ $siswa->nisn }}
                                    </span>
                                </td>

                                {{-- Asal Sekolah --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-neutral-100 flex items-center justify-center shrink-0 text-neutral-400">
                                            <i class="fa-solid fa-school text-[10px]"></i>
                                        </div>
                                        <span class="text-sm font-medium text-neutral-700 truncate max-w-[200px]" title="{{ $siswa->sekolahAsal?->nama_sekolah }}">
                                            {{ $siswa->sekolahAsal?->nama_sekolah ?? '-' }}
                                        </span>
                                    </div>
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $statusClass = match($siswa->status_pendaftaran) {
                                            'Diterima' => 'bg-primary-50 text-primary-700 border-primary-200',
                                            'Ditolak' => 'bg-rose-50 text-rose-700 border-rose-200',
                                            default => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                        };
                                        $statusIcon = match($siswa->status_pendaftaran) {
                                            'Diterima' => 'fa-check',
                                            'Ditolak' => 'fa-xmark',
                                            default => 'fa-clock',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $statusClass }}">
                                        <i class="fa-solid {{ $statusIcon }}"></i>
                                        {{ $siswa->status_pendaftaran }}
                                    </span>
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2 opacity-80 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('admin.pendaftaran.detail', $siswa) }}" 
                                           class="w-8 h-8 rounded-lg flex items-center justify-center bg-white border border-neutral-200 text-neutral-500 hover:bg-white hover:text-primary-600 hover:border-primary-300 hover:shadow-sm transition-all" 
                                           title="Detail">
                                            <i class="fa-solid fa-eye text-xs"></i>
                                        </a>

                                        @if($siswa->status_pendaftaran == 'Pending')
                                            <form action="{{ route('admin.pendaftaran.terima', $siswa) }}" method="POST" onsubmit="return confirm('Terima siswa ini?')">
                                                @csrf @method('PATCH')
                                                <button type="button" @click="openModal('terima', {{ $siswa->id }}, '{{ $siswa->nama_lengkap }}')"
                                                    class="w-8 h-8 rounded-lg flex items-center justify-center bg-white border border-neutral-200 text-neutral-500 hover:bg-primary-50 hover:text-primary-600 hover:border-primary-300 hover:shadow-sm transition-all" title="Terima">
                                                    <i class="fa-solid fa-check text-xs"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.pendaftaran.tolak', $siswa) }}" method="POST" onsubmit="return confirm('Tolak siswa ini?')">
                                                @csrf @method('PATCH')
                                                <button type="button" @click="openModal('tolak', {{ $siswa->id }}, '{{ $siswa->nama_lengkap }}')"
                                                    class="w-8 h-8 rounded-lg flex items-center justify-center bg-white border border-neutral-200 text-neutral-500 hover:bg-rose-50 hover:text-rose-600 hover:border-rose-300 hover:shadow-sm transition-all" title="Tolak">
                                                    <i class="fa-solid fa-xmark text-xs"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.pendaftaran.batalkan', $siswa) }}" method="POST" onsubmit="return confirm('Reset status?')">
                                                @csrf @method('PATCH')
                                                <button type="button" @click="openModal('batalkan', {{ $siswa->id }}, '{{ $siswa->nama_lengkap }}')"
                                                    class="w-8 h-8 rounded-lg flex items-center justify-center bg-white border border-neutral-200 text-neutral-500 hover:bg-yellow-50 hover:text-yellow-600 hover:border-yellow-300 hover:shadow-sm transition-all" title="Reset">
                                                    <i class="fa-solid fa-rotate-left text-xs"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                        <div class="w-16 h-16 bg-neutral-100 rounded-full flex items-center justify-center mb-4 text-neutral-300">
                                            <i class="fa-solid fa-inbox text-3xl"></i>
                                        </div>
                                        <h3 class="text-neutral-900 font-bold text-lg">Data Tidak Ditemukan</h3>
                                        <p class="text-neutral-500 text-sm mt-1 text-center">Data yang Anda cari tidak tersedia. Coba gunakan kata kunci lain atau reset filter.</p>
                                        <a href="{{ route('admin.pendaftaran.semua') }}" class="mt-4 px-4 py-2 bg-neutral-100 hover:bg-neutral-200 text-neutral-700 text-sm font-semibold rounded-lg transition-colors">Reset Filter</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- MOBILE VIEW (CARDS yang lebih Clean) --}}
            <div class="lg:hidden space-y-4 mb-6">
                @forelse($siswas as $siswa)
                    @php
                        $statusState = match($siswa->status_pendaftaran) {
                            'Diterima' => ['bg' => 'bg-primary-50', 'text' => 'text-primary-700', 'border' => 'border-primary-200'],
                            'Ditolak' => ['bg' => 'bg-rose-50', 'text' => 'text-rose-700', 'border' => 'border-rose-200'],
                            default => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-700', 'border' => 'border-yellow-200'],
                        };
                    @endphp

                    <div class="bg-white rounded-2xl p-5 border border-neutral-200 shadow-sm relative">
                        <div class="flex justify-between items-start gap-4 mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-neutral-100 flex items-center justify-center text-neutral-600 font-bold text-sm border border-neutral-200">
                                    {{ substr($siswa->nama_lengkap, 0, 2) }}
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-neutral-900 line-clamp-1">{{ $siswa->nama_lengkap }}</h3>
                                    <p class="text-xs text-neutral-500 font-mono mt-0.5">{{ $siswa->nisn }}</p>
                                </div>
                            </div>
                            <span class="px-2.5 py-1 rounded-lg text-[10px] font-bold border {{ $statusState['bg'] }} {{ $statusState['text'] }} {{ $statusState['border'] }}">
                                {{ $siswa->status_pendaftaran }}
                            </span>
                        </div>

                        <div class="text-sm text-neutral-600 bg-neutral-50 p-3 rounded-xl border border-neutral-100 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-school text-neutral-400 text-xs"></i>
                            <span class="truncate">{{ $siswa->sekolahAsal?->nama_sekolah ?? '-' }}</span>
                        </div>

                        <a href="{{ route('admin.pendaftaran.detail', $siswa) }}" class="flex items-center justify-center w-full py-2.5 bg-white border border-neutral-200 text-neutral-600 text-sm font-bold rounded-xl hover:bg-neutral-50 transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                @empty
                    <div class="bg-white rounded-2xl border border-neutral-200 shadow-sm p-8 text-center">
                        <p class="text-sm font-medium text-neutral-500">Tidak ada data ditemukan.</p>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            @if($siswas->hasPages())
                <div class="bg-white rounded-2xl border border-neutral-200 shadow-sm px-4 py-3 flex items-center justify-between sm:px-6 mt-auto">
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
                    {{-- Mobile Pagination Simple --}}
                    <div class="flex justify-between w-full sm:hidden gap-2">
                         <a href="{{ $siswas->previousPageUrl() }}" class="flex-1 text-center px-4 py-2 border border-neutral-200 text-sm font-bold rounded-lg {{ $siswas->onFirstPage() ? 'bg-neutral-50 text-neutral-400 pointer-events-none' : 'bg-white text-neutral-600 hover:border-primary-500 hover:text-primary-600' }}">Prev</a>
                         <a href="{{ $siswas->nextPageUrl() }}" class="flex-1 text-center px-4 py-2 border border-neutral-200 text-sm font-bold rounded-lg {{ $siswas->hasMorePages() ? 'bg-white text-neutral-600 hover:border-primary-500 hover:text-primary-600' : 'bg-neutral-50 text-neutral-400 pointer-events-none' }}">Next</a>
                    </div>
                </div>
            @endif

        </div>
    </div>

    {{-- MODALS (Structure preserved, Colors Updated) --}}
    {{-- Modal Terima --}}
    <div x-show="activeModal === 'terima'" style="display:none" class="fixed inset-0 z-50 flex items-center justify-center px-4">
        <div class="absolute inset-0 bg-neutral-900/60 backdrop-blur-sm" @click="closeModal()" x-transition.opacity></div>
        <div class="relative w-full max-w-md bg-white rounded-2xl p-6 shadow-2xl scale-100" x-transition>
            <div class="text-center">
                <div class="mx-auto mb-4 w-14 h-14 rounded-full bg-primary-50 text-primary-600 flex items-center justify-center ring-4 ring-primary-50/50">
                    <i class="fa-solid fa-check text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-neutral-900">Terima Siswa?</h3>
                <p class="text-sm text-neutral-500 mt-2">Anda akan menerima <span class="font-bold text-neutral-800" x-text="selectedName"></span>.</p>
            </div>
            <div class="mt-6 flex gap-3">
                <button @click="closeModal()" class="w-full py-2.5 rounded-xl border border-neutral-200 text-neutral-600 font-bold hover:bg-neutral-50 transition">Batal</button>
                <form :action="'/admin/pendaftaran/' + selectedId + '/terima'" method="POST" class="w-full">
                    @csrf @method('PATCH')
                    <button type="submit" class="w-full py-2.5 rounded-xl bg-primary-600 text-white font-bold hover:bg-primary-700 shadow-lg shadow-primary-200 transition">Ya, Terima</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Tolak --}}
    <div x-show="activeModal === 'tolak'" style="display:none" class="fixed inset-0 z-50 flex items-center justify-center px-4">
        <div class="absolute inset-0 bg-neutral-900/60 backdrop-blur-sm" @click="closeModal()" x-transition.opacity></div>
        <div class="relative w-full max-w-md bg-white rounded-2xl p-6 shadow-2xl scale-100" x-transition>
            <div class="text-center">
                <div class="mx-auto mb-4 w-14 h-14 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center ring-4 ring-rose-50/50">
                    <i class="fa-solid fa-xmark text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-neutral-900">Tolak Siswa?</h3>
                <p class="text-sm text-neutral-500 mt-2">Anda akan menolak <span class="font-bold text-neutral-800" x-text="selectedName"></span>.</p>
            </div>
            <div class="mt-6 flex gap-3">
                <button @click="closeModal()" class="w-full py-2.5 rounded-xl border border-neutral-200 text-neutral-600 font-bold hover:bg-neutral-50 transition">Batal</button>
                <form :action="'/admin/pendaftaran/' + selectedId + '/tolak'" method="POST" class="w-full">
                    @csrf @method('PATCH')
                    <button type="submit" class="w-full py-2.5 rounded-xl bg-rose-600 text-white font-bold hover:bg-rose-700 shadow-lg shadow-rose-200 transition">Ya, Tolak</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Reset --}}
    <div x-show="activeModal === 'batalkan'" style="display:none" class="fixed inset-0 z-50 flex items-center justify-center px-4">
        <div class="absolute inset-0 bg-neutral-900/60 backdrop-blur-sm" @click="closeModal()" x-transition.opacity></div>
        <div class="relative w-full max-w-md bg-white rounded-2xl p-6 shadow-2xl scale-100" x-transition>
            <div class="text-center">
                <div class="mx-auto mb-4 w-14 h-14 rounded-full bg-yellow-50 text-yellow-600 flex items-center justify-center ring-4 ring-yellow-50/50">
                    <i class="fa-solid fa-rotate-left text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-neutral-900">Reset Status?</h3>
                <p class="text-sm text-neutral-500 mt-2">Status <span class="font-bold text-neutral-800" x-text="selectedName"></span> akan kembali ke pending.</p>
            </div>
            <div class="mt-6 flex gap-3">
                <button @click="closeModal()" class="w-full py-2.5 rounded-xl border border-neutral-200 text-neutral-600 font-bold hover:bg-neutral-50 transition">Batal</button>
                <form :action="'/admin/pendaftaran/' + selectedId + '/batalkan'" method="POST" class="w-full">
                    @csrf @method('PATCH')
                    <button type="submit" class="w-full py-2.5 rounded-xl bg-yellow-600 text-white font-bold hover:bg-yellow-700 shadow-lg shadow-yellow-200 transition">Ya, Reset</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection