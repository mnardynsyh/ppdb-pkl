<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - PPDB Online</title>
    
    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Fonts & Icons --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-white h-screen w-full overflow-hidden flex text-neutral-800">

    <div class="hidden lg:flex w-1/2 relative bg-gradient-to-br from-primary-900 via-primary-800 to-primary-950 items-center justify-center overflow-hidden">
        
        {{-- Decorative Elements --}}
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-primary-400 opacity-10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-primary-500 opacity-10 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-primary-500/10 via-transparent to-transparent"></div>
        
        <div class="relative z-10 p-16 w-full h-full flex flex-col justify-between">
            {{-- Logo --}}
            <div class="flex items-center gap-2 text-white/90">
                <div class="w-8 h-8 border border-white/20 rounded flex items-center justify-center backdrop-blur-sm bg-white/5">
                     <i class="fa-solid fa-graduation-cap text-xs text-primary-50"></i>
                </div>
                <span class="font-medium tracking-widest text-xs uppercase text-primary-50">PPDB Online</span>
            </div>
            
            <div>
                <h2 class="text-5xl font-light text-white leading-[1.1] tracking-tight mb-6">
                    Masa Depan <br> <span class="font-semibold text-primary-100">Pendidikan</span> <br> Dimulai Di Sini.
                </h2>
                <p class="text-primary-100/80 font-light text-base max-w-md leading-relaxed">
                    Sistem pendaftaran peserta didik baru yang terintegrasi, transparan, dan efisien untuk kemajuan pendidikan.
                </p>
            </div>

            <div class="flex gap-6 text-[10px] font-bold text-primary-200/60 uppercase tracking-widest">
                <span>&copy; {{ date('Y') }} PPDB Online. All rights reserved.</span>
            </div>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center bg-white px-8 sm:px-12 lg:px-24 relative">
        
        <a href="{{ route('home') }}" class="absolute top-8 left-6 lg:top-8 lg:left-8 inline-flex items-center gap-2 px-4 py-2 text-xs font-bold text-neutral-500 bg-white border border-neutral-200 rounded-full hover:text-primary-700 hover:border-primary-200 hover:bg-primary-50 transition-all group z-20 shadow-sm">
            <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
            <span>Beranda</span>
        </a>

        <div class="w-full max-w-sm">
            
            <div class="lg:hidden flex justify-center mb-8">
                <div class="w-12 h-12 bg-primary-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary-200">
                     <i class="fa-solid fa-graduation-cap text-xl"></i>
                </div>
            </div>

            <div class="mb-10 text-center lg:text-left">
                <h1 class="text-2xl font-bold text-neutral-900 tracking-tight">Selamat Datang</h1>
                <p class="text-neutral-500 mt-2 text-sm">Masuk untuk mengakses akun Anda.</p>
            </div>

            {{-- FORM LOGIN --}}
            <form class="space-y-5" action="{{ route('login.submit') }}" method="POST">
                @csrf

                {{-- ERROR MESSAGE (Menggunakan warna Rose agar sesuai tema) --}}
                @if ($errors->any())
                    <div 
                        x-data="{ show: true }" 
                        x-show="show" 
                        x-transition.opacity.duration.300ms 
                        class="w-full p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-sm font-semibold flex items-start gap-3 shadow-sm"
                    >
                        <i class="fa-solid fa-circle-exclamation mt-0.5"></i>
                        <div class="flex-1">
                            <p class="font-bold mb-1">Login gagal!</p>
                            <ul class="list-disc list-inside space-y-0.5 text-rose-600">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" @click="show = false" class="text-rose-500 hover:text-rose-700">
                            <i class="fa-solid fa-xmark text-base"></i>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div 
                        x-data="{ show: true }" 
                        x-show="show" 
                        x-transition.opacity.duration.300ms 
                        class="w-full p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-sm font-semibold flex items-start gap-3 shadow-sm"
                    >
                        <i class="fa-solid fa-circle-exclamation mt-0.5"></i>
                        <div class="flex-1">
                            {{ session('error') }}
                        </div>
                        <button type="button" @click="show = false" class="text-rose-500 hover:text-rose-700">
                            <i class="fa-solid fa-xmark text-base"></i>
                        </button>
                    </div>
                @endif

                {{-- EMAIL --}}
                <div>
                    <label for="email" class="block text-sm font-bold text-neutral-700 mb-2">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        required
                        class="w-full px-5 py-4 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-all outline-none placeholder-neutral-400 bg-neutral-50 focus:bg-white"
                        placeholder="nama@email.com"
                        value="{{ old('email') }}">
                </div>

                {{-- PASSWORD --}}
                <div x-data="{ show: false }">
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-bold text-neutral-700">Password</label>
                    </div>
                    <div class="relative">
                        <input
                            :type="show ? 'text' : 'password'"
                            id="password"
                            name="password"
                            required
                            class="w-full px-5 py-4 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-all outline-none placeholder-neutral-400 bg-neutral-50 focus:bg-white pr-24"
                            placeholder="Masukkan password">
                        <button 
                            type="button" 
                            @click="show = !show"
                            class="absolute right-5 top-1/2 transform -translate-y-1/2 text-xs font-bold text-neutral-500 hover:text-neutral-900 transition-colors uppercase tracking-wider">
                            <span x-text="show ? 'Sembunyikan' : 'Lihat'"></span>
                        </button>
                    </div>
                </div>

                {{-- SUBMIT BUTTON --}}
                <button
                    type="submit"
                    class="w-full bg-primary-600 text-white py-4 px-6 rounded-xl font-semibold text-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 transition-all transform active:scale-[0.99] shadow-lg shadow-primary-200">
                    Masuk
                </button>
            </form>

            <div class="mt-8 text-center border-t border-neutral-200 pt-6">
                <p class="text-sm text-neutral-500">
                    Calon siswa belum punya akun? 
                    <a href="{{ route('register.siswa') }}" class="font-bold text-primary-700 hover:text-primary-900 hover:underline transition-colors ml-1">
                        Daftar Siswa Baru
                    </a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>