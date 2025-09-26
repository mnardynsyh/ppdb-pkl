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

{{-- Hero Section --}}
{{-- [SEMPURNAKAN] Latar belakang, tipografi, dan palet warna disempurnakan untuk kesan yang bersih, profesional, dan berdimensi. --}}
<section class="bg-white" style="font-family: 'Poppins', sans-serif;">
    <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 min-h-[85vh] items-center">
        
        {{-- Kolom Teks --}}
        <div class="mr-auto place-self-center lg:col-span-7" data-aos="fade-right">
            {{-- [SEMPURNAKAN] Tipografi disesuaikan untuk hierarki visual yang lebih baik. --}}
            <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-snug md:text-5xl text-slate-900">
                Selamat Datang di PPDB 
                <span class="text-blue-600">SMP Muhammadiyah 1 Sirampog</span>
            </h1>
            <p class="max-w-2xl mb-8 font-normal text-slate-600 lg:mb-10 md:text-lg lg:text-xl">
                Daftarkan dirimu sekarang untuk bergabung bersama sekolah unggulan kami dan raih masa depan gemilang!
            </p>

            @if($statusInfo['status'] == 'Dibuka')
              <div data-aos="fade-up" data-aos-delay="200">
                {{-- [SEMPURNAKAN] Tombol utama menggunakan warna Biru primer yang kuat dan profesional, dengan efek bayangan untuk memberikan kedalaman. --}}
                <a href="{{ route('siswa.register') }}" class="inline-flex items-center justify-center px-6 py-3.5 mr-3 text-base font-medium text-center text-white rounded-lg bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 transition-all duration-300">
                    Daftar Sekarang
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
                {{-- [SEMPURNAKAN] Tombol sekunder didesain ulang agar bersih, modern, dan tidak bersaing dengan tombol utama. --}}
                <a href="{{ route('jadwal')}}" class="inline-flex items-center justify-center px-6 py-3.5 text-base font-medium text-center text-slate-800 border border-slate-200 rounded-lg hover:bg-slate-100 focus:ring-4 focus:ring-slate-200 transition-colors duration-300">
                    Lihat Jadwal
                </a> 
              </div>
            @endif
        </div>

        {{-- Kolom Gambar --}}
        <div class="hidden lg:mt-0 lg:col-span-5 lg:flex justify-center items-center" data-aos="fade-left">
            <img src="{{ asset('img/hero.png') }}" alt="Foto SMP Muhammadiyah 1 Sirampog" 
                 class="drop-shadow-2xl w-full h-auto max-h-[500px] object-contain">
        </div>                
    </div>
</section>

@include('partials.alur')

@include('partials.persyaratan')

@include('partials.faq')

@include('partials.footer')

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
{{-- Menambahkan AlpineJS Collapse Plugin untuk animasi FAQ --}}
<script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
<script>
  AOS.init({
    duration: 800,
    once: true
  });
</script>

@endsection

