@extends('layouts.app')

@section('title', 'Registrasi Siswa')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4">
    <div class="w-full max-w-5xl bg-white rounded-lg shadow-xl p-8">
        <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">Formulir Pendaftaran Siswa Baru</h2>

        <form action="{{ route('siswa.register.submit') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                {{-- Nama Lengkap --}}
                <div>
                    <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Sesuai Akta Kelahiran" required>
                    @error('nama_lengkap') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- NIK --}}
                <div>
                    <label for="nik" class="block mb-2 text-sm font-medium text-gray-900">NIK</label>
                    <input type="text" name="nik" id="nik" value="{{ old('nik') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="16 Digit Angka" required>
                    @error('nik') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- NISN --}}
                <div>
                    <label for="nisn" class="block mb-2 text-sm font-medium text-gray-900">NISN</label>
                    <input type="text" name="nisn" id="nisn" value="{{ old('nisn') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="10 Digit Angka" required>
                    @error('nisn') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Tempat & Tanggal Lahir --}}
                <div>
                    <label for="tempat_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Kota Kelahiran" required>
                    @error('tempat_lahir') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                    @error('tanggal_lahir') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Jenis Kelamin --}}
                <div>
                    <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        <option value="" disabled selected>-- Pilih --</option>
                        <option value="L" @if(old('jenis_kelamin') == 'L') selected @endif>Laki-Laki</option>
                        <option value="P" @if(old('jenis_kelamin') == 'P') selected @endif>Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Agama --}}
                <div>
                    <label for="agama_id" class="block mb-2 text-sm font-medium text-gray-900">Agama</label>
                    <select name="agama_id" id="agama_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        <option value="" disabled selected>-- Pilih Agama --</option>
                        @foreach ($agama as $item) 
                            <option value="{{ $item->id }}" @if(old('agama_id') == $item->id) selected @endif>{{ $item->agama }}</option>
                        @endforeach
                    </select>
                    @error('agama_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Asal Sekolah --}}
                <div class="md:col-span-2">
                    <label for="asal_sekolah" class="block mb-2 text-sm font-medium text-gray-900">Asal Sekolah</label>
                    <input type="text" name="asal_sekolah" id="asal_sekolah" value="{{ old('asal_sekolah') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Contoh: SMP Negeri 1 Jakarta" required>
                    @error('asal_sekolah') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                
                {{-- Alamat --}}
                <div class="md:col-span-3">
                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat Lengkap</label>
                    <textarea name="alamat" id="alamat" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Sesuai Kartu Keluarga" required>{{ old('alamat') }}</textarea>
                    @error('alamat') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="nama@email.com" required>
                    @error('email') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input type="password" name="password" id="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Minimal 6 karakter" required>
                    @error('password') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Ulangi password" required>
                </div>
            </div>

            <div class="flex justify-between items-center pt-6">
                <a href="{{ route('home') }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-gray-300">
                    Kembali
                </a>
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300">
                    Daftar Sekarang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
