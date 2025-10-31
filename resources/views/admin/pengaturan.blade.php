@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('content')
{{-- [DIUBAH] x-data disederhanakan, hanya untuk mode 'editing' --}}
<div x-data="{ editing: {{ $errors->any() ? 'true' : 'false' }} }" class="p-4 sm:p-6 mt-12">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
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

    {{-- [DIHAPUS] Navigasi Tab telah dihapus --}}

    {{-- Konten Pengaturan Umum --}}
    <div>
        
        {{-- [BARU] Mode Tampilan (Read-Only) --}}
        <div x-show="!editing" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <div class="flex justify-end mb-4">
                <button type="button" @click="editing = true" class="px-4 py-2 text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L14.732 3.732z"></path></svg>
                    <span>Ubah Pengaturan</span>
                </button>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-3 mb-4">Pengaturan Pendaftaran</h3>
                    <dl class="space-y-4 text-sm">
                        <div class="flex"><dt class="w-1/3 font-medium text-gray-500">Status</dt><dd class="w-2/3"><span @class(['px-2.5 py-1 text-xs font-semibold rounded-full', 'bg-green-100 text-green-800' => $pengaturan->status == 'Dibuka', 'bg-red-100 text-red-800' => $pengaturan->status == 'Ditutup'])>{{ $pengaturan->status }}</span></dd></div>
                        <div class="flex"><dt class="w-1/3 font-medium text-gray-500">Tanggal Buka</dt><dd class="w-2/3 text-gray-900">{{ $pengaturan->tanggal_buka?->isoFormat('D MMMM YYYY') }}</dd></div>
                        <div class="flex"><dt class="w-1/3 font-medium text-gray-500">Tanggal Tutup</dt><dd class="w-2/3 text-gray-900">{{ $pengaturan->tanggal_tutup?->isoFormat('D MMMM YYYY') }}</dd></div>
                    </dl>
                </div>
                <div class="lg:col-span-1 bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-3 mb-4">Informasi Kontak</h3>
                     <dl class="space-y-4 text-sm">
                        <div class="flex flex-col"><dt class="font-medium text-gray-500">Alamat</dt><dd class="mt-1 text-gray-900">{{ $pengaturan->alamat_sekolah }}</dd></div>
                        <div class="flex"><dt class="w-1/3 font-medium text-gray-500">Telepon</dt><dd class="w-2/3 text-gray-900">{{ $pengaturan->telepon }}</dd></div>
                        <div class="flex"><dt class="w-1/3 font-medium text-gray-500">Email</dt><dd class="w-2/3 text-gray-900">{{ $pengaturan->email_kontak }}</dd></div>
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
                    <div class="lg:col-span-2 bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-3 mb-4">Ubah Pengaturan Pendaftaran</h3>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status Pendaftaran</label>
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
                    <div class="lg:col-span-1 bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-3 mb-4">Ubah Informasi Kontak</h3>
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
                <div class="mt-8 pt-5 border-t border-gray-200 flex justify-end gap-3">
                    <button type="button" @click="editing = false" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">Batal</button>
                    <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 transition">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- [DIHAPUS] Konten Tab, Modal, dan Script untuk Manajemen Jadwal telah dihapus --}}

</div>
@endsection
