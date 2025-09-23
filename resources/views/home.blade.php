@extends('layouts.app')

@section('title', 'PPDB Online')

@section('content')

{{-- [DIPERBARUI] Logika status sekarang diambil dari Model --}}
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
<section class="bg-white" style="font-family: 'Poppins', sans-serif;">
    <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 h-[90vh] sm:h-[90vh] min-h-[500px] items-center">
        <div class="mr-auto place-self-center lg:col-span-7" data-aos="fade-right">
            <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl text-[#283618]">
                Selamat Datang di PPDB Online SMP Muhammadiyah 1 Sirampog
            </h1>
            <p class="max-w-2xl mb-6 font-light text-[#606c38] lg:mb-8 md:text-lg lg:text-xl">
                Daftarkan dirimu sekarang untuk bergabung bersama sekolah unggulan kami dan raih masa depan gemilang!
            </p>

            @if($statusInfo['status'] == 'Dibuka')
              <div data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('siswa.register') }}" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-[#bc6c25] hover:bg-[#a55d20] focus:ring-4 focus:ring-[#dda15e]/80 transition-colors">
                    Daftar Sekarang
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/0000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
                <a href="{{ route('jadwal')}}" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-[#283618] border border-[#606c38] rounded-lg hover:bg-[#dda15e]/40 focus:ring-4 focus:ring-[#dda15e]/50 transition-colors">
                    Lihat Jadwal
                </a> 
              </div>
            @endif
        </div>
        <div class="hidden lg:mt-0 lg:col-span-5 lg:flex justify-center items-center" data-aos="fade-left">
            <img src="{{ asset('img/hero.png') }}" alt="Foto SMP Muhammadiyah 1 Sirampog" class="object-top drop-shadow-lg w-full">
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

