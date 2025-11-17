@extends('layouts.app')

@section('title', 'Jadwal Pendaftaran')

@section('content')

<section class="min-h-screen bg-white py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-12">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-3">Jadwal Pendaftaran</h1>
            <p class="text-lg sm:text-xl text-gray-600">Linimasa Kegiatan Penerimaan Peserta Didik Baru</p>
        </div>

        {{-- Status Banner --}}
        @php
            $statusInfo = $pengaturan && method_exists($pengaturan, 'getStatusDetails') ? $pengaturan->getStatusDetails() : [
                'status' => 'Ditutup',
                'pesan' => 'Jadwal pendaftaran akan segera diumumkan.',
            ];
        @endphp
        
        <div class="bg-white rounded-2xl p-6 sm:p-8 mb-12 border border-gray-200 shadow-sm">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-center sm:text-left">
                    <div class="flex items-center justify-center sm:justify-start mb-2">
                        <div class="w-3 h-3 rounded-full {{ $statusInfo['status'] == 'Dibuka' ? 'bg-green-500' : 'bg-gray-400' }} mr-3"></div>
                        <span class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Status Pendaftaran</span>
                    </div>
                    <p class="text-gray-800 font-medium text-lg">{{ $statusInfo['pesan'] }}</p>
                </div>
                @if($statusInfo['status'] == 'Dibuka')
                    <a href="{{ route('register.siswa') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 text-base font-medium text-white bg-gray-900 rounded-lg hover:bg-gray-800 transition-colors duration-200 shadow-sm hover:shadow-md">
                        Daftar Sekarang
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                @else
                    <div class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 text-base font-medium text-gray-500 bg-gray-100 rounded-lg border border-gray-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/>
                        </svg>
                        Pendaftaran Ditutup
                    </div>
                @endif
            </div>
        </div>

        {{-- Timeline --}}
        @if($jadwals && $jadwals->count() > 0)
            {{-- Desktop Timeline (Horizontal) --}}
            <div class="hidden lg:block">
                <div class="relative">
                    {{-- Horizontal Line --}}
                    <div class="absolute left-0 right-0 top-1/2 h-0.5 bg-gray-200 transform -translate-y-1/2"></div>
                    
                    <div class="relative flex justify-between items-start">
                        @foreach($jadwals as $jadwal)
                            <div class="flex flex-col items-center w-1/{{ $jadwals->count() }} px-4">
                                {{-- Dot --}}
                                <div class="w-4 h-4 rounded-full bg-blue-600 border-4 border-white shadow-lg z-10 mb-8"></div>
                                
                                {{-- Content Card --}}
                                <div class="w-full max-w-xs">
                                    <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm hover:shadow-lg hover:border-blue-200 transition-all duration-300">
                                        <div class="mb-4">
                                            <span class="inline-block px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-sm font-medium">
                                                {{ $jadwal->date_range }}
                                            </span>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ $jadwal->title }}</h3>
                                        <p class="text-gray-600 text-sm leading-relaxed">{{ $jadwal->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Mobile Timeline (Vertical) --}}
            <div class="lg:hidden">
                <div class="relative">
                    {{-- Vertical Line --}}
                    <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gray-200"></div>
                    
                    <div class="space-y-8">
                        @foreach($jadwals as $jadwal)
                            <div class="relative flex">
                                {{-- Dot --}}
                                <div class="absolute left-6 flex items-center justify-center w-4 h-4 -ml-2">
                                    <div class="w-3 h-3 rounded-full bg-blue-600 border-2 border-white shadow-sm"></div>
                                </div>
                                
                                {{-- Content --}}
                                <div class="ml-12 flex-1">
                                    <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm hover:shadow-md hover:border-blue-200 transition-all duration-300">
                                        <div class="mb-4">
                                            <span class="inline-block px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-sm font-medium">
                                                {{ $jadwal->date_range }}
                                            </span>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ $jadwal->title }}</h3>
                                        <p class="text-gray-600 text-sm leading-relaxed">{{ $jadwal->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            {{-- Empty State --}}
            <div class="text-center py-16">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Jadwal Belum Tersedia</h3>
                <p class="text-gray-600 max-w-md mx-auto">
                    Informasi jadwal pendaftaran akan diumumkan dalam waktu dekat.
                </p>
            </div>
        @endif
        
        {{-- Back Button --}}
        <div class="text-center mt-12 pt-8 border-t border-gray-200">
            <a href="{{ route('home') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>

@endsection