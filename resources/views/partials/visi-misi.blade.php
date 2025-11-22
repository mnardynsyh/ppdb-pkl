@extends('layouts.app')

@section('title', 'Visi & Misi')

@section('content')

<section class="min-h-screen bg-white py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-12">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-3">Visi & Misi</h1>
            <p class="text-lg sm:text-xl text-gray-600">Arah dan Tujuan Kami dalam Mencetak Generasi Unggul</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            {{-- Visi --}}
            <div class="group">
                <div class="bg-blue-50 rounded-2xl p-8 border border-blue-100 shadow-sm hover:shadow-md transition-all duration-300 h-full flex flex-col text-center relative overflow-hidden">
                    {{-- Dekorasi Background --}}
                    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-32 h-32 bg-blue-100 rounded-full opacity-50 blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                    
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-sm relative z-10">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 relative z-10">Visi Sekolah</h3>
                    
                    <div class="flex-1 flex items-center justify-center relative z-10">
                        <p class="text-xl font-serif italic text-blue-900 leading-relaxed">
                            "Terwujudnya Lulusan yang Berimtaq, Beriptek, Berkarakter, dan Berwawasan Lingkungan."
                        </p>
                    </div>
                </div>
            </div>

            {{-- Misi --}}
            <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-sm hover:shadow-md transition-shadow h-full">
                <div class="flex items-center mb-8">
                    <div class="w-12 h-12 bg-gray-900 rounded-xl flex items-center justify-center mr-4 shadow-lg transform -rotate-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">Misi Sekolah</h3>
                </div>
                
                <ul class="space-y-5">
                    @php
                        $misis = [
                            'Melaksanakan pembelajaran dan bimbingan secara efektif untuk mengoptimalkan potensi akademik siswa.',
                            'Menumbuhkan semangat keunggulan dan kompetisi sehat secara intensif kepada seluruh warga sekolah.',
                            'Mendorong dan membantu setiap siswa untuk mengenali dan mengembangkan potensi dirinya.',
                            'Menerapkan manajemen partisipatif dengan melibatkan seluruh warga sekolah dan komite.',
                            'Mewujudkan lingkungan sekolah yang bersih, asri, nyaman, dan kondusif untuk belajar.'
                        ];
                    @endphp
                    
                    @foreach($misis as $index => $misi)
                    <li class="flex items-start group">
                        <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 font-bold text-xs mr-4 mt-0.5 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            {{ $index + 1 }}
                        </span>
                        <span class="text-gray-600 leading-relaxed group-hover:text-gray-900 transition-colors">{{ $misi }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Back Button --}}
        <div class="text-center mt-12 pt-8 border-t border-gray-200">
            <a href="{{ route('home') }}" class="inline-flex items-center text-gray-600 hover:text-blue-600 transition-colors font-medium group">
                <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>

@endsection