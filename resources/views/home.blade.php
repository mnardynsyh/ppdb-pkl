@extends('layouts.app')

@section('title', 'PPDB Online')

@section('content')

<!-- Modern Carousel Section dengan Animasi Slide Saja -->
<section class="relative w-full" x-data="carousel()" style="font-family: 'Poppins', sans-serif;">
    <!-- Carousel wrapper -->
    <div class="relative h-[90vh] overflow-hidden rounded-b-2xl">
        <!-- Item 1: Selamat Datang -->
        <div x-show="activeSlide === 0" x-transition:enter="transition ease-out duration-500" 
             x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-300" 
             x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-full"
             class="absolute inset-0">
            <img src="{{asset('img/school.png')}}" class="absolute block w-full h-full object-cover" alt="Kegiatan Belajar Mengajar">
            <!-- Layer hitam dengan opacity -->
            <div class="absolute inset-0 bg-black/60"></div>
            
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center text-white px-4 sm:px-6 max-w-4xl mx-auto w-full">
                    <h1 class="mb-4 text-3xl sm:text-4xl md:text-5xl font-black leading-tight">
                        Selamat Datang di PPDB 
                        <span class="block bg-gradient-to-r from-cyan-300 to-blue-300 bg-clip-text text-transparent mt-3 pt-1">
                            SMP Negeri Unggulan Kami
                        </span>
                    </h1>
                    <p class="mb-8 text-base sm:text-lg md:text-xl font-normal text-slate-200 leading-relaxed max-w-2xl mx-auto px-4">
                        Daftarkan dirimu sekarang untuk bergabung bersama sekolah unggulan kami! 
                        Raih masa depan gemilang melalui pendidikan berkualitas.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="{{ route('register.siswa') }}" 
                           class="inline-flex items-center justify-center px-6 py-3 sm:px-7 sm:py-3.5 text-sm sm:text-base font-semibold text-white rounded-lg bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:ring-4 focus:ring-blue-300 transition-all duration-300">
                            Daftar Sekarang
                            <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="{{ route('jadwal')}}" 
                           class="inline-flex items-center justify-center px-6 py-3 sm:px-7 sm:py-3.5 text-sm sm:text-base font-semibold text-white bg-white/20 backdrop-blur-sm rounded-lg border border-white/30 hover:bg-white/30 hover:border-white/50 focus:ring-4 focus:ring-white/30 transition-all duration-300">
                            Lihat Jadwal
                        </a> 
                    </div>
                </div>
            </div>
        </div>

        <!-- Item 2: Ekstrakurikuler -->
        <div x-show="activeSlide === 1" x-transition:enter="transition ease-out duration-500" 
             x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-300" 
             x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-full"
             class="absolute inset-0">
            <img src="{{asset('img/slider-2.jpg')}}" class="absolute block w-full h-full object-cover" alt="Ekstrakurikuler">
            <!-- Layer hitam dengan opacity -->
            <div class="absolute inset-0 bg-black/60"></div>
            
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center text-white px-4 sm:px-6 max-w-4xl mx-auto w-full">
                    <h1 class="mb-4 text-3xl sm:text-4xl md:text-5xl font-black leading-tight">
                        Kembangkan Bakat & Minat
                        <span class="block bg-gradient-to-r from-amber-300 to-orange-300 bg-clip-text text-transparent mt-3 pt-1">
                            Melalui Ekstrakurikuler
                        </span>
                    </h1>
                    <p class="mb-8 text-base sm:text-lg md:text-xl font-normal text-slate-200 leading-relaxed max-w-2xl mx-auto px-4">
                        Berbagai pilihan kegiatan untuk menunjang prestasi non-akademik siswa 
                        dan mengasah kreativitas serta leadership.
                    </p>
                </div>
            </div>
        </div>

        <!-- Item 3: Fasilitas -->
        <div x-show="activeSlide === 2" x-transition:enter="transition ease-out duration-500" 
             x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-300" 
             x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-full"
             class="absolute inset-0">
            <img src="{{asset('img/slider-3.jpg')}}" class="absolute block w-full h-full object-cover" alt="Fasilitas Sekolah">
            <!-- Layer hitam dengan opacity -->
            <div class="absolute inset-0 bg-black/60"></div>
            
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center text-white px-4 sm:px-6 max-w-4xl mx-auto w-full">
                    <h1 class="mb-4 text-3xl sm:text-4xl md:text-5xl font-black leading-tight">
                        Didukung Fasilitas Modern
                        <span class="block bg-gradient-to-r from-emerald-300 to-teal-300 bg-clip-text text-transparent mt-3 pt-1">
                            & Lingkungan Belajar Nyaman
                        </span>
                    </h1>
                    <p class="mb-8 text-base sm:text-lg md:text-xl font-normal text-slate-200 leading-relaxed max-w-2xl mx-auto px-4">
                        Laboratorium canggih, perpustakaan digital, dan sarana olahraga lengkap 
                        untuk mendukung proses belajar mengajar optimal.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Slider indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-6 sm:bottom-8 left-1/2 space-x-2">
        <button type="button" @click="goToSlide(0)" 
                :class="activeSlide === 0 ? 'w-8 bg-white' : 'w-3 bg-white/50 hover:bg-white'"
                class="h-2 rounded-full transition-all duration-300" 
                aria-current="true" 
                aria-label="Slide 1"></button>
        <button type="button" @click="goToSlide(1)" 
                :class="activeSlide === 1 ? 'w-8 bg-white' : 'w-3 bg-white/50 hover:bg-white'"
                class="h-2 rounded-full transition-all duration-300" 
                aria-current="false" 
                aria-label="Slide 2"></button>
        <button type="button" @click="goToSlide(2)" 
                :class="activeSlide === 2 ? 'w-8 bg-white' : 'w-3 bg-white/50 hover:bg-white'"
                class="h-2 rounded-full transition-all duration-300" 
                aria-current="false" 
                aria-label="Slide 3"></button>
    </div>

    <!-- Slider controls -->
    <button type="button" @click="prevSlide()" 
            class="absolute top-1/2 left-4 sm:left-6 z-30 flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 transform -translate-y-1/2 cursor-pointer group focus:outline-none">
        <span class="inline-flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white/20 backdrop-blur-sm group-hover:bg-white/30 group-focus:ring-2 group-focus:ring-white/30 transition-all duration-300 border border-white/30">
            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" @click="nextSlide()" 
            class="absolute top-1/2 right-4 sm:right-6 z-30 flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 transform -translate-y-1/2 cursor-pointer group focus:outline-none">
        <span class="inline-flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white/20 backdrop-blur-sm group-hover:bg-white/30 group-focus:ring-2 group-focus:ring-white/30 transition-all duration-300 border border-white/30">
            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</section>

@include('partials.alur')
@include('partials.persyaratan')
@include('partials.faq')
@include('partials.footer')

<script>
function carousel() {
    return {
        activeSlide: 0,
        totalSlides: 3,
        interval: null,
        
        init() {
            this.startAutoPlay();
        },
        
        nextSlide() {
            this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
            this.restartAutoPlay();
        },
        
        prevSlide() {
            this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides;
            this.restartAutoPlay();
        },
        
        goToSlide(index) {
            this.activeSlide = index;
            this.restartAutoPlay();
        },
        
        startAutoPlay() {
            this.interval = setInterval(() => {
                this.nextSlide();
            }, 5000);
        },
        
        restartAutoPlay() {
            clearInterval(this.interval);
            this.startAutoPlay();
        }
    }
}
</script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 800,
    once: true
  });
</script>

@endsection