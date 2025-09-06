@extends('layouts.admin')

@section('title', 'Pengaturan Pendaftaran')

@section('content')
<div class="p-4 sm:p-6 mt-12">
    {{-- Header Halaman --}}
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            Pengaturan Pendaftaran
        </h1>
        {{-- Tombol Buka Modal Edit --}}
        <button type="button"
                onclick="openModal()"
                class="mt-4 sm:mt-0 px-4 py-2 text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L14.732 3.732z"></path></svg>
            Ubah Pengaturan
        </button>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif
    
    @if ($errors->any())
        <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-3 text-red-700">
            <strong>Terjadi kesalahan:</strong>
            <ul class="list-disc list-inside mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Card Tampilan Pengaturan Saat Ini --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white border-b dark:border-gray-600 pb-3 mb-4">Pengaturan Saat Ini</h3>
        <dl class="space-y-4 text-sm">
            <div class="flex flex-col sm:flex-row">
                <dt class="w-full sm:w-1/3 font-medium text-gray-500">Status Pendaftaran</dt>
                <dd class="w-full sm:w-2/3 mt-1 sm:mt-0">
                    <span @class([
                        'px-2.5 py-1 text-xs font-semibold rounded-full',
                        'bg-green-100 text-green-800' => $pengaturan->status == 'Dibuka',
                        'bg-red-100 text-red-800' => $pengaturan->status == 'Ditutup',
                    ])>
                        {{ $pengaturan->status }}
                    </span>
                </dd>
            </div>
            <div class="flex flex-col sm:flex-row">
                <dt class="w-full sm:w-1/3 font-medium text-gray-500">Tanggal Buka Pendaftaran</dt>
                <dd class="w-full sm:w-2/3 mt-1 sm:mt-0 text-gray-900 dark:text-gray-200">{{ \Carbon\Carbon::parse($pengaturan->tanggal_buka)->isoFormat('D MMMM YYYY') }}</dd>
            </div>
            <div class="flex flex-col sm:flex-row">
                <dt class="w-full sm:w-1/3 font-medium text-gray-500">Tanggal Tutup Pendaftaran</dt>
                <dd class="w-full sm:w-2/3 mt-1 sm:mt-0 text-gray-900 dark:text-gray-200">{{ \Carbon\Carbon::parse($pengaturan->tanggal_tutup)->isoFormat('D MMMM YYYY') }}</dd>
            </div>
        </dl>
    </div>
</div>

{{-- ===== Modal Edit Pengaturan ===== --}}
<div id="editModal" class="fixed inset-0 z-50 hidden bg-black/50" aria-hidden="true">
    <div class="absolute left-1/2 top-1/2 w-11/12 max-w-lg -translate-x-1/2 -translate-y-1/2 rounded-lg bg-white p-6 shadow-xl dark:bg-gray-800">
        <div class="mb-4 flex items-start justify-between">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Ubah Pengaturan Pendaftaran</h2>
            <button type="button" onclick="closeModal()" class="rounded p-1 text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700">✕</button>
        </div>
        <form action="{{ route('admin.pengaturan.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                {{-- Status Pendaftaran --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status Pendaftaran (Saklar Utama)</label>
                    <div class="flex items-center gap-6">
                        <div class="flex items-center">
                            <input type="radio" id="status_dibuka" name="status" value="Dibuka" 
                                   @checked(old('status', $pengaturan->status) == 'Dibuka')
                                   class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                            <label for="status_dibuka" class="ml-2 block text-sm text-gray-900 dark:text-gray-200">Dibuka</label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" id="status_ditutup" name="status" value="Ditutup" 
                                   @checked(old('status', $pengaturan->status) == 'Ditutup')
                                   class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                            <label for="status_ditutup" class="ml-2 block text-sm text-gray-900 dark:text-gray-200">Ditutup</label>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Jika 'Ditutup', pendaftaran tidak akan bisa diakses terlepas dari jadwal.</p>
                </div>
                
                {{-- Jadwal Pendaftaran --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="tanggal_buka" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Buka</label>
                        <input type="date" name="tanggal_buka" id="tanggal_buka"
                               value="{{ old('tanggal_buka', $pengaturan->tanggal_buka) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>
                    <div>
                        <label for="tanggal_tutup" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Tutup</label>
                        <input type="date" name="tanggal_tutup" id="tanggal_tutup"
                               value="{{ old('tanggal_tutup', $pengaturan->tanggal_tutup) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>
                </div>
            </div>

            {{-- Tombol Simpan --}}
            <div class="mt-8 pt-5 border-t dark:border-gray-600 flex justify-end gap-2">
                <button type="button" onclick="closeModal()" class="rounded bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 transition duration-300">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script untuk Modal --}}
<script>
    const editModal = document.getElementById('editModal');

    function openModal() {
        editModal.classList.remove('hidden');
    }

    function closeModal() {
        editModal.classList.add('hidden');
    }

    // Fungsionalitas untuk menutup modal saat klik di luar area modal atau menekan tombol ESC
    window.addEventListener('click', (e) => {
        if (e.target === editModal) closeModal();
    });
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeModal();
        }
    });

    // Jika ada error validasi, tetap buka modal saat halaman refresh
    @if ($errors->any())
        openModal();
    @endif
</script>
@endsection

