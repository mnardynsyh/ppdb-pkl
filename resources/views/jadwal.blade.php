@extends('layouts.app')

@section('title', 'Jadwal Pendaftaran')

@section('content')

{{-- Section Jadwal Pendaftaran --}}
<section class="bg-white py-16">
  <div class="w-full max-w-screen-md mx-auto px-4 sm:px-8 lg:px-16">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold">Jadwal Pendaftaran</h1>
        <p class="text-gray-500 mt-2">Berikut adalah linimasa kegiatan Penerimaan Peserta Didik Baru.</p>
    </div>

    {{-- Pastikan ada data jadwal sebelum menampilkan timeline --}}
    @if($jadwals->count() > 0)
      <ol class="relative border-l border-gray-300 ml-4">              
        @foreach($jadwals as $index => $jadwal)
          <li class="mb-10 ml-8">
            <span class="absolute -left-4 flex items-center justify-center w-8 h-8 bg-blue-600 rounded-full text-white font-bold">
              {{ $index + 1 }}
            </span>
            <h3 class="font-semibold text-lg text-gray-900">{{ $jadwal->title }}</h3>
            <time class="block mb-2 text-sm font-medium text-gray-500">{{ $jadwal->date_range }}</time>
            <p class="text-base text-gray-600">{{ $jadwal->description }}</p>
          </li>
        @endforeach
      </ol>
    @else
      <p class="text-center text-gray-500">Jadwal pendaftaran akan segera diumumkan.</p>
    @endif
     <div class="text-center mt-12">
        <a href="{{ route('home') }}" class="px-6 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-300">
            &larr; Kembali ke Halaman Utama
        </a>
    </div>
  </div>
</section>

@endsection
