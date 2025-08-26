@extends('layouts.app')

@section('title', 'Registrasi Siswa')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="w-full max-w-5xl bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold text-center mb-6">Registrasi Siswa</h2>

        {{-- Form Registrasi --}}
        <form action="{{ route('siswa.register.submit') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Grid 3 kolom --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Email --}}
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="nama@email.com" required>
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input type="password" name="password" id="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="********" required>
                </div>

                {{-- NIK --}}
                <div>
                    <label for="nik" class="block mb-2 text-sm font-medium text-gray-900">NIK</label>
                    <input type="text" name="nik" id="nik"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Nomor Induk Kependudukan" required>
                </div>

                {{-- NISN --}}
                <div>
                    <label for="nisn" class="block mb-2 text-sm font-medium text-gray-900">NISN</label>
                    <input type="text" name="nisn" id="nisn"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Nomor Induk Siswa Nasional" required>
                </div>

                {{-- Nama Lengkap --}}
                <div>
                    <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Nama lengkap sesuai identitas" required>
                </div>

                {{-- Tempat Lahir --}}
                <div>
                    <label for="tempat_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Tempat lahir" required>
                </div>

                {{-- Tanggal Lahir --}}
                <div>
                    <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                </div>

                {{-- Jenis Kelamin --}}
                <div>
                    <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                {{-- Alamat --}}
                <div class="md:col-span-3">
                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="3"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Alamat lengkap" required></textarea>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-between items-center mt-4">
                <a href="{{ route('home') }}"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Kembali
                </a>
                <button type="submit"
                    class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">
                    Daftar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
