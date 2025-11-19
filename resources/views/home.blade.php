@extends('layouts.app')

@section('title', 'PPDB Online')

@section('content')

{{-- WRAPPER UTAMA: Menggunakan Flex Column agar footer terdorong ke bawah --}}
<div class="flex flex-col w-full min-h-screen font-sans text-slate-800 overflow-x-hidden">

    {{-- ======================================================================= --}}
    {{-- 1. HERO CAROUSEL SECTION                                                --}}
    {{-- ======================================================================= --}}
    <section class="relative w-full min-h-[100svh] lg:h-screen bg-slate-900 overflow-hidden group" 
             x-data="carousel()"
             @touchstart="handleTouchStart($event)"
             @touchend="handleTouchEnd($event)">
        
        {{-- SLIDER TRACK --}}
        <div class="absolute inset-0 w-full h-full">
            <template x-for="(slide, index) in slides" :key="index">
                <div class="absolute inset-0 w-full h-full transition-transform duration-700 ease-[cubic-bezier(0.25,1,0.5,1)]"
                     x-show="activeSlide === index"
                     x-transition:enter="transition transform ease-out duration-700"
                     x-transition:enter-start="translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transition transform ease-in duration-700"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="-translate-x-full">
                    
                    {{-- IMAGE BACKGROUND --}}
                    <img :src="slide.image" class="w-full h-full object-cover brightness-[0.6]" />
                    
                    {{-- OVERLAY GRADIENT --}}
                    <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-transparent to-black/80"></div>

                    {{-- KONTEN TEKS --}}
                    <div class="absolute inset-0 flex items-center justify-center text-center px-6 sm:px-12">
                        <div class="max-w-5xl w-full space-y-6 lg:space-y-8 mt-10 sm:mt-0">
                            
                            {{-- Badge --}}
                            <div x-show="activeSlide === index"
                                 x-transition:enter="transition ease-out duration-1000 delay-300"
                                 x-transition:enter-start="opacity-0 translate-y-4"
                                 x-transition:enter-end="opacity-100 translate-y-0">
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-white/10 border border-white/20 backdrop-blur-md text-white text-[10px] sm:text-xs font-bold tracking-widest uppercase">
                                    <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-blue-400 animate-pulse"></span>
                                    <span x-text="slide.badge"></span>
                                </span>
                            </div>

                            {{-- Judul (Responsive Size) --}}
                            <h1 class="text-3xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold text-white leading-tight tracking-tight drop-shadow-sm"
                                x-show="activeSlide === index"
                                x-transition:enter="transition ease-out duration-1000 delay-500"
                                x-transition:enter-start="opacity-0 translate-y-8"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-html="slide.title">
                            </h1>

                            {{-- Deskripsi --}}
                            <p class="text-sm sm:text-base md:text-lg lg:text-xl text-slate-200 max-w-2xl mx-auto font-light leading-relaxed px-2"
                               x-show="activeSlide === index"
                               x-transition:enter="transition ease-out duration-1000 delay-700"
                               x-transition:enter-start="opacity-0 translate-y-8"
                               x-transition:enter-end="opacity-100 translate-y-0"
                               x-text="slide.text">
                            </p>

                            {{-- Tombol --}}
                            <div class="flex flex-col sm:flex-row justify-center gap-3 sm:gap-4 pt-4 sm:pt-8 w-full px-4 sm:px-0"
                                 x-show="activeSlide === index"
                                 x-transition:enter="transition ease-out duration-1000 delay-900"
                                 x-transition:enter-start="opacity-0 translate-y-8"
                                 x-transition:enter-end="opacity-100 translate-y-0">
                                <template x-for="btn in slide.buttons">
                                    <a :href="btn.href"
                                       class="w-full sm:w-auto px-8 py-3.5 rounded-full text-sm font-bold transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center gap-2"
                                       :class="btn.isPrimary 
                                            ? 'bg-blue-600 text-white hover:bg-blue-700 shadow-lg shadow-blue-900/30' 
                                            : 'bg-transparent border-2 border-white text-white hover:bg-white hover:text-slate-900'"
                                       x-html="btn.label">
                                    </a>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        {{-- NAVIGATION ARROWS (Desktop Only) --}}
        <button @click="prevSlide()" 
                class="absolute top-1/2 left-4 sm:left-8 z-20 w-12 h-12 flex items-center justify-center rounded-full border border-white/30 text-white hover:bg-white hover:text-slate-900 transition-all -translate-y-1/2 focus:outline-none hidden lg:flex backdrop-blur-sm">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button @click="nextSlide()" 
                class="absolute top-1/2 right-4 sm:right-8 z-20 w-12 h-12 flex items-center justify-center rounded-full border border-white/30 text-white hover:bg-white hover:text-slate-900 transition-all -translate-y-1/2 focus:outline-none hidden lg:flex backdrop-blur-sm">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>

        {{-- BOTTOM INDICATORS --}}
        <div class="absolute bottom-6 sm:bottom-10 left-0 right-0 flex justify-center gap-2 sm:gap-3 z-20">
            <template x-for="(slide, index) in slides">
                <button @click="goToSlide(index)" 
                        class="h-1 sm:h-1.5 rounded-full transition-all duration-500"
                        :class="activeSlide === index ? 'w-8 sm:w-10 bg-blue-500' : 'w-2 sm:w-2 bg-white/40 hover:bg-white/80'">
                </button>
            </template>
        </div>
    </section>

    {{-- ======================================================================= --}}
    {{-- 2. CONTENT SECTIONS (Wajib relative z-20 bg-white agar menumpuk slide)  --}}
    {{-- ======================================================================= --}}
    <div class="relative z-20 bg-white w-full">
        @include('partials.alur')
        @include('partials.persyaratan')
        @include('partials.faq')
    </div>

    {{-- ======================================================================= --}}
    {{-- 3. FOOTER                                                               --}}
    {{-- ======================================================================= --}}
    @include('partials.footer')

</div>

{{-- JAVASCRIPT --}}
<script>
function carousel() {
    return {
        activeSlide: 0,
        interval: null,
        touchStartX: 0,
        touchEndX: 0,
        slides: [
            {
                image: "{{ asset('img/school.png') }}",
                badge: "PPDB 2025/2026",
                title: 'Penerimaan Peserta <br> <span class="text-blue-400">Didik Baru</span>',
                text: "Mari bergabung dengan sekolah unggulan. Pendaftaran kini dibuka secara online, mudah dan transparan.",
                buttons: [
                    { label: "Daftar Sekarang", href: "{{ route('register.siswa') }}", isPrimary: true },
                    { label: "Lihat Jadwal", href: "{{ route('jadwal') }}", isPrimary: false }
                ]
            },
            {
                image: "{{ asset('img/slider-2.jpg') }}",
                badge: "Ekstrakurikuler",
                title: 'Kembangkan Bakat <br> <span class="text-orange-400">Non-Akademik</span>',
                text: "Tersedia berbagai pilihan kegiatan untuk menyalurkan hobi, bakat, dan kepemimpinan siswa.",
                buttons: [] 
            },
            {
                image: "{{ asset('img/slider-3.jpg') }}",
                badge: "Fasilitas Sekolah",
                title: 'Sarana Belajar <br> <span class="text-emerald-400">Modern & Lengkap</span>',
                text: "Lingkungan belajar yang nyaman didukung teknologi terkini untuk prestasi maksimal.",
                buttons: [] 
            }
        ],
        
        init() {
            this.startAutoPlay();
        },

        // Touch Event Handlers
        handleTouchStart(e) {
            this.touchStartX = e.changedTouches[0].screenX;
        },
        
        handleTouchEnd(e) {
            this.touchEndX = e.changedTouches[0].screenX;
            this.handleSwipe();
        },
        
        handleSwipe() {
            // Swipe ke Kiri (Next)
            if (this.touchEndX < this.touchStartX - 50) {
                this.nextSlide();
            }
            // Swipe ke Kanan (Prev)
            if (this.touchEndX > this.touchStartX + 50) {
                this.prevSlide();
            }
        },
        
        nextSlide() {
            this.activeSlide = (this.activeSlide + 1) % this.slides.length;
            this.restartAutoPlay();
        },
        
        prevSlide() {
            this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length;
            this.restartAutoPlay();
        },
        
        goToSlide(index) {
            this.activeSlide = index;
            this.restartAutoPlay();
        },
        
        startAutoPlay() {
            this.interval = setInterval(() => {
                this.nextSlide();
            }, 6000); 
        },
        
        restartAutoPlay() {
            clearInterval(this.interval);
            this.startAutoPlay();
        }
    }
}
</script>

{{-- AOS Initialization (Jika diperlukan) --}}
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ duration: 800, once: true, offset: 50 });
</script>

@endsection