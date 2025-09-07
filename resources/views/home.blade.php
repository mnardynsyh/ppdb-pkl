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
<section 
  style="background-image: url('{{ asset('img/bg-sekolah.png') }}')" 
  class="bg-cover bg-center bg-no-repeat w-full h-[90vh] sm:h-[90vh] min-h-[500px] relative"
>
  <div class="absolute inset-0 bg-black bg-opacity-70"></div>
  <div 
    class="relative z-10 px-4 mx-auto max-w-screen-xl text-center py-16 sm:py-24 lg:py-40"
    data-aos="fade-up"
  >
    <h1 
      class="mb-4 text-3xl sm:text-4xl md:text-5xl lg:text-5xl font-extrabold tracking-tight leading-tight text-white"
      data-aos="fade-down"
    >
      Selamat Datang di PPDB Online <br>
      SMP Muhammadiyah 1 Sirampog
    </h1>
    <p 
      class="mb-8 text-sm sm:text-base lg:text-xl font-normal text-gray-300 sm:px-10 lg:px-48"
      data-aos="fade-up" data-aos-delay="200"
    >
      Daftarkan dirimu sekarang untuk bergabung bersama sekolah unggulan kami!
    </p>

    {{-- [DIPERBARUI] Tombol Aksi (CTA) menggunakan variabel baru --}}
    @if($statusInfo['status'] == 'Dibuka')
        <div class="flex flex-col space-y-3 sm:flex-row sm:justify-center sm:space-y-0" data-aos="zoom-in" data-aos-delay="400">
          <a href="{{ route('siswa.register') }}" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
            Daftar Sekarang
            <svg class="w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/></svg>
          </a>
          <a href="{{ route('jadwal')}}" class="inline-flex justify-center items-center py-3 px-5 sm:ms-4 text-base font-medium text-white rounded-lg border border-white hover:bg-gray-100 hover:text-gray-900">
            Lihat Jadwal Pendaftaran
          </a>
        </div>
    @endif
  </div>
</section>

@include('partials.alur')

@include('partials.persyaratan')

@include('partials.faq')


{{-- Footer --}}
<footer class="bg-gray-800 text-white py-8">
    <div class="max-w-screen-xl mx-auto px-4 text-center">
        <p>&copy; {{ date('Y') }} PPDB Online SMP Muhammadiyah 1 Sirampog. All Rights Reserved.</p>
        <p class="text-sm text-gray-400 mt-2">Jalan Raya Karanganyar, Sirampog, Brebes, Jawa Tengah 52272</p>
        <div class="mt-4">
            <a href="{{ route('admin.login') }}" class="text-sm text-gray-400 hover:underline">Login Admin</a>
        </div>
    </div>
</footer>

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

