@extends('layouts.app')

@section('title', 'Jadwal Pendaftaran')

@section('content')

    <section class="relative bg-neutral-900 pt-24 pb-20 lg:pt-24 lg:pb-28 overflow-hidden rounded-b shadow-xl z-10">

        {{-- Content --}}
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 text-center">

            {{-- Main Title --}}
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight mb-4">
                Jadwal <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-primary-200">Pendaftaran</span>
            </h1>

            {{-- Description --}}
            <p class="text-lg text-neutral-400 max-w-2xl mx-auto leading-relaxed">
                Pantau linimasa kegiatan penerimaan peserta didik baru agar Anda tidak melewatkan tahapan penting.
            </p>
        </div>
    </section>

    {{-- ======================================================================= --}}
    {{-- 2. MAIN CONTENT (Status & Timeline)                                     --}}
    {{-- ======================================================================= --}}
    <section class="min-h-screen bg-white py-16 lg:py-20 -mt-12 relative z-0">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Status Banner --}}
            @php
                $statusInfo = isset($pengaturan) && method_exists($pengaturan, 'getStatusDetails') 
                    ? $pengaturan->getStatusDetails() 
                    : [
                        'status' => 'Ditutup',
                        'pesan' => 'Jadwal pendaftaran akan segera diumumkan.',
                    ];
                $isOpen = $statusInfo['status'] == 'Dibuka';
            @endphp
            
            <div class="bg-white rounded-3xl p-6 sm:p-8 mb-16 border border-neutral-100 shadow-xl shadow-neutral-200/40 relative overflow-hidden">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-6 relative z-10">
                    <div class="text-center sm:text-left">
                        <div class="flex items-center justify-center sm:justify-start mb-2 gap-3">
                            <span class="relative flex h-3 w-3">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $isOpen ? 'bg-primary-400' : 'bg-neutral-400' }} opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-3 w-3 {{ $isOpen ? 'bg-primary-500' : 'bg-neutral-500' }}"></span>
                            </span>
                            <span class="text-xs font-bold text-neutral-500 uppercase tracking-widest">Status Saat Ini</span>
                        </div>
                        <p class="text-neutral-900 font-bold text-xl md:text-2xl">{{ $statusInfo['pesan'] }}</p>
                    </div>

                    @if($isOpen)
                        <a href="{{ route('register.siswa') }}"
                            class="group w-full sm:w-auto inline-flex items-center justify-center 
                                    px-7 py-3.5 text-sm font-semibold text-white 
                                    bg-teal-600 hover:bg-teal-700 
                                    rounded-xl transition-all duration-200
                                    shadow-md hover:shadow-lg shadow-teal-500/25
                                    focus:outline-none focus:ring-4 focus:ring-teal-300/40">

                                <span>Daftar Sekarang</span>

                                <svg class="ml-1.5 w-[17px] h-[17px] flex-shrink-0 
                                            group-hover:translate-x-[2px] transition-transform duration-200"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>

                            </a>


                    @else
                        <div class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-sm font-bold text-neutral-400 bg-neutral-100 rounded-xl border border-neutral-200 cursor-not-allowed">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>
                            Pendaftaran Ditutup
                        </div>
                    @endif
                </div>
            </div>

            {{-- Timeline --}}
            @if(isset($jadwals) && $jadwals->count() > 0)
                
                {{-- Desktop Timeline (Horizontal) --}}
                <div class="hidden lg:block">
                    <div class="relative pt-10 pb-12">
                        {{-- Horizontal Line --}}
                        <div class="absolute left-0 right-0 top-[23px] h-1 bg-neutral-100 w-full -z-10 rounded-full"></div>
                        
                        <div class="flex justify-between items-start gap-4">
                            @foreach($jadwals as $jadwal)
                                <div class="flex flex-col items-center flex-1 relative group">
                                    {{-- Dot --}}
                                    <div class="w-12 h-12 rounded-full bg-white border-4 border-primary-500 shadow-md z-10 mb-6 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <div class="w-2.5 h-2.5 bg-primary-500 rounded-full"></div>
                                    </div>
                                    
                                    {{-- Content Card --}}
                                    <div class="w-full px-2">
                                        <div class="bg-white rounded-2xl p-6 border border-neutral-200 shadow-sm group-hover:shadow-lg group-hover:border-primary-200 group-hover:-translate-y-1 transition-all duration-300 text-center relative">
                                            {{-- Arrow --}}
                                            <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white border-t border-l border-neutral-200 transform rotate-45 group-hover:border-primary-200 transition-colors"></div>

                                            <div class="mb-3">
                                                <span class="inline-block px-3 py-1 bg-primary-50 text-primary-700 rounded-lg text-xs font-bold border border-primary-100">
                                                    {{ $jadwal->date_range }}
                                                </span>
                                            </div>
                                            <h3 class="text-lg font-bold text-neutral-900 mb-2 group-hover:text-primary-700 transition-colors">{{ $jadwal->title }}</h3>
                                            <p class="text-neutral-500 text-sm leading-relaxed">{{ $jadwal->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Mobile Timeline (Vertical) --}}
                <div class="lg:hidden">
                    <div class="relative pl-6">
                        {{-- Vertical Line --}}
                        <div class="absolute left-[27px] top-0 bottom-0 w-1 bg-neutral-200 rounded-full"></div>
                        
                        <div class="space-y-8">
                            @foreach($jadwals as $jadwal)
                                <div class="relative flex items-start group">
                                    {{-- Dot --}}
                                    <div class="absolute left-0 top-0 w-14 h-14 flex items-center justify-center bg-white z-10">
                                        <div class="w-5 h-5 rounded-full bg-primary-500 border-2 border-white shadow-md ring-4 ring-primary-50"></div>
                                    </div>
                                    
                                    {{-- Content --}}
                                    <div class="ml-16 flex-1">
                                        <div class="bg-white rounded-2xl p-5 border border-neutral-200 shadow-sm hover:border-primary-200 transition-colors duration-300 relative">
                                            <div class="absolute top-5 -left-1.5 w-3 h-3 bg-white border-b border-l border-neutral-200 transform rotate-45"></div>
                                            
                                            <div class="mb-3">
                                                <span class="inline-block px-3 py-1 bg-primary-50 text-primary-700 rounded-lg text-xs font-bold border border-primary-100">
                                                    {{ $jadwal->date_range }}
                                                </span>
                                            </div>
                                            <h3 class="text-lg font-bold text-neutral-900 mb-1">{{ $jadwal->title }}</h3>
                                            <p class="text-neutral-500 text-sm leading-relaxed">{{ $jadwal->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            @else
                {{-- Empty State --}}
                <div class="text-center py-16 bg-neutral-50 rounded-3xl border border-neutral-100">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm border border-neutral-100">
                        <i class="fa-regular fa-calendar-xmark text-3xl text-neutral-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-neutral-900 mb-2">Jadwal Belum Tersedia</h3>
                    <p class="text-neutral-500 max-w-md mx-auto">
                        Informasi jadwal pendaftaran akan diumumkan dalam waktu dekat oleh panitia.
                    </p>
                </div>
            @endif
            
            {{-- Back Button --}}
            <div class="text-center mt-16 pt-8 border-t border-neutral-100">
                <a href="{{ route('home') }}" class="inline-flex items-center text-neutral-500 hover:text-primary-600 transition-colors font-bold group text-sm">
                    <i class="fa-solid fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </section>

@endsection