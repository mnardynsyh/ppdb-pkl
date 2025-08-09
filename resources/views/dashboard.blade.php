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


 {{-- Alur Pendaftaran --}}
<section id="alur" class="bg-white py-16 -mt-8 sm:py-20">
  <div class="px-4 mx-auto max-w-screen-xl">
    <h2 class="text-4xl sm:text-4xl font-bold text-center text-gray-900 mb-8">
      Alur Pendaftaran
    </h2>

    <div id="accordion-color" data-accordion="collapse" data-active-classes="bg-blue-100 dark:bg-gray-800 text-blue-600">
      
      <!-- Step 1 -->
      <h2 id="accordion-color-heading-1">
        <button type="button" 
          class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800 gap-3"
          data-accordion-target="#accordion-color-body-1" aria-expanded="true" aria-controls="accordion-color-body-1">
          <span>1. Mengisi Formulir Pendaftaran</span>
          <svg data-accordion-icon class="w-3 h-3 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
          </svg>
        </button>
      </h2>
      <div id="accordion-color-body-1" class="hidden" aria-labelledby="accordion-color-heading-1">
        <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
          <p class="text-gray-500 dark:text-gray-400">
            Calon siswa mengisi formulir pendaftaran secara online dengan data yang lengkap dan benar.
          </p>
        </div>
      </div>

      <!-- Step 2 -->
      <h2 id="accordion-color-heading-2">
        <button type="button" 
          class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800 gap-3"
          data-accordion-target="#accordion-color-body-2" aria-expanded="false" aria-controls="accordion-color-body-2">
          <span>2. Verifikasi Data</span>
          <svg data-accordion-icon class="w-3 h-3 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
          </svg>
        </button>
      </h2>
      <div id="accordion-color-body-2" class="hidden" aria-labelledby="accordion-color-heading-2">
        <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
          <p class="text-gray-500 dark:text-gray-400">
            Tim panitia akan memverifikasi data dan dokumen yang telah dikirim oleh calon siswa.
          </p>
        </div>
      </div>

      <!-- Step 3 -->
      <h2 id="accordion-color-heading-3">
        <button type="button" 
          class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800 gap-3"
          data-accordion-target="#accordion-color-body-3" aria-expanded="false" aria-controls="accordion-color-body-3">
          <span>3. Pengumuman Hasil Seleksi</span>
          <svg data-accordion-icon class="w-3 h-3 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
          </svg>
        </button>
      </h2>
      <div id="accordion-color-body-3" class="hidden" aria-labelledby="accordion-color-heading-3">
        <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700">
          <p class="text-gray-500 dark:text-gray-400">
            Calon siswa dapat melihat hasil seleksi melalui website PPDB Online atau pemberitahuan resmi dari sekolah.
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

@endsection
