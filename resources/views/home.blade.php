@extends('layouts.app')

@section('title', 'PPDB Online')

@section('content')

@php
    $statusInfo = $pengaturan ? $pengaturan->getStatusDetails() : [
        'status' => 'Ditutup',
        'pesan' => 'Pengaturan pendaftaran belum dikonfigurasi.',
        'warna' => 'bg-red-100 border-red-500 text-red-700',
    ];
@endphp

<div class="{{ $statusInfo['warna'] }} border-l-4 p-4 text-center" role="alert">
    <p>{{ $statusInfo['pesan'] }}</p>
</div>

<section class="relative w-full" data-carousel="slide" style="font-family: 'Poppins', sans-serif;">
    <!-- Carousel wrapper -->
    <div class="relative h-[85vh] min-h-[500px] overflow-hidden">
         <!-- Item 1: Selamat Datang -->
        <div class="hidden duration-1000 ease-in-out" data-carousel-item>
            <img src="{{asset ('img/bg-sekolah.png')}}" class="absolute block w-full h-full object-cover" alt="Kegiatan Belajar Mengajar">
            <div class="absolute inset-0 bg-black bg-opacity-80"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white p-4">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-snug md:text-5xl text-white">
                    Selamat Datang di PPDB 
                    <span class="text-cyan-300">SMP Muhammadiyah 1 Sirampog</span>
                </h1>
                <p class="max-w-2xl mb-8 font-normal text-slate-200 lg:mb-10 md:text-lg lg:text-xl">
                    Daftarkan dirimu sekarang untuk bergabung bersama sekolah unggulan kami!
                </p>
                @if($statusInfo['status'] == 'Dibuka')
                  <div>
                    <a href="{{ route('register.siswa') }}" class="inline-flex items-center justify-center px-6 py-3.5 mr-3 text-base font-medium text-center text-white rounded-lg bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 transition-all duration-300">
                        Daftar Sekarang
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                    <a href="{{ route('jadwal')}}" class="inline-flex items-center justify-center px-6 py-3.5 text-base font-medium text-center text-slate-800 bg-white rounded-lg hover:bg-slate-100 focus:ring-4 focus:ring-slate-200 transition-colors duration-300">
                        Lihat Jadwal
                    </a> 
                  </div>
                @endif
            </div>
        </div>
        <!-- Item 2: Ekstrakurikuler -->
        <div class="hidden duration-1000 ease-in-out" data-carousel-item>
            <img src="{{asset ('img/slider-2.jpg')}}" class="absolute block w-full h-full object-cover" alt="Ekstrakurikuler">
             <div class="absolute inset-0 bg-black bg-opacity-80"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white p-4">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-snug md:text-5xl text-white">
                    Kembangkan Bakat & Minat
                    <span class="text-amber-300">Melalui Ekstrakurikuler</span>
                </h1>
                <p class="max-w-2xl mb-8 font-normal text-slate-200 lg:mb-10 md:text-lg lg:text-xl">
                    Berbagai pilihan kegiatan untuk menunjang prestasi non-akademik siswa.
                </p>
            </div>
        </div>
        <!-- Item 3: Fasilitas -->
        <div class="hidden duration-1000 ease-in-out" data-carousel-item>
            <img src="{{asset ('img/slider-3.jpg')}}" class="absolute block w-full h-full object-cover" alt="Fasilitas Sekolah">
            <div class="absolute inset-0 bg-black bg-opacity-80"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white p-4">
                 <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-snug md:text-5xl text-white">
                    Didukung Fasilitas Modern
                    <span class="text-emerald-300">& Lingkungan Belajar Nyaman</span>
                </h1>
                <p class="max-w-2xl mb-8 font-normal text-slate-200 lg:mb-10 md:text-lg lg:text-xl">
                    Laboratorium, perpustakaan, dan sarana olahraga yang memadai untuk mendukung proses belajar.
                </p>
            </div>
        </div>
    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</section>

@include('partials.alur')

@include('partials.persyaratan')

@include('partials.faq')

@include('partials.footer')


<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script>
  AOS.init({
    duration: 800,
    once: true
  });
</script>

@endsection

