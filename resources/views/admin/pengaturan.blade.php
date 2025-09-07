@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('content')
{{-- [DIPERBARUI] Menambahkan variabel 'editing' dan logika untuk tetap di mode edit jika ada error validasi --}}
<div x-data="{ tab: 'umum', editing: {{ $errors->any() ? 'true' : 'false' }} }" class="p-4 sm:p-6 mt-12">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            Pengaturan Website
        </h1>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif
    
    @if ($errors->any())
        <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-3 text-red-700">
            <strong>Terjadi kesalahan:</strong>
            <ul class="list-disc list-inside mt-1">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    {{-- Navigasi Tab --}}
    <div class="mb-6 border-b border-gray-200 dark:border-gray-700">
        <nav class="-mb-px flex space-x-6" aria-label="Tabs">
            <button @click="tab = 'umum'" 
                    :class="{ 'border-blue-600 text-blue-600': tab === 'umum', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'umum' }"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Pengaturan Umum
            </button>
            <button @click="tab = 'jadwal'" 
                    :class="{ 'border-blue-600 text-blue-600': tab === 'jadwal', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'jadwal' }"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Manajemen Jadwal
            </button>
        </nav>
    </div>

    {{-- Konten Tab: Pengaturan Umum --}}
    <div x-show="tab === 'umum'" x-transition>
        
        {{-- [BARU] Mode Tampilan (Read-Only) --}}
        <div x-show="!editing" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <div class="flex justify-end mb-4">
                <button type="button" @click="editing = true" class="px-4 py-2 text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L14.732 3.732z"></path></svg>
                    <span>Ubah Pengaturan</span>
                </button>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white border-b dark:border-gray-600 pb-3 mb-4">Pengaturan Pendaftaran</h3>
                    <dl class="space-y-4 text-sm">
                        <div class="flex"><dt class="w-1/3 font-medium text-gray-500">Status</dt><dd class="w-2/3"><span @class(['px-2.5 py-1 text-xs font-semibold rounded-full', 'bg-green-100 text-green-800' => $pengaturan->status == 'Dibuka', 'bg-red-100 text-red-800' => $pengaturan->status == 'Ditutup'])>{{ $pengaturan->status }}</span></dd></div>
                        <div class="flex"><dt class="w-1/3 font-medium text-gray-500">Tanggal Buka</dt><dd class="w-2/3 text-gray-900 dark:text-gray-200">{{ $pengaturan->tanggal_buka?->isoFormat('D MMMM YYYY') }}</dd></div>
                        <div class="flex"><dt class="w-1/3 font-medium text-gray-500">Tanggal Tutup</dt><dd class="w-2/3 text-gray-900 dark:text-gray-200">{{ $pengaturan->tanggal_tutup?->isoFormat('D MMMM YYYY') }}</dd></div>
                    </dl>
                </div>
                <div class="lg:col-span-1 bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white border-b dark:border-gray-600 pb-3 mb-4">Informasi Kontak</h3>
                     <dl class="space-y-4 text-sm">
                        <div class="flex flex-col"><dt class="font-medium text-gray-500">Alamat</dt><dd class="mt-1 text-gray-900 dark:text-gray-200">{{ $pengaturan->alamat_sekolah }}</dd></div>
                        <div class="flex"><dt class="w-1/3 font-medium text-gray-500">Telepon</dt><dd class="w-2/3 text-gray-900 dark:text-gray-200">{{ $pengaturan->telepon }}</dd></div>
                        <div class="flex"><dt class="w-1/3 font-medium text-gray-500">Email</dt><dd class="w-2/3 text-gray-900 dark:text-gray-200">{{ $pengaturan->email_kontak }}</dd></div>
                    </dl>
                </div>
            </div>
        </div>

        {{-- [BARU] Mode Edit (Formulir) --}}
        <div x-show="editing" x-transition style="display: none;">
            <form action="{{ route('admin.pengaturan.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white border-b dark:border-gray-600 pb-3 mb-4">Ubah Pengaturan Pendaftaran</h3>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status Pendaftaran</label>
                                <div class="flex items-center gap-6">
                                    <div class="flex items-center"><input type="radio" id="status_dibuka_edit" name="status" value="Dibuka" @checked(old('status', $pengaturan->status) == 'Dibuka') class="h-4 w-4"><label for="status_dibuka_edit" class="ml-2 block text-sm">Dibuka</label></div>
                                    <div class="flex items-center"><input type="radio" id="status_ditutup_edit" name="status" value="Ditutup" @checked(old('status', $pengaturan->status) == 'Ditutup') class="h-4 w-4"><label for="status_ditutup_edit" class="ml-2 block text-sm">Ditutup</label></div>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="tanggal_buka_edit" class="block text-sm font-medium">Tanggal Buka</label>
                                    <input type="date" name="tanggal_buka" id="tanggal_buka_edit" value="{{ old('tanggal_buka', $pengaturan->tanggal_buka?->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label for="tanggal_tutup_edit" class="block text-sm font-medium">Tanggal Tutup</label>
                                    <input type="date" name="tanggal_tutup" id="tanggal_tutup_edit" value="{{ old('tanggal_tutup', $pengaturan->tanggal_tutup?->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-1 bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white border-b dark:border-gray-600 pb-3 mb-4">Ubah Informasi Kontak</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="alamat_sekolah_edit" class="block text-sm font-medium">Alamat Sekolah</label>
                                <textarea name="alamat_sekolah" id="alamat_sekolah_edit" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('alamat_sekolah', $pengaturan->alamat_sekolah) }}</textarea>
                            </div>
                            <div>
                                <label for="telepon_edit" class="block text-sm font-medium">Telepon</label>
                                <input type="text" name="telepon" id="telepon_edit" value="{{ old('telepon', $pengaturan->telepon) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label for="email_kontak_edit" class="block text-sm font-medium">Email Kontak</label>
                                <input type="email" name="email_kontak" id="email_kontak_edit" value="{{ old('email_kontak', $pengaturan->email_kontak) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-8 pt-5 border-t dark:border-gray-600 flex justify-end gap-3">
                    <button type="button" @click="editing = false" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">Batal</button>
                    <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 transition">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Konten Tab: Manajemen Jadwal --}}
    <div x-show="tab === 'jadwal'" x-transition style="display: none;">
        <div class="flex justify-between items-center mb-6">
            <p class="text-gray-500">Kelola linimasa jadwal pendaftaran yang akan tampil di halaman depan.</p>
            <button type="button" onclick="openAddJadwalModal()" class="px-4 py-2 text-white bg-green-600 rounded-lg shadow hover:bg-green-700">
                + Tambah Jadwal
            </button>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3 w-16">Urutan</th>
                        <th class="px-6 py-3">Judul</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3 w-48 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwals as $jadwal)
                    <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-900 dark:even:bg-gray-800 border-b dark:border-gray-700">
                        <td class="px-6 py-4">{{ $jadwal->order }}</td>
                        <td class="px-6 py-4 font-semibold">{{ $jadwal->title }}</td>
                        <td class="px-6 py-4">{{ $jadwal->date_range }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-3">
                                <button type="button" onclick="openEditJadwalModal(@js($jadwal))" class="font-medium text-yellow-500 hover:underline">Edit</button>
                                <form action="{{ route('admin.pengaturan.jadwal.destroy', $jadwal) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="font-medium text-red-500 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td class="px-6 py-6 text-center text-gray-500" colspan="4">Belum ada data jadwal.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Tambah Jadwal --}}
<div id="addJadwalModal" class="fixed inset-0 z-50 hidden bg-black/50"><div class="absolute left-1/2 top-1/2 w-11/12 max-w-lg -translate-x-1/2 -translate-y-1/2 rounded-lg bg-white p-6 shadow-xl dark:bg-gray-800"><div class="mb-4 flex items-start justify-between"><h2 class="text-lg font-semibold">Tambah Jadwal Baru</h2><button type="button" onclick="closeAddJadwalModal()" class="rounded p-1">✕</button></div><form action="{{ route('admin.pengaturan.jadwal.store') }}" method="POST" class="space-y-4">@csrf<div><label>Judul</label><input type="text" name="title" required class="w-full rounded p-2 border"></div><div><label>Tanggal</label><input type="text" name="date_range" required class="w-full rounded p-2 border"></div><div><label>Deskripsi</label><textarea name="description" rows="3" required class="w-full rounded p-2 border"></textarea></div><div><label>Urutan</label><input type="number" name="order" value="0" required class="w-full rounded p-2 border"></div><div class="flex justify-end gap-2 pt-2"><button type="button" onclick="closeAddJadwalModal()" class="rounded bg-gray-200 px-4 py-2">Batal</button><button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white">Simpan</button></div></form></div></div>
{{-- Modal Edit Jadwal --}}
<div id="editJadwalModal" class="fixed inset-0 z-50 hidden bg-black/50"><div class="absolute left-1/2 top-1/2 w-11/12 max-w-lg -translate-x-1/2 -translate-y-1/2 rounded-lg bg-white p-6 shadow-xl dark:bg-gray-800"><div class="mb-4 flex items-start justify-between"><h2 class="text-lg font-semibold">Edit Jadwal</h2><button type="button" onclick="closeEditJadwalModal()" class="rounded p-1">✕</button></div><form id="editJadwalForm" method="POST" class="space-y-4">@csrf @method('PUT')<div><label>Judul</label><input type="text" name="title" id="edit_title" required class="w-full rounded p-2 border"></div><div><label>Tanggal</label><input type="text" name="date_range" id="edit_date_range" required class="w-full rounded p-2 border"></div><div><label>Deskripsi</label><textarea name="description" id="edit_description" rows="3" required class="w-full rounded p-2 border"></textarea></div><div><label>Urutan</label><input type="number" name="order" id="edit_order" required class="w-full rounded p-2 border"></div><div class="flex justify-end gap-2 pt-2"><button type="button" onclick="closeEditJadwalModal()" class="rounded bg-gray-200 px-4 py-2">Batal</button><button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white">Update</button></div></form></div></div>

<script>
    const addJadwalModal = document.getElementById('addJadwalModal');
    const editJadwalModal = document.getElementById('editJadwalModal');
    const editJadwalForm = document.getElementById('editJadwalForm');
    const updateJadwalUrl = "{{ route('admin.pengaturan.jadwal.update', ':id') }}";
    function openAddJadwalModal() { addJadwalModal.classList.remove('hidden'); }
    function closeAddJadwalModal() { addJadwalModal.classList.add('hidden'); }
    function closeEditJadwalModal() { editJadwalModal.classList.add('hidden'); }
    function openEditJadwalModal(jadwal) {
        document.getElementById('edit_title').value = jadwal.title;
        document.getElementById('edit_date_range').value = jadwal.date_range;
        document.getElementById('edit_description').value = jadwal.description;
        document.getElementById('edit_order').value = jadwal.order;
        editJadwalForm.action = updateJadwalUrl.replace(':id', jadwal.id);
        editJadwalModal.classList.remove('hidden');
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection

