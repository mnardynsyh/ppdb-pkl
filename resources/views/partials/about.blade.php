@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')

<section class="min-h-screen bg-white py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-12">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-3">Tentang Kami</h1>
            <p class="text-lg sm:text-xl text-gray-600">Perjalanan dan Dedikasi Kami dalam Dunia Pendidikan</p>
        </div>

        {{-- Sejarah / Gambaran Umum --}}
        <div class="bg-white rounded-2xl p-6 sm:p-10 border border-gray-200 shadow-lg">
            <div class="flex flex-col md:flex-row items-start gap-8">
                {{-- Image Placeholder --}}
                <div class="w-full md:w-1/3 flex-shrink-0">
                    <div class="aspect-[4/5] bg-blue-50 rounded-xl flex items-center justify-center border border-blue-100 overflow-hidden relative group">
                        {{-- Icon Placeholder --}}
                        <svg class="w-20 h-20 text-blue-200 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        
                        {{-- Overlay Text (Optional) --}}
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-blue-900/50 to-transparent p-4">
                            <p class="text-white text-sm font-medium text-center">Gedung Sekolah</p>
                        </div>
                    </div>
                </div>

                {{-- Text Content --}}
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-blue-600 w-1.5 h-8 mr-3 rounded-full"></span>
                        Sejarah Singkat
                    </h2>
                    <div class="prose prose-lg prose-blue text-gray-600 leading-relaxed space-y-4 text-justify">
                        <p>
                            SMK/SMA [Nama Sekolah] didirikan dengan tujuan mulia untuk mencerdaskan kehidupan bangsa dan membentuk generasi muda yang berkarakter, kompeten, dan berdaya saing global. Perjalanan kami dimulai dari sebuah inisiatif kecil yang kini telah berkembang menjadi salah satu institusi pendidikan terpercaya.
                        </p>
                        <p>
                            Sejak awal berdirinya, kami berkomitmen teguh untuk menyelenggarakan pendidikan berkualitas. Kami percaya bahwa pendidikan bukan hanya soal aspek akademis semata, tetapi juga tentang pengembangan <em>soft skills</em>, kepemimpinan, dan penanaman nilai-nilai moral yang luhur.
                        </p>
                        <p>
                            Dengan dukungan tenaga pendidik yang profesional, kurikulum yang adaptif, serta fasilitas yang memadai, kami terus berinovasi menciptakan lingkungan belajar yang inspiratif.
                        </p>
                        <p class="font-medium text-gray-800">
                            Berlokasi di {{ $global_pengaturan->alamat_sekolah ?? 'lingkungan yang asri dan kondusif' }}, sekolah kami siap menjadi rumah kedua bagi para siswa untuk tumbuh, belajar, dan mengembangkan potensi terbaik mereka demi masa depan yang gemilang.
                        </p>
                    </div>
                </div>
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