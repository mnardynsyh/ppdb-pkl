<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        <!-- Left Container - Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <!-- Header -->
                <div class="mb-10">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Masuk</h1>
                    <p class="text-gray-600">Akses sistem PPDB Online SMP</p>
                    
                </div>

                <!-- Form -->
                <form class="space-y-6" action="{{ route('login.submit') }}" method="POST">
                    @csrf
                    
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

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input
                            id="remember"
                            name="remember"
                            type="checkbox"
                            class="w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900">
                        <label for="remember" class="ml-3 text-sm text-gray-700">
                            Ingat saya
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full bg-gray-900 text-white py-3.5 px-4 rounded-xl font-semibold hover:bg-gray-800 focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 transition-colors">
                        Masuk ke Akun
                    </button>
                </form>


                <!-- Back Link -->
                <div class="text-center mt-8 pt-8 border-t border-gray-200">
                    <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-gray-700 transition-colors inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke beranda
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Container - Hidden on mobile -->
        <div class="hidden lg:flex lg:w-1/2 bg-gray-900 items-center justify-center p-12">
            <div class="max-w-md text-center">
                <!-- Logo dari public/img -->
                <div>
                    <div class="flex justify-center">
                        <img 
                            src="/img/login.png" 
                            alt="Logo PPDB Online" 
                            class="w-60 h-60 object-contain"
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
    </section>
</body>
</html>