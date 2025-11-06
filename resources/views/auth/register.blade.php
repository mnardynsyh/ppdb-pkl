@extends('layouts.app')

@section('title', 'Registrasi Akun Siswa')

@section('content')
<div class="min-h-screen bg-[#f8fafc] dark:bg-gray-900 py-16">
    <div class="max-w-6xl mx-auto px-6">

        {{-- Heading --}}
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-slate-800 dark:text-white">Registrasi Akun Siswa Baru</h1>
            <p class="text-slate-600 dark:text-slate-300 mt-2">Silakan isi data berikut dengan benar.</p>
        </div>

        {{-- Error Alert --}}
        @if ($errors->any())
            <div class="mb-10 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg text-sm">
                <ul class="space-y-1 list-disc pl-5">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.siswa.submit') }}" method="POST" class="space-y-14">
            @csrf

            @php
            $input = "bg-white border border-slate-300 text-slate-900 text-sm rounded-lg shadow-sm 
                      focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5";
            @endphp


            {{-- ================= DATA DIRI ================= --}}
            <div class="space-y-6">
                <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200 border-l-4 border-blue-600 pl-3">
                    Data Diri
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                        <input type="text" class="{{ $input }}" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">NIK</label>
                        <input type="text" id="nik" class="{{ $input }}" maxlength="16" name="nik" value="{{ old('nik') }}" required>
                        <p id="nikError" class="hidden text-xs text-red-600 mt-1">NIK harus 16 digit angka</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">NISN</label>
                        <input type="text" id="nisn" class="{{ $input }}" maxlength="10" name="nisn" value="{{ old('nisn') }}" required>
                        <p id="nisnError" class="hidden text-xs text-red-600 mt-1">NISN harus 10 digit angka</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tempat Lahir</label>
                        <input type="text" class="{{ $input }}" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Lahir</label>
                        <input type="date" class="{{ $input }}" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="{{ $input }}" required>
                            <option value="">-- Pilih --</option>
                            <option value="L" @selected(old('jenis_kelamin')=='L')>Laki-Laki</option>
                            <option value="P" @selected(old('jenis_kelamin')=='P')>Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Agama</label>
                        <select name="agama" class="{{ $input }}" required>
                            <option value="">-- Pilih Agama --</option>
                            @foreach ($agamaOptions as $option)
                                <option value="{{ $option }}" @selected(old('agama')==$option)>{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="lg:col-span-3">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Asal Sekolah</label>
                        <input type="text" class="{{ $input }}" name="asal_sekolah" value="{{ old('asal_sekolah') }}" required>
                    </div>

                    <div class="lg:col-span-3">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Alamat Lengkap</label>
                        <textarea class="{{ $input }}" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                    </div>

                </div>
            </div>


            {{-- ================= INFORMASI AKUN ================= --}}
            <div class="space-y-6">
                <h3 class="text-lg font-semibold text-slate-800 border-l-4 border-indigo-500 pl-3">
                    Informasi Akun
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                        <input type="email" class="{{ $input }}" name="email" value="{{ old('email') }}" required>
                    </div>

                    {{-- PASSWORD --}}
                    <div x-data="{show:false}" class="relative">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                        <input :type="show ? 'text' : 'password'" class="{{ $input }} pr-10" name="password" required>
                        <button type="button" @click="show=!show" class="absolute right-3 top-9 text-slate-600 hover:text-blue-600">
                            <!-- Heroicon Eye -->
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-.91 3.05-3.3 5.567-6.233 6.566"/>
                            </svg>
                            <!-- Heroicon Eye Off -->
                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.968 9.968 0 011.62-3.023M9.88 9.88a3 3 0 104.24 4.24"/>
                            </svg>
                        </button>
                    </div>

                    {{-- CONFIRM PASSWORD --}}
                    <div x-data="{show:false}" class="relative">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Password</label>
                        <input :type="show ? 'text' : 'password'" class="{{ $input }} pr-10" name="password_confirmation" required>
                        <button type="button" @click="show=!show" class="absolute right-3 top-9 text-slate-600 hover:text-blue-600">
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M13.875 18.825A10.05 10.05 0 0112 19"/>
                            </svg>
                        </button>
                    </div>

                </div>
            </div>

            <button type="submit"
                class="w-full py-3 text-white font-semibold rounded-lg bg-blue-600 hover:bg-blue-700 transition shadow-md">
                Daftar Akun
            </button>

            <p class="text-center text-sm text-slate-700 mt-2">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login di sini</a>
            </p>

        </form>

    </div>
</div>


<script>
nik.addEventListener('input', () => {
    nik.value = nik.value.replace(/\D/g,'');
    nikError.classList.toggle('hidden', nik.value.length === 16);
});
nisn.addEventListener('input', () => {
    nisn.value = nisn.value.replace(/\D/g,'');
    nisnError.classList.toggle('hidden', nisn.value.length === 10);
});
</script>
@endsection
