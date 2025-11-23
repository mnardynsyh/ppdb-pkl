<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Siswa - PPDB Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }

        /* Custom Animation untuk SweetAlert */
        @keyframes fadeInUpSmall {
            0% { opacity: 0; transform: translateY(20px) scale(0.97); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes fadeOutDownSmall {
            0% { opacity: 1; transform: translateY(0) scale(1); }
            100% { opacity: 0; transform: translateY(15px) scale(0.97); }
        }
        .animate__fadeInUpSmall { animation: fadeInUpSmall 0.35s cubic-bezier(0.25, 0.18, 0.15, 1) both; }
        .animate__fadeOutDownSmall { animation: fadeOutDownSmall 0.30s cubic-bezier(0.55, 0.06, 0.41, 0.95) both; }
    </style>
</head>
<body class="bg-white">

    <section class="h-screen flex overflow-hidden">
        
        <div class="hidden lg:flex lg:w-1/2 bg-gray-900 items-center justify-center p-12 relative overflow-hidden">
            <div class="absolute inset-0 opacity-20 bg-[radial-gradient(#ffffff33_1px,transparent_1px)] [background-size:20px_20px]"></div>
            
            <div class="max-w-lg text-center relative z-10">
                <div class="flex justify-center mb-2">
                    <img 
                        src="/img/register.png" 
                        alt="Ilustrasi Register" 
                        class="w-80 h-auto object-contain drop-shadow-2xl animate-fade-in-up"
                        onerror="this.style.display='none'">
                </div>

                <h2 class="text-3xl font-bold text-white mb-4 tracking-tight">
                    Mulai Perjalanan Anda
                </h2>
                <p class="text-gray-400 text-lg leading-relaxed">
                    Bergabunglah dengan ribuan siswa berprestasi lainnya. Daftarkan diri Anda sekarang untuk masa depan yang lebih cerah.
                </p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col h-full bg-white relative z-10 overflow-y-auto">
            
            <div class="px-6 pt-8 pb-4 sm:px-10 sm:pt-10 w-full shrink-0">
                <a href="{{ route('home') }}" class="group inline-flex items-center text-base font-semibold text-gray-500 hover:text-gray-900 transition-colors py-2">
                    <svg class="w-5 h-5 mr-2.5 transition-transform duration-200 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>

            @if ($errors->any())
            <div class="mx-6 sm:mx-10 p-4 mb-4 text-sm text-red-700 bg-red-50 border border-red-200 rounded-xl">
                <div class="font-bold mb-1">Terjadi Kesalahan:</div>
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="flex-1 flex flex-col justify-center px-6 sm:px-10 pb-10">
                <div class="w-full max-w-lg mx-auto space-y-8">
                    
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-2 tracking-tight">Buat Akun Siswa</h1>
                        <p class="text-lg text-gray-600">Isi data diri Anda dengan benar dan valid.</p>
                    </div>

                    <div class="p-4 bg-amber-50 rounded-xl border border-amber-100 flex items-start gap-3">
                        <i class="fa-solid fa-circle-info text-amber-500 mt-1"></i>
                        <p class="text-sm text-amber-800 leading-relaxed">
                            Pastikan <strong>NIK</strong> dan <strong>NISN</strong> sesuai dengan Kartu Keluarga (KK) atau Ijazah/Rapor sekolah asal.
                        </p>
                    </div>

                    <form class="space-y-5" action="{{ route('register.siswa.submit') }}" method="POST">
                        @csrf
                        
                        <div>
                            <label for="nama_lengkap" class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                            <input id="nama_lengkap" name="nama_lengkap" type="text" required
                                class="w-full px-5 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-all outline-none placeholder-gray-400 bg-gray-50 focus:bg-white"
                                placeholder="Sesuai Ijazah" value="{{ old('nama_lengkap') }}">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="nik" class="block text-sm font-bold text-gray-700 mb-2">NIK</label>
                                <input id="nik" name="nik" type="text" required maxlength="16"
                                    class="w-full px-5 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-all outline-none placeholder-gray-400 bg-gray-50 focus:bg-white"
                                    placeholder="16 Digit Angka" value="{{ old('nik') }}">
                            </div>
                            <div>
                                <label for="nisn" class="block text-sm font-bold text-gray-700 mb-2">NISN</label>
                                <input id="nisn" name="nisn" type="text" required maxlength="10"
                                    class="w-full px-5 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-all outline-none placeholder-gray-400 bg-gray-50 focus:bg-white"
                                    placeholder="10 Digit Angka" value="{{ old('nisn') }}">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="tanggal_lahir" class="block text-sm font-bold text-gray-700 mb-2">Tanggal Lahir</label>
                                <input id="tanggal_lahir" name="tanggal_lahir" type="date" required
                                    class="w-full px-5 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-all outline-none bg-gray-50 focus:bg-white"
                                    value="{{ old('tanggal_lahir') }}">
                            </div>
                            <div>
                                <label for="jenis_kelamin" class="block text-sm font-bold text-gray-700 mb-2">Jenis Kelamin</label>
                                <div class="relative">
                                    <select id="jenis_kelamin" name="jenis_kelamin" required
                                        class="w-full px-5 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-all outline-none bg-gray-50 focus:bg-white appearance-none cursor-pointer">
                                        <option value="">Pilih Gender</option>
                                        <option value="L" @selected(old('jenis_kelamin')=='L')>Laki-Laki</option>
                                        <option value="P" @selected(old('jenis_kelamin')=='P')>Perempuan</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email Aktif</label>
                            <input id="email" name="email" type="email" required
                                class="w-full px-5 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-all outline-none placeholder-gray-400 bg-gray-50 focus:bg-white"
                                placeholder="nama@email.com" value="{{ old('email') }}">
                        </div>

                        <div x-data="{ show: false }">
                            <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Buat Password</label>
                            <div class="relative">
                                <input :type="show ? 'text' : 'password'" id="password" name="password" required
                                    class="w-full px-5 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-all outline-none placeholder-gray-400 bg-gray-50 focus:bg-white pr-24"
                                    placeholder="Minimal 6 karakter">
                                <button type="button" @click="show = !show"
                                    class="absolute right-5 top-1/2 transform -translate-y-1/2 text-sm font-semibold text-gray-500 hover:text-gray-900 transition-colors">
                                    <span x-text="show ? 'Sembunyikan' : 'Lihat'"></span>
                                </button>
                            </div>
                        </div>

                        <div x-data="{ show: false }">
                            <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2">Ulangi Password</label>
                            <div class="relative">
                                <input :type="show ? 'text' : 'password'" id="password_confirmation" name="password_confirmation" required
                                    class="w-full px-5 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-all outline-none placeholder-gray-400 bg-gray-50 focus:bg-white pr-24"
                                    placeholder="Ketik ulang password">
                                <button type="button" @click="show = !show"
                                    class="absolute right-5 top-1/2 transform -translate-y-1/2 text-sm font-semibold text-gray-500 hover:text-gray-900 transition-colors">
                                    <span x-text="show ? 'Sembunyikan' : 'Lihat'"></span>
                                </button>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-gray-900 text-white py-4 px-6 rounded-xl font-bold text-lg hover:bg-black focus:ring-4 focus:ring-gray-200 transition-all transform active:scale-[0.99] shadow-lg mt-4">
                            Daftar Sekarang
                        </button>
                    </form>

                    <div class="mt-6 text-center pt-6 border-t border-gray-100">
                        <p class="text-sm text-gray-600">
                            Sudah memiliki akun? 
                            <a href="{{ route('login') }}" class="font-bold text-blue-700 hover:text-blue-900 hover:underline transition-colors ml-1">
                                Login di sini
                            </a>
                        </p>
                    </div>

                </div>
            </div>
        </div>

    </section>

    @if (session('register_success'))
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Registrasi Berhasil!',
            text: 'Akun Anda telah dibuat. Silakan login untuk melanjutkan.',
            icon: 'success',
            confirmButtonText: 'Lanjut Login',
            confirmButtonColor: '#111827',
            showClass: { popup: 'animate__fadeInUpSmall' },
            hideClass: { popup: 'animate__fadeOutDownSmall' },
            allowOutsideClick: false,
            allowEscapeKey: false,
            padding: '2em',
            customClass: {
                popup: 'rounded-2xl shadow-xl'
            }
        }).then(() => {
            window.location.href = "{{ route('login') }}";
        });
    });
    </script>
    @endif

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const nisn = document.getElementById('nisn');
        const nik = document.getElementById('nik');

        // Fungsi hanya angka
        const enforceNumber = (e) => {
            e.target.value = e.target.value.replace(/\D/g, '');
        };

        if(nisn) nisn.addEventListener('input', enforceNumber);
        if(nik) nik.addEventListener('input', enforceNumber);
    });
    </script>

</body>
</html>