<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PPDB Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white">

    <section class="h-screen flex overflow-hidden">
        
        <div class="w-full lg:w-1/2 flex flex-col h-full bg-white relative z-10 overflow-y-auto">
            
            <div class="px-6 pt-8 pb-4 sm:px-10 sm:pt-10 w-full shrink-0">
                <a href="{{ route('home') }}" class="group inline-flex items-center text-base font-semibold text-gray-500 hover:text-gray-900 transition-colors py-2">
                    <svg class="w-5 h-5 mr-2.5 transition-transform duration-200 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>

            <div class="flex-1 flex flex-col justify-center px-6 sm:px-10 pb-10">
                <div class="w-full max-w-md mx-auto space-y-8">
                    
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-2 tracking-tight">Login</h1>
                        <p class="text-base text-gray-600">Selamat datang, silakan masuk ke akun Anda.</p>
                    </div>

                    <form class="space-y-5" action="{{ route('login.submit') }}" method="POST">
                        @csrf

                        {{-- ERROR MESSAGE --}}
                        @if ($errors->any())
                            <div 
                                x-data="{ show: true }" 
                                x-show="show" 
                                x-transition.opacity.duration.300ms 
                                class="w-full p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm font-semibold flex items-start gap-3 shadow-sm"
                            >
                                <i class="fa-solid fa-circle-exclamation mt-0.5"></i>
                                <div class="flex-1">
                                    <p class="font-bold mb-1">Login gagal!</p>
                                    <ul class="list-disc list-inside space-y-0.5 text-red-600">
                                        @foreach ($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <button @click="show = false" class="text-red-500 hover:text-red-700">
                                    <i class="fa-solid fa-xmark text-base"></i>
                                </button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div 
                                x-data="{ show: true }" 
                                x-show="show" 
                                x-transition.opacity.duration.300ms 
                                class="w-full p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm font-semibold flex items-start gap-3 shadow-sm"
                            >
                                <i class="fa-solid fa-circle-exclamation mt-0.5"></i>
                                <div class="flex-1">
                                    {{ session('error') }}
                                </div>
                                <button @click="show = false" class="text-red-500 hover:text-red-700">
                                    <i class="fa-solid fa-xmark text-base"></i>
                                </button>
                            </div>
                        @endif

                        {{-- EMAIL --}}
                        <div>
                            <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                required
                                class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-all outline-none placeholder-gray-400 bg-gray-50 focus:bg-white"
                                placeholder="nama@email.com"
                                value="{{ old('email') }}">
                        </div>

                        {{-- PASSWORD --}}
                        <div x-data="{ show: false }">
                            <div class="flex items-center justify-between mb-2">
                                <label for="password" class="block text-sm font-bold text-gray-700">Password</label>
                            </div>
                            <div class="relative">
                                <input
                                    :type="show ? 'text' : 'password'"
                                    id="password"
                                    name="password"
                                    required
                                    class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-all outline-none placeholder-gray-400 bg-gray-50 focus:bg-white pr-24"
                                    placeholder="Masukkan password">
                                <button 
                                    type="button" 
                                    @click="show = !show"
                                    class="absolute right-5 top-1/2 transform -translate-y-1/2 text-sm font-semibold text-gray-500 hover:text-gray-900 transition-colors">
                                    <span x-text="show ? 'Sembunyikan' : 'Lihat'"></span>
                                </button>
                            </div>
                        </div>

                        {{-- SUBMIT BUTTON --}}
                        <button
                            type="submit"
                            class="w-full bg-gray-900 text-white py-4 px-6 rounded-xl font-semibold text-lg hover:bg-black focus:ring-4 focus:ring-gray-200 transition-all transform active:scale-[0.99] shadow-lg">
                            Masuk
                        </button>
                    </form>


                    <div class="mt-4 text-center pt-4 border-t border-gray-600">
                        <p class="text-sm text-gray-600">
                            Calon siswa belum punya akun? 
                            <a href="{{ route('register.siswa') }}" class="font-bold text-blue-700 hover:text-blue-900 hover:underline transition-colors ml-1">
                                Daftar Siswa Baru
                            </a>
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <div class="hidden lg:flex lg:w-1/2 bg-gray-900 items-center justify-center p-12 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff33_1px,transparent_1px)] [background-size:20px_20px]"></div>
            
            <div class="max-w-lg text-center relative z-10">
                <div class="flex justify-center mb-10">
                     <img 
                        src="/img/login.png" 
                        alt="Logo Sistem" 
                        class="w-80 h-auto object-contain drop-shadow-2xl animate-fade-in-up"
                        onerror="this.style.display='none'">
                </div>

                <h2 class="text-3xl font-bold text-white mb-4 tracking-tight">
                    Sistem Informasi PPDB
                </h2>
                <p class="text-gray-400 text-lg leading-relaxed">
                    Platform terintegrasi untuk manajemen pendaftaran peserta didik baru dan administrasi sekolah yang efisien.
                </p>

            </div>
        </div>

    </section>

</body>
</html>