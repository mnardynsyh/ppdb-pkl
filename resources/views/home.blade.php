@extends('layouts.app')

@section('title', 'PPDB Online')

@section('content')

<!-- Hero Section with Background Image -->
<section class="h-[89vh] relative flex items-center justify-center pt-2">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('img/school.png') }}" 
             alt="SMP Muhammadiyah 1 Sirampog" 
             class="w-full h-full object-cover">
        <!-- Overlay untuk background pink/putih cerah -->
        <div class="absolute inset-0 bg-gray-900/70"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 max-w-3xl mx-auto px-6 text-center">
        <div class="space-y-6">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full border border-white/30" data-aos="fade-down">
                <span class="w-2 h-2 bg-white rounded-full"></span>
                <span class="text-sm font-medium text-white">Tahun Ajaran 2024/2025</span>
            </div>

            <!-- Heading -->
            <div data-aos="fade-up" data-aos-delay="100">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-3">
                    PPDB Online
                </h1>
                <p class="text-2xl md:text-3xl font-semibold text-white">
                    SMP Muhammadiyah 1 Sirampog
                </p>
            </div>

            <!-- Description -->
            <p class="text-xl text-white leading-relaxed max-w-2xl mx-auto font-medium" data-aos="fade-up" data-aos-delay="200">
                Membuka pintu masa depan melalui pendidikan berkualitas. 
                Bergabunglah dengan komunitas pembelajar yang inspiratif.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center pt-4" data-aos="fade-up" data-aos-delay="300">
                <a href="{{ route('register.siswa') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3.5 rounded-lg font-bold text-lg transition-colors duration-200 shadow-lg hover:shadow-xl">
                    Daftar Sekarang
                </a>
                
                <a href="{{ route('jadwal')}}" 
                   class="bg-white/20 hover:bg-white/30 text-white border border-white/30 hover:border-white/50 px-8 py-3.5 rounded-lg font-bold text-lg transition-all duration-200 backdrop-blur-sm">
                    Lihat Jadwal
                </a>
            </div>
        </div>
    </div>
</section>

@include('partials.alur')
@include('partials.persyaratan')
@include('partials.faq')
@include('partials.footer')

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 800,
    once: true
  });
</script>

@endsection