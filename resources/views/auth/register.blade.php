<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - PPDB Online</title>
    
    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Fonts & Icons --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    {{-- Alpine.js & SweetAlert --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
        
        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 20px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: #94a3b8; }
    </style>
</head>
<body class="bg-white h-screen w-full overflow-hidden flex text-neutral-800">

    <div class="hidden lg:flex w-1/2 relative bg-gradient-to-br from-primary-900 via-primary-800 to-primary-950 items-center justify-center overflow-hidden order-2 lg:order-1">
        
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
                    Bergabung <br> <span class="font-semibold text-primary-100">Bersama Kami</span> <br> Wujudkan Mimpi.
                </h2>
                <p class="text-primary-100/80 font-light text-base max-w-md leading-relaxed">
                    Daftarkan diri Anda sekarang untuk menjadi bagian dari komunitas pendidikan yang unggul dan berprestasi.
                </p>
            </div>

            <div class="flex gap-6 text-[10px] font-bold text-primary-200/60 uppercase tracking-widest">
                <span>&copy; {{ date('Y') }} PPDB Online. All rights reserved.</span>
            </div>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex flex-col items-center bg-white relative order-1 lg:order-2 h-full">
        
        <div class="w-full px-8 sm:px-12 lg:px-24 pt-8 shrink-0">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold text-neutral-500 bg-white border border-neutral-200 rounded-full hover:text-primary-700 hover:border-primary-200 hover:bg-primary-50 transition-all group z-20 shadow-sm">
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                <span>Beranda</span>
            </a>
        </div>

        <div class="w-full flex-1 overflow-y-auto custom-scrollbar px-8 sm:px-12 lg:px-24 py-8">
            <div class="w-full max-w-md mx-auto pb-8">
                
                <div class="lg:hidden flex justify-center mb-8">
                    <div class="w-12 h-12 bg-primary-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary-200">
                         <i class="fa-solid fa-graduation-cap text-xl"></i>
                    </div>
                </div>

                <div class="mb-8 text-center lg:text-left">
                    <h1 class="text-2xl font-bold text-neutral-900 tracking-tight">Buat Akun Siswa</h1>
                    <p class="text-neutral-500 mt-2 text-sm">Lengkapi data diri Anda dengan benar.</p>
                </div>

                <div class="p-4 bg-primary-50 rounded-xl border border-primary-100 flex items-start gap-3 mb-8">
                    <i class="fa-solid fa-circle-info text-primary-600 mt-0.5"></i>
                    <p class="text-sm text-primary-800 leading-relaxed">
                        Pastikan <strong>NIK</strong> dan <strong>NISN</strong> sesuai dengan Kartu Keluarga (KK) atau Ijazah sekolah asal.
                    </p>
                </div>

                {{-- FORM REGISTER --}}
                <form class="space-y-5" action="{{ route('register.siswa.submit') }}" method="POST">
                    @csrf

                    {{-- NAMA LENGKAP --}}
                    <div>
                        <label for="nama_lengkap" class="block text-xs font-bold text-neutral-900 uppercase tracking-wider mb-2">Nama Lengkap</label>
                        <input id="nama_lengkap" name="nama_lengkap" type="text" required
                            class="w-full px-5 py-3.5 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-all outline-none placeholder-neutral-400 bg-neutral-50 focus:bg-white text-sm font-medium"
                            placeholder="Sesuai Ijazah" value="{{ old('nama_lengkap') }}">
                        @error('nama_lengkap')
                            <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- GRID: NIK & NISN --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="nik" class="block text-xs font-bold text-neutral-900 uppercase tracking-wider mb-2">NIK</label>
                            <input id="nik" name="nik" type="text" required maxlength="16"
                                class="w-full px-5 py-3.5 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-all outline-none placeholder-neutral-400 bg-neutral-50 focus:bg-white text-sm font-medium"
                                placeholder="16 Digit Angka" value="{{ old('nik') }}">
                            @error('nik')
                                <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="nisn" class="block text-xs font-bold text-neutral-900 uppercase tracking-wider mb-2">NISN</label>
                            <input id="nisn" name="nisn" type="text" required maxlength="10"
                                class="w-full px-5 py-3.5 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-all outline-none placeholder-neutral-400 bg-neutral-50 focus:bg-white text-sm font-medium"
                                placeholder="10 Digit Angka" value="{{ old('nisn') }}">
                            @error('nisn')
                                <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- GRID: TGL LAHIR & GENDER --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="tanggal_lahir" class="block text-xs font-bold text-neutral-900 uppercase tracking-wider mb-2">Tanggal Lahir</label>
                            <input id="tanggal_lahir" name="tanggal_lahir" type="date" required
                                class="w-full px-5 py-3.5 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-all outline-none bg-neutral-50 focus:bg-white text-sm font-medium text-neutral-600"
                                value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir')
                                <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="jenis_kelamin" class="block text-xs font-bold text-neutral-900 uppercase tracking-wider mb-2">Jenis Kelamin</label>
                            <div class="relative">
                                <select id="jenis_kelamin" name="jenis_kelamin" required
                                    class="w-full px-5 py-3.5 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-all outline-none bg-neutral-50 focus:bg-white appearance-none cursor-pointer text-sm font-medium text-neutral-600">
                                    <option value="">Pilih Gender</option>
                                    <option value="L" @selected(old('jenis_kelamin')=='L')>Laki-Laki</option>
                                    <option value="P" @selected(old('jenis_kelamin')=='P')>Perempuan</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                    <i class="fa-solid fa-chevron-down text-xs text-neutral-500"></i>
                                </div>
                            </div>
                            @error('jenis_kelamin')
                                <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- EMAIL --}}
                    <div>
                        <label for="email" class="block text-xs font-bold text-neutral-900 uppercase tracking-wider mb-2">Email Aktif</label>
                        <input id="email" name="email" type="email" required
                            class="w-full px-5 py-3.5 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-all outline-none placeholder-neutral-400 bg-neutral-50 focus:bg-white text-sm font-medium"
                            placeholder="nama@email.com"
                            value="{{ old('email') }}">
                        @error('email')
                            <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- PASSWORD --}}
                    <div x-data="{ show: false }">
                        <label for="password" class="block text-xs font-bold text-neutral-900 uppercase tracking-wider mb-2">Password</label>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" id="password" name="password" required
                                class="w-full px-5 py-3.5 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-all outline-none placeholder-neutral-400 bg-neutral-50 focus:bg-white pr-24 text-sm font-medium"
                                placeholder="Minimal 6 karakter">
                            <button type="button" @click="show = !show"
                                class="absolute right-5 top-1/2 transform -translate-y-1/2 text-xs font-bold text-neutral-500 hover:text-neutral-900 transition-colors uppercase tracking-wider">
                                <span x-text="show ? 'Sembunyikan' : 'Lihat'"></span>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- KONFIRMASI PASSWORD --}}
                    <div x-data="{ show: false }">
                        <label for="password_confirmation" class="block text-xs font-bold text-neutral-900 uppercase tracking-wider mb-2">Ulangi Password</label>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" id="password_confirmation" name="password_confirmation" required
                                class="w-full px-5 py-3.5 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-all outline-none placeholder-neutral-400 bg-neutral-50 focus:bg-white pr-24 text-sm font-medium"
                                placeholder="Ketik ulang password">
                            <button type="button" @click="show = !show"
                                class="absolute right-5 top-1/2 transform -translate-y-1/2 text-xs font-bold text-neutral-500 hover:text-neutral-900 transition-colors uppercase tracking-wider">
                                <span x-text="show ? 'Sembunyikan' : 'Lihat'"></span>
                            </button>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-primary-600 hover:bg-primary-700 text-white py-4 px-6 rounded-xl font-bold text-sm uppercase tracking-widest transition-all shadow-lg shadow-primary-200 hover:shadow-xl hover:shadow-primary-200 transform hover:-translate-y-0.5 active:translate-y-0 mt-6">
                        Daftar Sekarang
                    </button>
                </form>

                <div class="mt-8 text-center border-t border-neutral-200 pt-6">
                    <p class="text-sm text-neutral-500">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="font-bold text-primary-700 hover:text-primary-900 hover:underline transition-all ml-1">
                            Login di sini
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk Alert Sukses (Styled Button) --}}
    @if (session('register_success'))
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Registrasi Berhasil!',
            text: 'Akun Anda telah dibuat. Silakan login untuk melanjutkan.',
            icon: 'success',
            iconColor: '#0d9488',
            confirmButtonText: 'Login Sekarang',
            buttonsStyling: false,
            customClass: {
                popup: 'rounded-3xl shadow-2xl border border-neutral-100 font-sans p-8',
                confirmButton: 'bg-primary-600 hover:bg-primary-700 text-white px-8 py-3.5 rounded-xl font-bold text-sm shadow-lg shadow-primary-500/30 transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-primary-100',
                title: 'text-2xl font-bold text-neutral-900 mb-2',
                htmlContainer: 'text-neutral-500 text-sm leading-relaxed mb-6'
            },
            allowOutsideClick: false,
            allowEscapeKey: false
        }).then(() => {
            window.location.href = "{{ route('login') }}";
        });
    });
    </script>
    @endif

    {{-- Script Input Hanya Angka --}}
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const enforceNumber = (e) => {
            e.target.value = e.target.value.replace(/\D/g, '');
        };
        const inputs = ['nisn', 'nik'];
        inputs.forEach(id => {
            const el = document.getElementById(id);
            if(el) el.addEventListener('input', enforceNumber);
        });
    });
    </script>

</body>
</html>