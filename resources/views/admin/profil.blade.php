@extends('layouts.admin')

@section('title', 'Profil Saya')

@section('content')
<div class="p-4 sm:p-6 mt-12">
    {{-- [DIPERBARUI] Menambahkan tombol Kembali --}}
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Profil Saya
            </h1>
            <p class="text-sm text-gray-500 mt-1">Kelola informasi profil dan kata sandi Anda.</p>
        </div>
        
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

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
        <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- [DIPERBARUI] Kolom Foto Profil dengan AlpineJS untuk Pratinjau Instan --}}
                <div class="md:col-span-1 text-center" 
                     x-data="{ photoPreview: '{{ $user->foto ? Storage::url($user->foto) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name) }}' }">
                    <img :src="photoPreview" 
                         alt="Foto Profil" 
                         class="w-32 h-32 rounded-full mx-auto object-cover border-4 border-gray-200">
                    
                    <label for="foto" class="mt-4 inline-block cursor-pointer px-4 py-2 text-sm text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700">
                        Ganti Foto
                    </label>
                    <input type="file" name="foto" id="foto" class="hidden"
                           @change="photoPreview = URL.createObjectURL($event.target.files[0])">

                    <p class="text-xs text-gray-500 mt-2">JPG, PNG maks. 2MB</p>
                </div>

                {{-- Kolom Informasi Profil --}}
                <div class="md:col-span-2 space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div class="border-t pt-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ubah Kata Sandi</label>
                        <p class="text-xs text-gray-500 mb-2">Kosongkan jika tidak ingin mengubah kata sandi.</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="password" class="block text-sm font-medium">Kata Sandi Baru</label>
                                <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium">Konfirmasi Kata Sandi</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-5 border-t dark:border-gray-600 flex justify-end gap-3">
                <a href="{{ route('admin.dashboard') }}" class="px-6 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                    Kembali
                </a>
                <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Memastikan AlpineJS dimuat untuk fungsionalitas pratinjau --}}
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection

