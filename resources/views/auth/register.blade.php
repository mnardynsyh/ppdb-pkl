@extends('layouts.app')

@section('title', 'Registrasi Akun Siswa')

@section('content')
<section class="bg-gray-50 dark:bg-gray-900 py-20">
  <div class="max-w-full mx-auto px-6">

      <div class="bg-white rounded-xl shadow-lg dark:bg-gray-800 dark:border-gray-700 border border-gray-200 p-8">

          <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 text-center">
              Registrasi Akun Siswa
          </h1>

          @if ($errors->any())
              <div class="mb-6 p-4 bg-red-50 border border-red-300 text-red-800 rounded-lg text-sm">
                  <ul class="list-disc pl-5 space-y-1">
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif

          <form action="{{ route('register.siswa.submit') }}" method="POST" class="space-y-8">
    @csrf

    @php
    $input = "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
              focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 
              dark:bg-gray-700 dark:border-gray-600 dark:text-white";
    @endphp

    {{-- DATA DIRI --}}
    <div>
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Data Diri</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <div>
                <label class="text-sm font-medium text-gray-900 mb-1 block">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="{{ $input }}" required>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-900 mb-1 block">NIK</label>
                <input type="text" name="nik" value="{{ old('nik') }}" class="{{ $input }}" required>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-900 mb-1 block">NISN</label>
                <input type="text" name="nisn" value="{{ old('nisn') }}" class="{{ $input }}" required>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-900 mb-1 block">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="{{ $input }}" required>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-900 mb-1 block">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="{{ $input }}" required>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-900 mb-1 block">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="{{ $input }}" required>
                    <option value="">-- Pilih --</option>
                    <option value="L" @selected(old('jenis_kelamin')=='L')>Laki-Laki</option>
                    <option value="P" @selected(old('jenis_kelamin')=='P')>Perempuan</option>
                </select>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-900 mb-1 block">Agama</label>
                <select name="agama" class="{{ $input }}" required>
                    <option value="">-- Pilih Agama --</option>
                    @foreach ($agamaOptions as $option)
                        <option value="{{ $option }}" @selected(old('agama')==$option)>{{ $option }}</option>
                    @endforeach
                </select>
            </div>

            <div class="lg:col-span-3">
                <label class="text-sm font-medium text-gray-900 mb-1 block">Asal Sekolah</label>
                <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" class="{{ $input }}" required>
            </div>

            <div class="lg:col-span-3">
                <label class="text-sm font-medium text-gray-900 mb-1 block">Alamat Lengkap</label>
                <textarea name="alamat" rows="3" class="{{ $input }}" required>{{ old('alamat') }}</textarea>
            </div>

        </div>
    </div>

    {{-- INFORMASI AKUN --}}
    <div>
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Informasi Akun</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div>
                <label class="text-sm font-medium text-gray-900 mb-1 block">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="{{ $input }}" required>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-900 mb-1 block">Password</label>
                <input type="password" name="password" class="{{ $input }}" required>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-900 mb-1 block">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="{{ $input }}" required>
            </div>

        </div>
    </div>

    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-5 py-3 transition">
        Daftar Akun
    </button>

    <p class="text-sm text-center text-gray-600 mt-2">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login di sini</a>
    </p>

</form>

      </div>

  </div>
</section>
@endsection
