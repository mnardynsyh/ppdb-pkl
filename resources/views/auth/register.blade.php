@extends('layouts.app')

@section('title', 'Registrasi Akun Siswa')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-100 py-12 px-4">
    <div class="w-full max-w-4xl bg-white rounded-xl shadow-lg p-8 border border-slate-200">
        
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-slate-900">Registrasi Akun Siswa</h2>
            <p class="mt-2 text-slate-600">Lengkapi data berikut untuk membuat akun.</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded">
                <p class="font-bold mb-1">Terjadi Kesalahan:</p>
                <ul class="text-sm list-disc pl-6">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.siswa.submit') }}" method="POST" class="space-y-8">
            @csrf

            {{-- DATA DIRI --}}
            <div class="space-y-6">
                <h3 class="text-lg font-semibold text-slate-700 border-b pb-2">Data Diri</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <x-input label="Nama Lengkap" name="nama_lengkap" placeholder="Sesuai Akta Kelahiran" required />
                    <x-input label="NIK" name="nik" placeholder="16 Digit" required />
                    <x-input label="NISN" name="nisn" placeholder="10 Digit" required />

                    <x-input label="Tempat Lahir" name="tempat_lahir" required />
                    <x-input type="date" label="Tanggal Lahir" name="tanggal_lahir" required />

                    <div>
                        <label class="block mb-2 text-sm font-medium text-slate-900">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select">
                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-slate-900">Agama</label>
                        <select name="agama" class="form-select">
                            <option value="">-- Pilih Agama --</option>
                            @foreach ($agamaOptions as $a)
                                <option value="{{ $a }}">{{ $a }}</option>
                            @endforeach
                        </select>
                    </div>

                    <x-input label="Asal Sekolah" name="asal_sekolah" placeholder="Contoh: SMP Negeri 1" class="md:col-span-2" required />
                </div>

                <x-textarea label="Alamat Lengkap" name="alamat" required />
            </div>

            {{-- INFORMASI AKUN --}}
            <div class="space-y-6">
                <h3 class="text-lg font-semibold text-slate-700 border-b pb-2">Informasi Akun</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input type="email" label="Email" name="email" required />
                    <x-input type="password" label="Password" name="password" required />
                    <x-input type="password" label="Konfirmasi Password" name="password_confirmation" required />
                </div>
            </div>

            <div class="flex justify-between items-center pt-6 border-t">
                <a href="{{ route('login') }}" class="text-sm font-medium text-blue-600 hover:underline">
                    Sudah punya akun? Login
                </a>
                <button class="btn-primary">
                    Daftar Akun
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
