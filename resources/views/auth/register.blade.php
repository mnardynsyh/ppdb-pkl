<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - PPDB Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-white">
    <section class="min-h-screen flex">
        <!-- Left Container - Hidden on mobile -->
        <div class="hidden lg:flex lg:w-1/2 bg-gray-900 items-center justify-center p-12">
            <div class="max-w-md text-center">
                <!-- Logo dari public/img -->
                <div>
                    <div class="flex justify-center">
                        <img 
                            src="/img/register.png" 
                            alt="Logo PPDB Online" 
                            class="w-80 h-80 object-contain"
                            onerror="this.style.display='none'">
                    </div>
                </div>

                <!-- Copywriter -->
                <div class="mb-8">
                    <p class="text-gray-300 leading-relaxed text-lg">
                        Sistem penerimaan peserta didik baru yang modern, 
                        aman, dan terpercaya untuk masa depan pendidikan yang lebih baik.
                    </p>
                </div>
            </div>
        </div>

        <!-- Right Container - Form -->
        @if ($errors->any())
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <!-- Header -->
                <div class="mb-10">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Daftar Akun</h1>
                    <p class="text-gray-600">Registrasi siswa baru PPDB Online SMP</p>
                    
                    <!-- Info untuk siswa -->
                    <div class="mt-4 p-3 bg-blue-50 rounded-lg border border-blue-200">
                        <p class="text-sm text-blue-700 flex items-center">
                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Pastikan data yang Anda masukkan sudah benar sebelum mendaftar.
                        </p>
                    </div>
                </div>

                <!-- Form -->
                <form class="space-y-6" action="{{ route('register.siswa.submit') }}" method="POST">
                    @csrf
                    
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-3">
                            Nama Lengkap
                        </label>
                        <input
                            id="nama_lengkap"
                            name="nama_lengkap"
                            type="text"
                            required
                            class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-colors placeholder-gray-500 bg-white"
                            placeholder="Masukkan nama lengkap"
                            value="{{ old('nama_lengkap') }}">
                    </div>

                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-700 mb-3">
                            NIK (Nomor Induk Kependudukan)
                        </label>
                        <input
                            id="nik"
                            name="nik"
                            type="text"
                            required
                            maxlength="16"
                            class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-colors placeholder-gray-500 bg-white"
                            placeholder="Masukkan 16 digit NIK"
                            value="{{ old('nik') }}">
                    </div>

                    <!-- NISN -->
                    <div>
                        <label for="nisn" class="block text-sm font-medium text-gray-700 mb-3">
                            NISN
                        </label>
                        <input
                            id="nisn"
                            name="nisn"
                            type="text"
                            required
                            maxlength="10"
                            class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-colors placeholder-gray-500 bg-white"
                            placeholder="Masukkan 10 digit NISN"
                            value="{{ old('nisn') }}">
                    </div>

                    <!-- Tanggal Lahir & Jenis Kelamin -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-3">
                                Tanggal Lahir
                            </label>
                            <input
                                id="tanggal_lahir"
                                name="tanggal_lahir"
                                type="date"
                                required
                                class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-colors bg-white"
                                value="{{ old('tanggal_lahir') }}">
                        </div>
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-3">
                                Jenis Kelamin
                            </label>
                            <select
                                id="jenis_kelamin"
                                name="jenis_kelamin"
                                required
                                class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-colors bg-white">
                                <option value="">Pilih</option>
                                <option value="L" @selected(old('jenis_kelamin')=='L')>Laki-Laki</option>
                                <option value="P" @selected(old('jenis_kelamin')=='P')>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-3">
                            Email
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            required
                            class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-colors placeholder-gray-500 bg-white"
                            placeholder="Masukkan email Anda"
                            value="{{ old('email') }}">
                    </div>

                    <!-- Password -->
                    <div x-data="{ show: false }">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-3">
                            Password
                        </label>
                        <div class="relative">
                            <input
                                :type="show ? 'text' : 'password'"
                                id="password"
                                name="password"
                                required
                                class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-colors placeholder-gray-500 bg-white pr-24"
                                placeholder="Masukkan password Anda">
                            <button 
                                type="button" 
                                @click="show = !show"
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-sm text-gray-500 hover:text-gray-700 font-medium transition-colors">
                                <span x-text="show ? 'Sembunyikan' : 'Tampilkan'"></span>
                            </button>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div x-data="{ show: false }">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-3">
                            Konfirmasi Password
                        </label>
                        <div class="relative">
                            <input
                                :type="show ? 'text' : 'password'"
                                id="password_confirmation"
                                name="password_confirmation"
                                required
                                class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-colors placeholder-gray-500 bg-white pr-24"
                                placeholder="Ulangi password Anda">
                            <button 
                                type="button" 
                                @click="show = !show"
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-sm text-gray-500 hover:text-gray-700 font-medium transition-colors">
                                <span x-text="show ? 'Sembunyikan' : 'Tampilkan'"></span>
                            </button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full bg-gray-900 text-white py-3.5 px-4 rounded-xl font-semibold hover:bg-gray-800 focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 transition-colors">
                        Daftar Akun
                    </button>
                </form>

                <!-- Login Link -->
                <div class="text-center mt-4 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-500">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 font-medium underline">
                            Login di sini
                        </a>
                    </p>
                </div>

                <!-- Back Link -->
                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-gray-700 transition-colors inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke beranda
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
    const nisn = document.getElementById('nisn');
    const nik = document.getElementById('nik'); // TAMBAHKAN INI
    
    // Validasi NISN hanya angka
    nisn.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
    });
    
    // Validasi NIK hanya angka
    nik.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
    });
});
    </script>
</body>
</html>