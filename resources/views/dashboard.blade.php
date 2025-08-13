@extends('layouts.app')

@section('title', 'PPDB Online')

@section('content')

<section 
  style="background-image: url('{{ asset('img/bg-sekolah.jpg') }}')" 
  class="bg-cover bg-center bg-no-repeat w-full h-[90vh] sm:h-[90vh] min-h-[500px] relative"
>
  <!-- Overlay -->
  <div class="absolute inset-0 bg-black bg-opacity-70"></div>

  <!-- Konten -->
  <div 
    class="relative z-10 px-4 mx-auto max-w-screen-xl text-center py-16 sm:py-24 lg:py-40"
    data-aos="fade-up"
    data-aos-duration="1000"
  >
    <h1 
      class="mb-4 text-3xl sm:text-4xl md:text-5xl lg:text-5xl font-extrabold tracking-tight leading-tight text-white"
      data-aos="fade-down"
      data-aos-delay="200"
    >
      Selamat Datang di PPDB Online <br>
      SMK Muhammadiyah Bumiayu
    </h1>
    
    <p 
      class="mb-8 text-sm sm:text-base lg:text-xl font-normal text-gray-300 sm:px-10 lg:px-48"
      data-aos="fade-up"
      data-aos-delay="400"
    >
      Daftarkan dirimu sekarang untuk bergabung bersama sekolah unggulan kami!
    </p>

    <!-- Tombol -->
    <div 
      class="flex flex-col space-y-3 sm:flex-row sm:justify-center sm:space-y-0"
      data-aos="zoom-in"
      data-aos-delay="600"
    >
      <a 
        href="/daftar" 
        class="inline-flex justify-center items-center py-2 px-4 text-sm sm:text-base font-medium text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300"
      >
        Daftar Sekarang
        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
        </svg>
      </a>
      
      <a 
        href="#alur" 
        class="inline-flex justify-center items-center py-2 px-4 sm:ms-4 text-sm sm:text-base font-medium text-white rounded-lg border border-white hover:bg-gray-100 hover:text-gray-900"
      >Alur Pendaftaran
      </a>
    </div>
  </div>
</section>


<!-- Section Fitur -->
<section class="py-16 bg-white">
  <div class="max-w-screen-xl mx-auto grid grid-cols-1 sm:grid-cols-3 gap-8">
    
    <div class="text-center" data-aos="fade-up" data-aos-delay="100">
      <span class="inline-flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-blue-100 text-blue-600 text-2xl font-bold mb-4">
        1
      </span>
      <h3 class="text-lg font-semibold">Isi Form Pendaftaran</h3>
      <p class="text-gray-500 mt-2">Lengkapi data pendaftaran dengan mudah melalui website kami.</p>
    </div>

    <div class="text-center" data-aos="fade-up" data-aos-delay="200">
      <span class="inline-flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-green-100 text-green-600 text-2xl font-bold mb-4">
        2
      </span>
      <h3 class="text-lg font-semibold">Verifikasi Data</h3>
      <p class="text-gray-500 mt-2">Panitia akan memeriksa kelengkapan dan kebenaran data Anda.</p>
    </div>

    <div class="text-center" data-aos="fade-up" data-aos-delay="300">
      <span class="inline-flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-purple-100 text-purple-600 text-2xl font-bold mb-4">
        3
      </span>
      <h3 class="text-lg font-semibold">Pengumuman</h3>
      <p class="text-gray-500 mt-2">Lihat hasil seleksi secara online tanpa harus datang ke sekolah.</p>
    </div>

  </div>
</section>


<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 800,
    once: true
  });
</script>

<hr>

@include('partials.jadwal')

@endsection
