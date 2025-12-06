@extends('layouts.admin')

@section('title', 'Konfigurasi PPDB')

@section('content')
{{-- ROOT CONTAINER --}}
<div x-data="{ editing: {{ $errors->any() ? 'true' : 'false' }} }"
     class="w-full min-h-screen bg-neutral-50 px-4 pt-8 lg:px-4 lg:pt-4 flex flex-col font-sans text-neutral-800">

    <div class="max-w-7xl mx-auto w-full flex-1 flex flex-col gap-6">

        {{-- 1. HEADER --}}
        <div class="shrink-0">
            <h1 class="text-2xl font-bold tracking-tight text-neutral-900">Konfigurasi PPDB</h1>
            <p class="text-sm text-neutral-500 mt-1">Pusat kendali operasional dan jadwal kegiatan.</p>
        </div>

        {{-- 2. ALERTS (PENGGANTI SWEETALERT) --}}
        <div class="flex flex-col gap-4">
            
            {{-- Alert Sukses --}}
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

            {{-- Alert Error (Validasi) --}}
            @if($errors->any())
                <div x-data="{ show: true }" x-show="show" x-transition.duration.300ms 
                     class="p-4 rounded-xl bg-rose-50 border border-rose-100 text-rose-800 flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-rose-200 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-triangle-exclamation text-rose-700 text-sm"></i>
                        </div>
                        <div class="text-sm">
                            <span class="font-bold block">Terdapat kesalahan input:</span>
                            <ul class="list-disc list-inside text-xs mt-1 text-rose-700">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button @click="show = false" class="text-rose-600 hover:text-rose-800 transition-colors"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif
        </div>

        {{-- 3. CONTENT AREA --}}
        <div class="flex-1 relative">

            {{-- A. VIEW MODE --}}
            <div x-show="!editing"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="h-full">

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 h-full">

                    {{-- CARD 1 (KIRI - 1/3): STATUS INFORMATIF --}}
                    <div class="lg:col-span-1 bg-white rounded-2xl border border-neutral-200 shadow-sm relative overflow-hidden group">

                        {{-- Background Accent --}}
                        <div class="absolute top-0 right-0 w-full h-1/2 bg-gradient-to-b {{ $pengaturan->status == 'Dibuka' ? 'from-primary-50/80 to-primary-100/20' : 'from-rose-50/80 to-rose-100/20' }} to-transparent"></div>

                        <div class="flex flex-col h-full relative z-10">
                            {{-- Header Card --}}
                            <div class="p-6 pb-4 border-b border-neutral-100">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-xs font-bold text-neutral-400 uppercase tracking-widest">Status Sistem</h3>
                                    <div x-show="!editing">
                                        <button @click="editing = true"
                                                class="flex items-center gap-2 px-3 py-1.5 bg-white border border-neutral-200 text-neutral-600 text-xs font-bold rounded-lg shadow-sm hover:text-primary-600 hover:border-primary-200 transition-all">
                                            <i class="fa-solid fa-sliders"></i>
                                            <span>Ubah</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Content Area --}}
                            <div class="flex-1 p-6 flex flex-col justify-between text-center">
                                <div>
                                    <div class="w-20 h-20 rounded-2xl flex items-center justify-center mb-5 mx-auto shadow-sm ring-1 ring-inset {{ $pengaturan->status == 'Dibuka' ? 'bg-primary-50 text-primary-600 ring-primary-100' : 'bg-rose-50 text-rose-600 ring-rose-100' }}">
                                        <i class="fa-solid {{ $pengaturan->status == 'Dibuka' ? 'fa-lock-open' : 'fa-lock' }} text-3xl"></i>
                                    </div>

                                    @if($pengaturan->status == 'Dibuka')
                                        <h2 class="text-2xl font-bold text-neutral-900 tracking-tight mb-2">PENDAFTARAN DIBUKA</h2>
                                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-primary-50 text-primary-700 border border-primary-200">
                                            <span class="w-2 h-2 rounded-full bg-primary-500 animate-pulse"></span>
                                            Sistem Online
                                        </span>
                                    @else
                                        <h2 class="text-2xl font-bold text-neutral-900 tracking-tight mb-2">PENDAFTARAN DITUTUP</h2>
                                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                            <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                            Sistem Offline
                                        </span>
                                    @endif
                                </div>

                                {{-- Additional Info --}}
                                <div class="space-y-3 mt-8 pt-6 border-t border-neutral-100">
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-neutral-500">Tahun Ajaran</span>
                                        <span class="font-bold text-neutral-800 bg-neutral-100 px-2 py-1 rounded">
                                            {{ $pengaturan->tahun_ajaran ?? '-' }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-neutral-500">Periode</span>
                                        <span class="font-bold text-neutral-800">
                                            @if($pengaturan->tanggal_buka && $pengaturan->tanggal_tutup)
                                                {{ $pengaturan->tanggal_buka->format('d M') }} - {{ $pengaturan->tanggal_tutup->format('d M Y') }}
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- CARD 2 (KANAN - 2/3): TABEL JADWAL --}}
                    <div class="lg:col-span-2 flex flex-col h-full bg-white rounded-2xl border border-neutral-200 shadow-sm overflow-hidden">

                        {{-- Toolbar Tabel --}}
                        <div class="px-6 py-4 border-b border-neutral-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-neutral-50/30">
                            <div class="flex items-center gap-3">
                                <h3 class="text-sm font-bold text-neutral-800 flex items-center gap-2">
                                    <span class="w-1.5 h-4 bg-primary-500 rounded-full"></span>
                                    Jadwal Kegiatan
                                </h3>
                            </div>
                            <button type="button" onclick="openAddModal()"
                                    class="flex items-center gap-2 px-4 py-2 bg-primary-600 text-white text-xs font-bold rounded-lg shadow-sm hover:bg-primary-700 transition-all hover:shadow-md">
                                <i class="fa-solid fa-plus"></i> Tambah
                            </button>
                        </div>

                        {{-- Area Tabel --}}
                        <div class="flex-1 overflow-y-auto relative">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-neutral-50 sticky top-0 z-10 border-b border-neutral-200">
                                    <tr>
                                        <th class="px-6 py-3 text-[10px] font-bold text-neutral-500 uppercase tracking-wider w-16 text-center">Urutan</th>
                                        <th class="px-6 py-3 text-[10px] font-bold text-neutral-500 uppercase tracking-wider">Kegiatan</th>
                                        <th class="px-6 py-3 text-[10px] font-bold text-neutral-500 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-3 text-[10px] font-bold text-neutral-500 uppercase tracking-wider text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-100">
                                    @forelse($jadwals as $jadwal)
                                        <tr class="hover:bg-primary-50/20 transition-colors group">
                                            <td class="px-6 py-4 text-center">
                                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-md bg-neutral-100 text-neutral-600 text-xs font-bold border border-neutral-200">
                                                    {{ $jadwal->order }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <p class="text-sm font-bold text-neutral-800">{{ $jadwal->title }}</p>
                                                <p class="text-xs text-neutral-500 mt-0.5 line-clamp-1">{{ $jadwal->description }}</p>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-white border border-neutral-200 text-xs font-semibold text-neutral-600 shadow-sm">
                                                    <i class="fa-regular fa-calendar text-neutral-400"></i>
                                                    {{ $jadwal->date_range }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex items-center justify-end gap-2 opacity-80 group-hover:opacity-100 transition-opacity">
                                                    <button onclick="openEditModal({{ $jadwal->id }}, {{ json_encode($jadwal) }})"
                                                            class="w-8 h-8 rounded-lg flex items-center justify-center text-neutral-400 hover:text-primary-600 hover:bg-primary-50 transition-all border border-transparent hover:border-primary-100"
                                                            title="Edit">
                                                        <i class="fa-solid fa-pen text-xs"></i>
                                                    </button>
                                                    <form action="{{ route('admin.jadwal.destroy', $jadwal) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini? Data tidak dapat dikembalikan.');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center text-neutral-400 hover:text-rose-600 hover:bg-rose-50 transition-all border border-transparent hover:border-rose-100"
                                                                title="Hapus">
                                                            <i class="fa-solid fa-trash text-xs"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-16 text-center">
                                                <div class="flex flex-col items-center justify-center">
                                                    <div class="w-14 h-14 bg-neutral-100 rounded-full flex items-center justify-center mb-3">
                                                        <i class="fa-regular fa-calendar-xmark text-2xl text-neutral-300"></i>
                                                    </div>
                                                    <p class="text-sm font-medium text-neutral-500">Belum ada jadwal kegiatan.</p>
                                                    <button onclick="openAddModal()" class="mt-2 text-xs font-bold text-primary-600 hover:underline">Tambah Sekarang</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- B. EDIT MODE (OVERLAY FORM) --}}
            <div x-show="editing" style="display: none;"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="absolute inset-0 bg-white rounded-2xl shadow-2xl border border-neutral-200 overflow-hidden flex flex-col z-20">

                <form action="{{ route('admin.pengaturan.update') }}" method="POST" class="flex flex-col h-full">
                    @csrf
                    @method('PUT')

                    {{-- Form Header --}}
                    <div class="px-6 py-4 border-b border-neutral-100 flex justify-between items-center shrink-0 bg-neutral-50/50">
                        <h3 class="text-sm font-bold text-neutral-800 uppercase tracking-wide flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-primary-600"></span> Mode Edit Konfigurasi
                        </h3>
                        <button type="button" @click="editing = false" class="text-neutral-400 hover:text-rose-500 transition-colors">
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>
                    </div>

                    {{-- Form Body --}}
                    <div class="p-6 grid grid-cols-1 lg:grid-cols-2 gap-8 overflow-y-auto flex-1">

                        {{-- Kolom Kiri: Status --}}
                        <div class="space-y-6">
                            <div>
                                <label class="block text-xs font-bold text-neutral-500 uppercase tracking-wider mb-3">Status Pendaftaran</label>
                                <div class="grid grid-cols-2 gap-4">
                                    {{-- Radio BUKA (Teal) --}}
                                    <label class="cursor-pointer relative group">
                                        <input type="radio" name="status" value="Dibuka" class="peer sr-only" @checked(old('status', $pengaturan->status) == 'Dibuka')>
                                        <div class="p-4 rounded-xl border-2 border-neutral-100 hover:border-primary-400 peer-checked:border-primary-500 peer-checked:bg-primary-50/30 peer-checked:text-primary-700 transition-all text-center h-full flex flex-col justify-center items-center">
                                            <i class="fa-solid fa-lock-open text-2xl mb-2 opacity-40 peer-checked:opacity-100"></i>
                                            <span class="block text-sm font-bold">DIBUKA</span>
                                        </div>
                                        <div class="absolute top-3 right-3 text-primary-500 opacity-0 peer-checked:opacity-100 transition-opacity"><i class="fa-solid fa-circle-check"></i></div>
                                    </label>

                                    {{-- Radio TUTUP (Rose) --}}
                                    <label class="cursor-pointer relative group">
                                        <input type="radio" name="status" value="Ditutup" class="peer sr-only" @checked(old('status', $pengaturan->status) == 'Ditutup')>
                                        <div class="p-4 rounded-xl border-2 border-neutral-100 hover:border-rose-400 peer-checked:border-rose-500 peer-checked:bg-rose-50/30 peer-checked:text-rose-700 transition-all text-center h-full flex flex-col justify-center items-center">
                                            <i class="fa-solid fa-lock text-2xl mb-2 opacity-40 peer-checked:opacity-100"></i>
                                            <span class="block text-sm font-bold">DITUTUP</span>
                                        </div>
                                        <div class="absolute top-3 right-3 text-rose-500 opacity-0 peer-checked:opacity-100 transition-opacity"><i class="fa-solid fa-circle-check"></i></div>
                                    </label>
                                </div>
                            </div>
                            
                            {{-- Tahun Ajaran --}}
                            <div>
                                <label class="block text-xs font-bold text-neutral-500 uppercase tracking-wider mb-2">
                                    Tahun Ajaran
                                </label>
                                <input type="text" name="tahun_ajaran"
                                    value="{{ old('tahun_ajaran', $pengaturan->tahun_ajaran) }}"
                                    placeholder="Contoh: 2024/2025"
                                    class="w-full px-3 py-2.5 bg-white border border-neutral-300 rounded-lg 
                                            text-sm focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 text-neutral-700 font-bold transition-all shadow-sm">
                            </div>
                        </div>

                        {{-- Kolom Kanan: Jadwal Dates --}}
                        <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-100 flex flex-col justify-center">
                            <label class="block text-xs font-bold text-neutral-500 uppercase tracking-wider mb-4 border-b border-neutral-200 pb-2">Jadwal Pelaksanaan Utama</label>

                            <div class="space-y-4">
                                <div>
                                    <span class="text-xs font-semibold text-neutral-500 mb-1 block ml-1">Tanggal Mulai</span>
                                    <input type="date" name="tanggal_buka" value="{{ old('tanggal_buka', $pengaturan->tanggal_buka?->format('Y-m-d')) }}"
                                           class="w-full px-3 py-2.5 bg-white border border-neutral-300 rounded-lg text-sm focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 text-neutral-700 font-bold transition-all shadow-sm">
                                </div>
                                <div>
                                    <span class="text-xs font-semibold text-neutral-500 mb-1 block ml-1">Tanggal Selesai</span>
                                    <input type="date" name="tanggal_tutup" value="{{ old('tanggal_tutup', $pengaturan->tanggal_tutup?->format('Y-m-d')) }}"
                                           class="w-full px-3 py-2.5 bg-white border border-neutral-300 rounded-lg text-sm focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 text-neutral-700 font-bold transition-all shadow-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Form Footer --}}
                    <div class="px-6 py-4 border-t border-neutral-100 bg-neutral-50 flex justify-end gap-3 shrink-0">
                        <button type="button" @click="editing = false" class="px-5 py-2.5 rounded-xl text-xs font-bold text-neutral-600 bg-white border border-neutral-200 hover:bg-neutral-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-primary-600 hover:bg-primary-700 shadow-lg shadow-primary-200 transition-colors">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div id="addModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-neutral-900/60 backdrop-blur-sm transition-opacity" onclick="closeAddModal()"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-neutral-200">
                <form action="{{ route('admin.jadwal.store') }}" method="POST">
                    @csrf
                    <div class="bg-white px-6 pb-6 pt-6">
                        <div class="flex items-center gap-3 mb-1">
                            <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-600">
                                <i class="fa-solid fa-calendar-plus text-sm"></i>
                            </div>
                            <h3 class="text-lg font-bold text-neutral-900">Tambah Kegiatan</h3>
                        </div>
                        <p class="text-xs text-neutral-500 mb-6 pl-11">Isi detail kegiatan untuk ditampilkan di jadwal.</p>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-neutral-500 uppercase mb-1">Judul Kegiatan</label>
                                <input type="text" name="title" required placeholder="Masukkan judul kegiatan" 
                                       class="w-full rounded-lg border-neutral-300 text-sm focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 font-medium placeholder-neutral-400">
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-2">
                                    <label class="block text-xs font-bold text-neutral-500 uppercase mb-1">Tanggal / Rentang</label>
                                    <input type="text" name="date_range" placeholder="Contoh: 10 - 15 Juli" required 
                                           class="w-full rounded-lg border-neutral-300 text-sm focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 font-medium placeholder-neutral-400">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-neutral-500 uppercase mb-1">Urutan</label>
                                    <input type="number" name="order" value="1" required placeholder="Urutan" 
                                           class="w-full rounded-lg border-neutral-300 text-sm focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 font-medium text-center">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-neutral-500 uppercase mb-1">Deskripsi Singkat</label>
                                <textarea name="description" rows="2" placeholder="Tambahkan deskripsi singkat (opsional)" 
                                          class="w-full rounded-lg border-neutral-300 text-sm focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 font-medium placeholder-neutral-400"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="bg-neutral-50 px-6 py-4 flex flex-row-reverse gap-3 border-t border-neutral-100">
                        <button type="submit" class="inline-flex w-full justify-center rounded-xl bg-primary-600 px-4 py-2.5 text-sm font-bold text-white shadow-lg shadow-primary-200 hover:bg-primary-700 sm:w-auto">Simpan</button>
                        <button type="button" onclick="closeAddModal()" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-4 py-2.5 text-sm font-bold text-neutral-600 shadow-sm border border-neutral-200 hover:bg-neutral-50 sm:mt-0 sm:w-auto">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- MODAL EDIT --}}
<div id="editModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-neutral-900/60 backdrop-blur-sm transition-opacity" onclick="closeEditModal()"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-neutral-200">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="bg-white px-6 pb-6 pt-6">
                        <div class="flex items-center gap-3 mb-1">
                            <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-600">
                                <i class="fa-solid fa-pen-to-square text-sm"></i>
                            </div>
                            <h3 class="text-lg font-bold text-neutral-900">Edit Kegiatan</h3>
                        </div>
                        <p class="text-xs text-neutral-500 mb-6 pl-11">Perbarui informasi jadwal kegiatan.</p>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-neutral-500 uppercase mb-1">Judul Kegiatan</label>
                                <input type="text" name="title" id="edit_title" required 
                                       class="w-full rounded-lg border-neutral-300 text-sm focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 font-medium">
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-2">
                                    <label class="block text-xs font-bold text-neutral-500 uppercase mb-1">Tanggal / Rentang</label>
                                    <input type="text" name="date_range" id="edit_date_range" required 
                                           class="w-full rounded-lg border-neutral-300 text-sm focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 font-medium">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-neutral-500 uppercase mb-1">Urutan</label>
                                    <input type="number" name="order" id="edit_order" required 
                                           class="w-full rounded-lg border-neutral-300 text-sm focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 font-medium text-center">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-neutral-500 uppercase mb-1">Deskripsi Singkat</label>
                                <textarea name="description" id="edit_description" rows="2" 
                                          class="w-full rounded-lg border-neutral-300 text-sm focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 font-medium"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="bg-neutral-50 px-6 py-4 flex flex-row-reverse gap-3 border-t border-neutral-100">
                        <button type="submit" class="inline-flex w-full justify-center rounded-xl bg-primary-600 px-4 py-2.5 text-sm font-bold text-white shadow-lg shadow-primary-200 hover:bg-primary-700 sm:w-auto">Update</button>
                        <button type="button" onclick="closeEditModal()" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-4 py-2.5 text-sm font-bold text-neutral-600 shadow-sm border border-neutral-200 hover:bg-neutral-50 sm:mt-0 sm:w-auto">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // VANILLA JS FOR MODAL HANDLERS
    const addModal = document.getElementById('addModal');
    const editModal = document.getElementById('editModal');
    const editForm = document.getElementById('editForm');
    const updateUrlTemplate = "{{ route('admin.jadwal.update', ':id') }}";

    function openAddModal() { addModal.classList.remove('hidden'); }
    function closeAddModal() { addModal.classList.add('hidden'); }
    function closeEditModal() { editModal.classList.add('hidden'); }

    function openEditModal(id, jadwal) {
        document.getElementById('edit_title').value = jadwal.title;
        document.getElementById('edit_date_range').value = jadwal.date_range;
        document.getElementById('edit_description').value = jadwal.description;
        document.getElementById('edit_order').value = jadwal.order;
        editForm.action = updateUrlTemplate.replace(':id', id);
        editModal.classList.remove('hidden');
    }

    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeAddModal();
            closeEditModal();
        }
    });
</script>
@endpush

@endsection