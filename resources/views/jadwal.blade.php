@extends('layouts.app')

@section('title', 'Jadwal Pendaftaran')

@section('content')

{{-- Section Jadwal Pendaftaran --}}
<section class="bg-gray-50 py-16">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-down">
            <h1 class="text-4xl font-bold text-gray-800">Jadwal Pendaftaran</h1>
            <p class="text-gray-500 mt-2">Berikut adalah linimasa kegiatan Penerimaan Peserta Didik Baru.</p>
        </div>

        {{-- Banner Status Pendaftaran --}}
        @php
            $statusInfo = $pengaturan && method_exists($pengaturan, 'getStatusDetails') ? $pengaturan->getStatusDetails() : [
                'status' => 'Ditutup',
                'pesan' => 'Jadwal pendaftaran belum dikonfigurasi oleh panitia.',
            ];
        @endphp
        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-100 mb-16 max-w-screen-md mx-auto" data-aos="fade-up">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="text-center md:text-left">
                    <h3 class="text-xl font-bold text-gray-800">Status Pendaftaran Saat Ini</h3>
                    <p class="text-gray-600 mt-1">{{ $statusInfo['pesan'] }}</p>
                </div>
                @if($statusInfo['status'] == 'Dibuka')
                    <a href="{{ route('siswa.register') }}" class="w-full md:w-auto flex-shrink-0 inline-block text-center py-3 px-6 text-base font-medium text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 transition">
                        Daftar Sekarang
                    </a>
                @else
                    <span class="w-full md:w-auto flex-shrink-0 inline-block text-center py-3 px-6 text-base font-medium text-white rounded-lg bg-gray-400 cursor-not-allowed">
                        Pendaftaran Ditutup
                    </span>
                @endif
            </div>
        </div>

        {{-- [DIPERBARUI] Linimasa Jadwal Horizontal Profesional --}}
        @if($jadwals && $jadwals->count() > 0)
            <ol class="items-center sm:flex">
                @foreach($jadwals as $jadwal)
                    <li class="relative mb-6 sm:mb-0 w-full" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="flex items-center">
                            <div class="z-10 flex items-center justify-center w-8 h-8 bg-blue-600 rounded-full ring-8 ring-white dark:ring-gray-800 shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            {{-- Garis Konektor, disembunyikan pada item terakhir --}}
                            @if(!$loop->last)
                                <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                            @endif
                        </div>
                        <div class="mt-3 sm:pe-8">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $jadwal->title }}</h3>
                            <time class="block mb-2 text-sm font-normal leading-none text-blue-600 dark:text-blue-500">{{ $jadwal->date_range }}</time>
                            <p class="text-base font-normal text-gray-600 dark:text-gray-400">{{ $jadwal->description }}</p>
                        </div>
                    </li>
                @endforeach
            </ol>
        @else
            <div class="text-center text-gray-500 bg-white p-8 rounded-lg shadow-md">
                <p>Jadwal pendaftaran akan segera diumumkan. Silakan periksa kembali halaman ini secara berkala.</p>
            </div>
        @endif
        
        <div class="text-center mt-16">
            <a href="{{ route('home') }}" class="px-6 py-3 text-white bg-gray-600 rounded-lg hover:bg-gray-700 transition duration-300">
                &larr; Kembali ke Halaman Utama
            </a>
        </div>
    </div>
</section>

{{-- [WAJIB] Script untuk animasi AOS --}}
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 800,
    once: true
  });
</script>

@endsection

