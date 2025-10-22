@extends('layouts.app')

@section('title', 'Kontak Kami')

@section('content')

<section class="bg-white py-16">
    <div class="max-w-screen-lg mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-down">
            <h1 class="text-4xl font-bold text-gray-800">Hubungi Kami</h1>
            <p class="text-gray-500 mt-2">Kami siap membantu menjawab pertanyaan Anda seputar pendaftaran.</p>
        </div>

        {{-- Kontainer Utama (satu kolom) --}}
        <div class="space-y-8" data-aos="fade-up">

            {{-- Kartu Informasi Kontak --}}
            <div class="bg-gray-50 p-8 rounded-lg border border-gray-100">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Informasi Kontak</h3>
                <div class="space-y-6">
                    {{-- [DIPERBARUI] Mengambil data dari variabel $pengaturan --}}
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-900">Alamat Sekolah</h4>
                            <p class="text-gray-600">{{ $pengaturan->alamat_sekolah ?? 'Alamat belum diatur oleh admin.' }}</p>
                        </div>
                    </div>
                    {{-- Email --}}
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-900">Email Panitia</h4>
                            <p class="text-gray-600">{{ $pengaturan->email_kontak ?? 'Email belum diatur oleh admin.' }}</p>
                        </div>
                    </div>
                    {{-- Telepon --}}
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-900">Telepon</h4>
                            <p class="text-gray-600">{{ $pengaturan->telepon ?? 'Telepon belum diatur oleh admin.' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Peta Lokasi --}}
            <div data-aos="fade-up" data-aos-delay="100">
                <iframe 
                    class="w-full h-96 rounded-lg shadow-md border"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.2741246168994!2d109.08392747416322!3d-7.209536570779387!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f8e218543313b%3A0x2605c8c12486ea4b!2sSMP%20Muhammadiyah%201%20Sirampog!5e0!3m2!1sen!2sid!4v1761137687088!5m2!1sen!2sid" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</section>

@include('partials.footer')

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
{{-- Menambahkan AlpineJS Collapse Plugin untuk animasi FAQ --}}
<script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
<script>
  AOS.init({
    duration: 800,
    once: true
  });
</script>

@endsection

