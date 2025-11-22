@extends('layouts.admin')

@section('title', 'Konfigurasi PPDB')

@section('content')
{{-- ROOT CONTAINER --}}
<div x-data="{ editing: {{ $errors->any() ? 'true' : 'false' }} }" 
     class="w-full min-h-screen lg:h-screen bg-[#F8FAFC] px-4 pt-20 pb-6 lg:px-8 lg:pt-16 lg:pb-0 flex flex-col font-sans text-slate-800">

    <div class="max-w-7xl mx-auto w-full flex-1 flex flex-col lg:justify-center">

        {{-- 1. HEADER --}}
        <div class="shrink-0 mb-8">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900">Konfigurasi PPDB</h1>
                <p class="text-sm text-slate-500 mt-1 font-medium">Pusat kendali operasional sistem.</p>
            </div>
        </div>

        {{-- ALERTS --}}
        @if(session('success'))
            <div class="shrink-0 mb-6 p-4 rounded-lg bg-emerald-50 border border-emerald-100 text-emerald-700 flex items-center gap-3 shadow-sm animate-fade-in-down">
                <i class="fa-solid fa-circle-check"></i>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="shrink-0 mb-6 p-4 rounded-lg bg-rose-50 border border-rose-100 text-rose-700 shadow-sm animate-fade-in-down">
                <div class="flex items-center gap-2 mb-1">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span class="font-bold text-sm">Periksa Inputan:</span>
                </div>
                <ul class="list-disc list-inside text-sm ml-5 opacity-80">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        {{-- 2. CONTENT AREA --}}
        <div class="flex-1 lg:overflow-y-auto lg:pr-2 scrollbar-hide pb-6 relative">

            {{-- A. VIEW MODE --}}
            <div x-show="!editing" 
                 x-transition:enter="transition ease-out duration-300" 
                 x-transition:enter-start="opacity-0 translate-y-2" 
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="h-full">
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 h-full">
                    
                    {{-- CARD 1 (KIRI - 1/3): STATUS INFORMATIF --}}
                    <div class="lg:col-span-1 bg-white rounded-xl border border-slate-200 shadow-sm relative overflow-hidden group">
                        
                        {{-- Background Accent --}}
                        <div class="absolute top-0 right-0 w-full h-1/2 bg-gradient-to-b {{ $pengaturan->status == 'Dibuka' ? 'from-emerald-50/50 to-emerald-25/30' : 'from-rose-50/50 to-rose-25/30' }} to-transparent"></div>

                        <div class="flex flex-col h-full relative z-10">
                            {{-- Header Card --}}
                            <div class="p-6 pb-4 border-b border-slate-100">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest">Status Sistem</h3>
                                    <div x-show="!editing" class="transition-all duration-300">
                                        <button @click="editing = true" 
                                                class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-xs font-bold rounded-lg shadow-sm hover:bg-blue-700 transition-all focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                            <i class="fa-solid fa-sliders"></i>
                                            <span>Sesuaikan</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Content Area --}}
                            <div class="flex-1 p-6 flex flex-col justify-between">
                                {{-- Icon & Status --}}
                                <div class="text-center mb-6">
                                    <div class="w-20 h-20 rounded-2xl flex items-center justify-center mb-4 mx-auto shadow-sm {{ $pengaturan->status == 'Dibuka' ? 'bg-emerald-100 text-emerald-600' : 'bg-rose-100 text-rose-600' }}">
                                        <i class="fa-solid {{ $pengaturan->status == 'Dibuka' ? 'fa-lock-open' : 'fa-lock' }} text-4xl"></i>
                                    </div>

                                    @if($pengaturan->status == 'Dibuka')
                                        <h2 class="text-3xl font-black text-slate-900 tracking-tight mb-2">DIBUKA</h2>
                                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                            Pendaftaran Sedang Dibuka
                                        </span>
                                    @else
                                        <h2 class="text-3xl font-black text-slate-900 tracking-tight mb-2">DITUTUP</h2>
                                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                            <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                            Pendaftaran Saat Ini Ditutup
                                        </span>
                                    @endif
                                </div>

                                {{-- Additional Info --}}
                                <div class="space-y-3 mt-6 pt-4 border-t border-slate-100">
                            
                                    {{-- Tahun Ajaran --}}
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-slate-500">Tahun Ajaran:</span>
                                        <span class="font-bold text-slate-800">
                                            {{ $pengaturan->tahun_ajaran ?? '-' }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-slate-500">Periode:</span>
                                        <span class="font-bold text-slate-800">
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
                    <div class="lg:col-span-2 flex flex-col h-full bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                        
                        {{-- Toolbar Tabel --}}
                        <div class="px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-slate-50/50 shrink-0">
                            <div class="flex items-center gap-3">
                                <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                                    <span class="w-1.5 h-4 bg-purple-600 rounded-full"></span>
                                    Daftar Kegiatan PPDB
                                </h3>
                            </div>
                            <button type="button" onclick="openAddModal()" 
                                    class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-xs font-bold rounded-lg shadow-sm hover:bg-blue-700 transition-all">
                                <i class="fa-solid fa-plus"></i> Tambah Kegiatan
                            </button>
                        </div>

                        {{-- Area Tabel (Scrollable) --}}
                        <div class="flex-1 overflow-y-auto relative">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-slate-50 sticky top-0 z-10 shadow-sm">
                                    <tr>
                                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider w-16 text-center">Urutan</th>
                                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Kegiatan</th>
                                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tanggal/Rentang</th>
                                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @forelse($jadwals as $jadwal)
                                        <tr class="hover:bg-blue-50/30 transition-colors group">
                                            <td class="px-6 py-4 text-center">
                                                <span class="inline-flex items-center justify-center w-6 h-6 rounded bg-slate-100 text-slate-600 text-xs font-bold">
                                                    {{ $jadwal->order }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <p class="text-sm font-bold text-slate-800">{{ $jadwal->title }}</p>
                                                <p class="text-xs text-slate-500 mt-0.5 line-clamp-1">{{ $jadwal->description }}</p>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-600">
                                                    <i class="fa-regular fa-calendar text-slate-400"></i>
                                                    {{ $jadwal->date_range }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    <button onclick="openEditModal({{ $jadwal->id }}, {{ json_encode($jadwal) }})" 
                                                            class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all hover:scale-110">
                                                        <i class="fa-solid fa-pen text-xs"></i>
                                                    </button>
                                                    <form action="{{ route('admin.jadwal.destroy', $jadwal) }}" method="POST" onsubmit="return confirm('Hapus kegiatan ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-all hover:scale-110">
                                                            <i class="fa-solid fa-trash text-xs"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-12 text-center">
                                                <div class="flex flex-col items-center justify-center">
                                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                                                        <i class="fa-regular fa-calendar-xmark text-2xl text-slate-300"></i>
                                                    </div>
                                                    <p class="text-sm font-medium text-slate-500">Belum ada jadwal kegiatan.</p>
                                                    <button onclick="openAddModal()" class="mt-2 text-xs font-bold text-blue-600 hover:underline">Tambah Sekarang</button>
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
                 class="absolute inset-0 bg-white rounded-xl shadow-2xl border border-slate-200 overflow-hidden flex flex-col z-20">
                
                <form action="{{ route('admin.pengaturan.update') }}" method="POST" class="flex flex-col h-full">
                    @csrf
                    @method('PUT')
                    
                    {{-- Form Header --}}
                    <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center shrink-0 bg-slate-50/50">
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-blue-600"></span> Mode Edit Konfigurasi
                        </h3>
                        <button type="button" @click="editing = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>
                    </div>

                    {{-- Form Body --}}
                    <div class="p-6 grid grid-cols-1 lg:grid-cols-2 gap-8 overflow-y-auto flex-1">
                        
                        {{-- Kolom Kiri: Status --}}
                        <div class="space-y-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">Status Pendaftaran</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <label class="cursor-pointer relative group">
                                        <input type="radio" name="status" value="Dibuka" class="peer sr-only" @checked(old('status', $pengaturan->status) == 'Dibuka')>
                                        <div class="p-4 rounded-xl border-2 border-slate-100 hover:border-emerald-400 peer-checked:border-emerald-500 peer-checked:bg-emerald-50/30 peer-checked:text-emerald-700 transition-colors text-center h-full flex flex-col justify-center items-center">
                                            <i class="fa-solid fa-lock-open text-xl mb-2 opacity-50 peer-checked:opacity-100"></i>
                                            <span class="block text-sm font-bold">DIBUKA</span>
                                        </div>
                                        <div class="absolute top-3 right-3 text-emerald-500 opacity-0 peer-checked:opacity-100 transition-opacity"><i class="fa-solid fa-circle-check"></i></div>
                                    </label>

                                    <label class="cursor-pointer relative group">
                                        <input type="radio" name="status" value="Ditutup" class="peer sr-only" @checked(old('status', $pengaturan->status) == 'Ditutup')>
                                        <div class="p-4 rounded-xl border-2 border-slate-100 hover:border-rose-400 peer-checked:border-rose-500 peer-checked:bg-rose-50/30 peer-checked:text-rose-700 transition-colors text-center h-full flex flex-col justify-center items-center">
                                            <i class="fa-solid fa-lock text-xl mb-2 opacity-50 peer-checked:opacity-100"></i>
                                            <span class="block text-sm font-bold">DITUTUP</span>
                                        </div>
                                        <div class="absolute top-3 right-3 text-rose-500 opacity-0 peer-checked:opacity-100 transition-opacity"><i class="fa-solid fa-circle-check"></i></div>
                                    </label>
                                </div>
                            </div>
                            {{-- Tahun Ajaran --}}
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">
                                    Tahun Ajaran
                                </label>
                                <input type="text" name="tahun_ajaran"
                                    value="{{ old('tahun_ajaran', $pengaturan->tahun_ajaran) }}"
                                    placeholder="Contoh: 2024/2025"
                                    class="w-full px-3 py-2 bg-white border-2 border-slate-200 rounded-lg 
                                            text-xs focus:border-blue-500 focus:ring-0 text-slate-700 font-bold shadow-sm">
                            </div>

                        </div>

                        {{-- Kolom Kanan: Jadwal Dates --}}
                        <div class="bg-slate-50 rounded-xl p-6 border border-slate-100 flex flex-col justify-center">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-4 border-b border-slate-200 pb-2">Jadwal Pelaksanaan Utama</label>
                            
                            <div class="space-y-4">
                                <div>
                                    <span class="text-xs font-semibold text-slate-500 mb-1 block ml-1">Tanggal Mulai</span>
                                    <input type="date" name="tanggal_buka" value="{{ old('tanggal_buka', $pengaturan->tanggal_buka?->format('Y-m-d')) }}" 
                                           class="w-full px-3 py-2 bg-white border-2 border-slate-200 rounded-lg text-xs focus:border-blue-500 focus:ring-0 text-slate-700 font-bold shadow-sm">
                                </div>
                                <div>
                                    <span class="text-xs font-semibold text-slate-500 mb-1 block ml-1">Tanggal Selesai</span>
                                    <input type="date" name="tanggal_tutup" value="{{ old('tanggal_tutup', $pengaturan->tanggal_tutup?->format('Y-m-d')) }}" 
                                           class="w-full px-3 py-2 bg-white border-2 border-slate-200 rounded-lg text-xs focus:border-blue-500 focus:ring-0 text-slate-700 font-bold shadow-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Form Footer --}}
                    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30 flex justify-end gap-3 shrink-0">
                        <button type="button" @click="editing = false" class="px-5 py-2 rounded-lg text-xs font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2 rounded-lg text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-sm transition-colors">
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
    <div class="fixed inset-0 bg-slate-900/20 backdrop-blur-sm transition-opacity" onclick="closeAddModal()"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-200">
                <form action="{{ route('admin.jadwal.store') }}" method="POST">
                    @csrf
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <h3 class="text-lg font-bold text-slate-900 mb-1">Tambah Kegiatan Baru</h3>
                        <p class="text-xs text-slate-500 mb-6">Isi detail kegiatan untuk ditampilkan di jadwal.</p>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Judul Kegiatan</label>
                                <input type="text" name="title" required class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-500 focus:ring-0 font-medium placeholder-slate-300">
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-2">
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Tanggal / Rentang</label>
                                    <input type="text" name="date_range" placeholder="Contoh: 10 - 15 Juli" required class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-500 focus:ring-0 font-medium placeholder-slate-300">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Urutan</label>
                                    <input type="number" name="order" value="1" required class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-500 focus:ring-0 font-medium text-center">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Deskripsi Singkat</label>
                                <textarea name="description" rows="2" class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-500 focus:ring-0 font-medium placeholder-slate-300"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t border-slate-100">
                        <button type="submit" class="inline-flex w-full justify-center rounded-lg bg-blue-600 px-3 py-2 text-sm font-bold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Simpan</button>
                        <button type="button" onclick="closeAddModal()" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-3 py-2 text-sm font-bold text-slate-600 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- MODAL EDIT --}}
<div id="editModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/20 backdrop-blur-sm transition-opacity" onclick="closeEditModal()"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-200">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <h3 class="text-lg font-bold text-slate-900 mb-1">Edit Kegiatan</h3>
                        <p class="text-xs text-slate-500 mb-6">Perbarui informasi kegiatan ini.</p>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Judul Kegiatan</label>
                                <input type="text" name="title" id="edit_title" required class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-500 focus:ring-0 font-medium">
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-2">
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Tanggal / Rentang</label>
                                    <input type="text" name="date_range" id="edit_date_range" required class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-500 focus:ring-0 font-medium">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Urutan</label>
                                    <input type="number" name="order" id="edit_order" required class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-500 focus:ring-0 font-medium text-center">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Deskripsi Singkat</label>
                                <textarea name="description" id="edit_description" rows="2" class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-500 focus:ring-0 font-medium"></textarea>
                            </div>
                        </div>
                    </div>
                        
                    <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t border-slate-100">
                        <button type="submit" class="inline-flex w-full justify-center rounded-lg bg-blue-600 px-3 py-2 text-sm font-bold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Update</button>
                        <button type="button" onclick="closeEditModal()" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-3 py-2 text-sm font-bold text-slate-600 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
@endsection