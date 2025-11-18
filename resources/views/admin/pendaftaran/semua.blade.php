@extends('layouts.admin')

@section('title', 'Data Pendaftar')

@section('content')
<div class="w-full min-h-screen bg-[#F8FAFC] px-4 pt-20 pb-10 lg:px-8 lg:pt-20 lg:pb-10 flex flex-col font-sans text-slate-800">

    <div class="max-w-7xl mx-auto w-full flex-1 flex flex-col">

        {{-- 1. HEADER SECTION --}}
        <div class="shrink-0 mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900">Data Pendaftar</h1>
                <p class="text-sm text-slate-500 mt-1 font-medium">Kelola dan verifikasi data calon peserta didik baru.</p>
            </div>
            
            {{-- Total Count Badge --}}
            <div class="flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-xl shadow-sm">
                <span class="flex h-2 w-2 rounded-full bg-blue-600"></span>
                <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">Total Data:</span>
                <span class="text-sm font-bold text-slate-900">{{ $siswas->total() }}</span>
            </div>
        </div>

        {{-- 2. ALERTS (AlpineJS Dismissible) --}}
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition.duration.300ms
                 class="shrink-0 mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-700 flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-check text-sm"></i>
                    </div>
                    <span class="text-sm font-bold">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-emerald-500 hover:text-emerald-700"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @endif

        {{-- 3. FILTER & SEARCH BAR --}}
        <div class="shrink-0 mb-6 bg-white p-4 rounded-2xl border border-slate-200 shadow-sm">
            <form action="{{ route('admin.pendaftaran.semua') }}" method="GET" class="grid grid-cols-1 lg:grid-cols-12 gap-4">
                
                {{-- Search Input --}}
                <div class="lg:col-span-5 relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border-2 border-slate-100 bg-slate-50 text-sm font-medium focus:border-blue-500 focus:ring-0 focus:bg-white transition-colors placeholder-slate-400" 
                           placeholder="Cari Nama, NISN, atau Asal Sekolah...">
                </div>

                {{-- Status Filter --}}
                <div class="lg:col-span-3 relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-filter"></i>
                    </div>
                    <select name="status" class="w-full pl-10 pr-8 py-2.5 rounded-xl border-2 border-slate-100 bg-slate-50 text-sm font-bold text-slate-600 focus:border-blue-500 focus:ring-0 focus:bg-white appearance-none cursor-pointer transition-colors">
                        <option value="">Semua Status</option>
                        <option value="Pending" @selected(request('status') == 'Pending')>Pending</option>
                        <option value="Diterima" @selected(request('status') == 'Diterima')>Diterima</option>
                        <option value="Ditolak" @selected(request('status') == 'Ditolak')>Ditolak</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="lg:col-span-4 flex gap-2">
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl text-sm font-bold shadow-sm shadow-blue-200 transition-all flex items-center justify-center gap-2">
                        Cari Data
                    </button>
                    <a href="{{ route('admin.pendaftaran.export', request()->query()) }}" class="bg-white border-2 border-slate-100 text-slate-600 hover:border-emerald-500 hover:text-emerald-600 px-4 py-2.5 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-2" title="Export Excel">
                        <i class="fa-solid fa-file-excel text-lg"></i>
                    </a>
                </div>
            </form>
        </div>

        {{-- 4. CONTENT TABLE / CARDS --}}
        <div class="flex-1">
            
            {{-- DESKTOP VIEW (TABLE) --}}
            <div class="hidden lg:block bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-500 uppercase tracking-wider">Calon Siswa</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-500 uppercase tracking-wider">NISN</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-500 uppercase tracking-wider">Asal Sekolah</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-500 uppercase tracking-wider text-center">Status</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-slate-500 uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($siswas as $siswa)
                            <tr class="hover:bg-blue-50/30 transition-colors group">
                                {{-- Nama --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-100 to-indigo-100 text-blue-600 flex items-center justify-center text-sm font-bold border border-white shadow-sm">
                                            {{ substr($siswa->nama_lengkap, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-800">{{ $siswa->nama_lengkap }}</p>
                                            <p class="text-xs text-slate-500">{{ $siswa->email ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                
                                {{-- NISN --}}
                                <td class="px-6 py-4">
                                    <span class="font-mono text-xs font-bold text-slate-600 bg-slate-100 px-2 py-1 rounded-md border border-slate-200">
                                        {{ $siswa->nisn }}
                                    </span>
                                </td>

                                {{-- Sekolah --}}
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium text-slate-700 flex items-center gap-2">
                                        <i class="fa-solid fa-school text-slate-400 text-xs"></i>
                                        {{ $siswa->asal_sekolah }}
                                    </p>
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $statusColor = match($siswa->status_pendaftaran) {
                                            'Diterima' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                            'Ditolak' => 'bg-rose-50 text-rose-700 border-rose-200',
                                            default => 'bg-amber-50 text-amber-700 border-amber-200',
                                        };
                                        $statusIcon = match($siswa->status_pendaftaran) {
                                            'Diterima' => 'fa-check-circle',
                                            'Ditolak' => 'fa-circle-xmark',
                                            default => 'fa-clock',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $statusColor }}">
                                        <i class="fa-solid {{ $statusIcon }}"></i>
                                        {{ $siswa->status_pendaftaran }}
                                    </span>
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2 opacity-100 lg:opacity-60 lg:group-hover:opacity-100 transition-all">
                                        
                                        {{-- Detail --}}
                                        <a href="{{ route('admin.pendaftaran.detail', $siswa) }}" class="w-8 h-8 rounded-lg flex items-center justify-center bg-white border border-slate-200 text-slate-500 hover:text-blue-600 hover:border-blue-200 hover:shadow-sm transition-all" title="Detail">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        @if($siswa->status_pendaftaran == 'Pending')
                                            {{-- Terima --}}
                                            <form action="{{ route('admin.pendaftaran.terima', $siswa) }}" method="POST" onsubmit="return confirm('Terima siswa ini?')">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center bg-white border border-slate-200 text-slate-500 hover:text-emerald-600 hover:border-emerald-200 hover:shadow-sm transition-all" title="Terima">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </form>

                                            {{-- Tolak --}}
                                            <form action="{{ route('admin.pendaftaran.tolak', $siswa) }}" method="POST" onsubmit="return confirm('Tolak siswa ini?')">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center bg-white border border-slate-200 text-slate-500 hover:text-rose-600 hover:border-rose-200 hover:shadow-sm transition-all" title="Tolak">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </form>
                                        @else
                                            {{-- Reset --}}
                                            <form action="{{ route('admin.pendaftaran.batalkan', $siswa) }}" method="POST" onsubmit="return confirm('Reset status ke Pending?')">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center bg-white border border-slate-200 text-slate-500 hover:text-amber-600 hover:border-amber-200 hover:shadow-sm transition-all" title="Reset Status">
                                                    <i class="fa-solid fa-rotate-left"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                            <i class="fa-solid fa-user-slash text-3xl text-slate-300"></i>
                                        </div>
                                        <h3 class="text-slate-900 font-bold text-lg">Tidak ada data ditemukan</h3>
                                        <p class="text-slate-500 text-sm mt-1">Coba ubah filter pencarian atau status.</p>
                                        <a href="{{ route('admin.pendaftaran.semua') }}" class="mt-4 text-sm font-bold text-blue-600 hover:underline">Reset Filter</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- MOBILE VIEW (CARDS) --}}
            <div class="lg:hidden space-y-4">
                @forelse($siswas as $siswa)
                    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm relative overflow-hidden">
                        
                        {{-- Status Banner --}}
                        <div class="absolute top-0 left-0 w-1.5 h-full 
                            {{ $siswa->status_pendaftaran == 'Diterima' ? 'bg-emerald-500' : ($siswa->status_pendaftaran == 'Ditolak' ? 'bg-rose-500' : 'bg-amber-500') }}">
                        </div>

                        <div class="pl-3">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 font-bold text-sm">
                                        {{ substr($siswa->nama_lengkap, 0, 2) }}
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-bold text-slate-900">{{ $siswa->nama_lengkap }}</h3>
                                        <p class="text-xs text-slate-500">{{ $siswa->nisn }}</p>
                                    </div>
                                </div>
                                
                                {{-- Mobile Status Badge --}}
                                @php
                                    $statusColor = match($siswa->status_pendaftaran) {
                                        'Diterima' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                        'Ditolak' => 'bg-rose-50 text-rose-700 border-rose-100',
                                        default => 'bg-amber-50 text-amber-700 border-amber-100',
                                    };
                                @endphp
                                <span class="px-2.5 py-1 rounded-lg text-[10px] font-bold border {{ $statusColor }}">
                                    {{ $siswa->status_pendaftaran }}
                                </span>
                            </div>

                            <div class="space-y-2 mb-5">
                                <div class="flex items-center gap-2 text-xs text-slate-600">
                                    <i class="fa-solid fa-school w-4 text-slate-400"></i>
                                    {{ $siswa->asal_sekolah }}
                                </div>
                                @if($siswa->email)
                                <div class="flex items-center gap-2 text-xs text-slate-600">
                                    <i class="fa-solid fa-envelope w-4 text-slate-400"></i>
                                    {{ $siswa->email }}
                                </div>
                                @endif
                            </div>

                            {{-- Mobile Actions --}}
                            <div class="grid grid-cols-4 gap-2 pt-4 border-t border-slate-100">
                                <a href="{{ route('admin.pendaftaran.detail', $siswa) }}" class="col-span-2 flex items-center justify-center gap-2 py-2 bg-blue-50 text-blue-700 text-xs font-bold rounded-lg">
                                    <i class="fa-solid fa-eye"></i> Detail
                                </a>
                                
                                @if($siswa->status_pendaftaran == 'Pending')
                                    <form action="{{ route('admin.pendaftaran.terima', $siswa) }}" method="POST" class="col-span-1" onsubmit="return confirm('Terima?')">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="w-full py-2 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-lg"><i class="fa-solid fa-check"></i></button>
                                    </form>
                                    <form action="{{ route('admin.pendaftaran.tolak', $siswa) }}" method="POST" class="col-span-1" onsubmit="return confirm('Tolak?')">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="w-full py-2 bg-rose-50 text-rose-700 text-xs font-bold rounded-lg"><i class="fa-solid fa-xmark"></i></button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.pendaftaran.batalkan', $siswa) }}" method="POST" class="col-span-2" onsubmit="return confirm('Reset?')">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="w-full py-2 bg-amber-50 text-amber-700 text-xs font-bold rounded-lg flex items-center justify-center gap-1">
                                            <i class="fa-solid fa-rotate-left"></i> Reset
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <p class="text-slate-500 text-sm">Tidak ada data.</p>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            @if($siswas->hasPages())
                <div class="mt-6">
                    {{ $siswas->withQueryString()->links('pagination::tailwind') }}
                </div>
            @endif

        </div>
    </div>
</div>
@endsection