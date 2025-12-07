@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')

<section class="bg-white py-20 lg:py-28" id="about">
    <div class="max-w-6xl mx-auto px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold text-neutral-900 mb-4">Tentang Kami</h2>
            <p class="text-lg text-neutral-600 max-w-2xl mx-auto">Perjalanan dan dedikasi kami dalam mencerdaskan kehidupan bangsa melalui pendidikan berkualitas.</p>
        </div>

        <div class="bg-white rounded-3xl p-8 lg:p-12 border border-neutral-200 shadow-xl shadow-neutral-100/50">
            <div class="flex flex-col lg:flex-row items-start gap-12">
                
                {{-- Image Placeholder --}}
                <div class="w-full lg:w-1/3 flex-shrink-0">
                    <div class="aspect-[4/5] bg-primary-50 rounded-2xl flex items-center justify-center border border-primary-100 overflow-hidden relative group">
                        <svg class="w-24 h-24 text-primary-200 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-primary-900/60 to-transparent p-6">
                            <p class="text-white font-medium text-center">Gedung Utama</p>
                        </div>
                    </div>
                </div>

                {{-- Text Content --}}
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="w-12 h-1 bg-primary-600 rounded-full"></span>
                        <h3 class="text-2xl font-bold text-neutral-900">Sejarah Singkat</h3>
                    </div>
                    
                    <div class="prose prose-lg prose-neutral text-neutral-600 leading-relaxed space-y-5 text-justify">
                        <p>
                            Sekolah kami didirikan dengan visi mulia untuk membentuk generasi muda yang tidak hanya cerdas secara intelektual, tetapi juga memiliki karakter yang kuat dan berakhlak mulia.
                        </p>
                        <p>
                            Kami percaya bahwa pendidikan adalah kunci utama perubahan. Dengan kurikulum yang adaptif dan fasilitas modern, kami berkomitmen menciptakan lingkungan belajar yang inklusif dan inspiratif.
                        </p>
                        <p class="p-4 bg-primary-50 rounded-xl border-l-4 border-primary-500 text-primary-800 font-medium">
                            Berlokasi strategis di {{ $global_pengaturan->alamat_sekolah ?? 'pusat kota' }}, kami siap menjadi mitra terbaik orang tua dalam mendidik putra-putri bangsa.
                        </p>
                    </div>

                    <div class="mt-8 pt-8 border-t border-neutral-100">
                        <a href="{{ route('visiMisi') }}" class="inline-flex items-center font-bold text-primary-600 hover:text-primary-800 transition-colors group">
                            Lihat Visi & Misi Kami
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection