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
  <div class="relative z-10 px-4 mx-auto max-w-screen-xl text-center py-16 sm:py-24 lg:py-40">
    <h1 class="mb-4 text-3xl sm:text-4xl md:text-5xl lg:text-5xl font-extrabold tracking-tight leading-tight text-white">
      Selamat Datang di PPDB Online <br>
      SMK Muhammadiyah Bumiayu
    </h1>
    
    <p class="mb-8 text-sm sm:text-base lg:text-xl font-normal text-gray-300 sm:px-10 lg:px-48">
      Daftarkan dirimu sekarang untuk bergabung bersama sekolah unggulan kami!
    </p>

    <!-- Tombol -->
    <div class="flex flex-col space-y-3 sm:flex-row sm:justify-center sm:space-y-0">
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

@endsection
