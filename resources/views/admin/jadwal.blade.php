@extends('layouts.admin')

@section('title', 'Manajemen Jadwal')

@section('content')
<div class="p-4 sm:p-6 mt-12">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            Manajemen Jadwal Pendaftaran
        </h1>
        <button type="button"
                onclick="openAddModal()"
                class="px-4 py-2 text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            <span class="hidden sm:inline">Tambah Jadwal</span>
        </button>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel Jadwal --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3 w-16">Urutan</th>
                    <th class="px-6 py-3">Judul Kegiatan</th>
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3 w-48 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwals as $jadwal)
                    <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-900 dark:even:bg-gray-800 border-b dark:border-gray-700">
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ $jadwal->order }}</td>
                        <td class="px-6 py-4 font-semibold">{{ $jadwal->title }}</td>
                        <td class="px-6 py-4">{{ $jadwal->date_range }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-3">
                                <button type="button"
                                        onclick="openEditModal({{ $jadwal->id }}, @js($jadwal))"
                                        class="font-medium text-yellow-500 hover:underline">
                                    Edit
                                </button>
                                <form action="{{ route('admin.jadwal.destroy', $jadwal) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-red-500 hover:underline">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-6 py-6 text-center text-gray-500 dark:text-gray-400" colspan="4">
                            Belum ada data jadwal. Silakan tambahkan jadwal baru.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ===== Modal Tambah ===== --}}
<div id="addModal" class="fixed inset-0 z-50 hidden bg-black/50" aria-hidden="true">
    <div class="absolute left-1/2 top-1/2 w-11/12 max-w-lg -translate-x-1/2 -translate-y-1/2 rounded-lg bg-white p-6 shadow-xl dark:bg-gray-800">
        <div class="mb-4 flex items-start justify-between">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Tambah Jadwal Baru</h2>
            <button type="button" onclick="closeAddModal()" class="rounded p-1 text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700">✕</button>
        </div>
        <form action="{{ route('admin.jadwal.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Judul Kegiatan</label>
                <input type="text" name="title" required class="w-full rounded border border-gray-300 p-2 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal</label>
                <input type="text" name="date_range" placeholder="Contoh: 1 - 5 September 2025" required class="w-full rounded border border-gray-300 p-2 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                <textarea name="description" rows="3" required class="w-full rounded border border-gray-300 p-2 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"></textarea>
            </div>
             <div>
                <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Urutan Tampilan</label>
                <input type="number" name="order" value="0" required class="w-full rounded border border-gray-300 p-2 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeAddModal()" class="rounded bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">Batal</button>
                <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- ===== Modal Edit ===== --}}
<div id="editModal" class="fixed inset-0 z-50 hidden bg-black/50" aria-hidden="true">
    <div class="absolute left-1/2 top-1/2 w-11/12 max-w-lg -translate-x-1/2 -translate-y-1/2 rounded-lg bg-white p-6 shadow-xl dark:bg-gray-800">
        <div class="mb-4 flex items-start justify-between">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Edit Jadwal</h2>
            <button type="button" onclick="closeEditModal()" class="rounded p-1 text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700">✕</button>
        </div>
        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="edit_title" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Judul Kegiatan</label>
                <input type="text" name="title" id="edit_title" required class="w-full rounded border border-gray-300 p-2 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>
            <div>
                <label for="edit_date_range" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal</label>
                <input type="text" name="date_range" id="edit_date_range" required class="w-full rounded border border-gray-300 p-2 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>
            <div>
                <label for="edit_description" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                <textarea name="description" id="edit_description" rows="3" required class="w-full rounded border border-gray-300 p-2 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"></textarea>
            </div>
            <div>
                <label for="edit_order" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Urutan Tampilan</label>
                <input type="number" name="order" id="edit_order" required class="w-full rounded border border-gray-300 p-2 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeEditModal()" class="rounded bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">Batal</button>
                <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
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

    window.addEventListener('click', (e) => {
        if (e.target === addModal) closeAddModal();
        if (e.target === editModal) closeEditModal();
    });
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeAddModal();
            closeEditModal();
        }
    });
</script>
@endsection
