@extends('layouts.admin')

@section('content')
<div class="p-4 mt-12">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            Daftar Penghasilan Orang Tua
        </h1>

        {{-- Buka Modal Tambah --}}
        <button type="button"
            onclick="openAddModal()"
            class="px-4 py-2 text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
            + Tambah Penghasilan
        </button>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded border border-green-200 bg-green-50 p-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-600 dark:text-gray-300">
            <thead class="text-s text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-6 py-3 w-16">No</th>
                    <th class="px-6 py-3">Range Penghasilan</th>
                    <th class="px-6 py-3 w-48">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penghasilan as $i => $p)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                        <td class="px-6 py-2 font-semibold text-gray-900 dark:text-white">{{ $i+1 }}</td>
                        <td class="px-6 py-2 font-semibold">{{ $p->penghasilan }}</td>
                        <td class="px-6 py-2">
                            <div class="flex items-center gap-3">
                                <button type="button"
                                    onclick="openEditModal({{ $p->id }}, @js($p->penghasilan))"
                                    class="text-white bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-3.5 py-2.5 mb-2">
                                    Edit
                                </button>

                                <form action="{{ route('admin.penghasilan.destroy', ['penghasilan' => $p->id]) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-2.5 py-2.5 text-center mb-2">
                                        Hapus
                                    </button>
                                </form>


                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-6 py-6 text-center text-gray-500 dark:text-gray-400" colspan="3">
                            Belum ada data.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ===== Modal Tambah ===== --}}
<div id="addModal"
     class="fixed inset-0 z-50 hidden bg-black/50"
     aria-hidden="true">
    <div class="absolute left-1/2 top-1/2 w-[22rem] -translate-x-1/2 -translate-y-1/2 rounded-lg bg-white p-6 shadow-xl dark:bg-gray-800">
        <div class="mb-4 flex items-start justify-between">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Tambah Penghasilan</h2>
            <button type="button" onclick="closeAddModal()" aria-label="Tutup"
                class="rounded p-1 text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700">
                ✕
            </button>
        </div>
        <form action="{{ route('admin.penghasilan.store') }}" method="POST">
            @csrf
            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Pendidikan</label>
            <input type="text" name="penghasilan" required
                   class="mb-4 w-full rounded border border-gray-300 p-2 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeAddModal()"
                        class="rounded bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                    Batal
                </button>
                <button type="submit"
                        class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ===== Modal Edit ===== --}}
<div id="editModal"
     class="fixed inset-0 z-50 hidden bg-black/50"
     aria-hidden="true">
    <div class="absolute left-1/2 top-1/2 w-[22rem] -translate-x-1/2 -translate-y-1/2 rounded-lg bg-white p-6 shadow-xl dark:bg-gray-800">
        <div class="mb-4 flex items-start justify-between">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Edit Penghasilan</h2>
            <button type="button" onclick="closeEditModal()" aria-label="Tutup"
                class="rounded p-1 text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700">
                ✕
            </button>
        </div>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Range Penghasilan</label>
            <input type="text" name="penghasilan" id="editPenghasilan" required
                   class="mb-4 w-full rounded border border-gray-300 p-2 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeEditModal()"
                        class="rounded bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                    Batal
                </button>
                <button type="submit"
                        class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const addModal  = document.getElementById('addModal');
    const editModal = document.getElementById('editModal');
    const editForm  = document.getElementById('editForm');
    const editInput = document.getElementById('editPenghasilan');

    const updateUrlTemplate = "{{ route('admin.penghasilan.update', ':id') }}";

    function openAddModal()  { addModal.classList.remove('hidden'); }
    function closeAddModal() { addModal.classList.add('hidden'); }

    function openEditModal(id, range_penghasilan) {
        editInput.value = range_penghasilan;
        editForm.action = updateUrlTemplate.replace(':id', id);
        editModal.classList.remove('hidden');
    }
    function closeEditModal() { editModal.classList.add('hidden'); }

    // Klik backdrop untuk menutup
    addModal?.addEventListener('click', (e) => { if (e.target === addModal) closeAddModal(); });
    editModal?.addEventListener('click', (e) => { if (e.target === editModal) closeEditModal(); });

    // ESC untuk menutup
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') { closeAddModal(); closeEditModal(); }
    });
</script>

@endsection
