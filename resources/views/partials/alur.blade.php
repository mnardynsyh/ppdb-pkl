{{-- Section Alur Pendaftaran --}}
<section class="bg-white py-16" id="alur">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800">Alur Pendaftaran</h2>
            <p class="text-gray-500 mt-2">Ikuti lima langkah mudah untuk menjadi bagian dari kami.</p>
        </div>

        <div class="flex flex-col md:flex-row items-start md:items-stretch justify-center">

            @php
                $steps = [
                    ['delay' => 100, 'title' => '1. Buat Akun & Isi Formulir', 'description' => 'Daftarkan akun Anda, lalu lengkapi formulir dengan data yang valid.', 'icon' => '<svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>'],
                    ['delay' => 200, 'title' => '2. Unggah Berkas', 'description' => 'Unggah semua dokumen persyaratan yang diperlukan.', 'icon' => '<svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>'],
                    ['delay' => 300, 'title' => '3. Verifikasi Panitia', 'description' => 'Tim kami akan memeriksa kelengkapan dan keabsahan data Anda.', 'icon' => '<svg class="w-10 h-10 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'],
                    ['delay' => 400, 'title' => '4. Lihat Pengumuman', 'description' => 'Hasil seleksi diumumkan secara online melalui dashboard siswa.', 'icon' => '<svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-2.236 9.168-5.5M17 18a2 2 0 100-4m-8-4a2 2 0 100-4m0 4a2 2 0 100-4"></path></svg>'],
                    ['delay' => 500, 'title' => '5. Daftar Ulang', 'description' => 'Siswa yang lolos wajib daftar ulang di sekolah dengan berkas asli.', 'icon' => '<svg class="w-10 h-10 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>'],
                ];
            @endphp
            
            @foreach ($steps as $step)
                {{-- Card Langkah --}}
                <div class="relative flex flex-col items-center p-6 text-center w-full md:w-1/5 mb-8 md:mb-0" data-aos="fade-up" data-aos-delay="{{ $step['delay'] }}">
                    <div class="mb-4 w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center shadow-inner">
                        {!! $step['icon'] !!}
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ $step['title'] }}</h3>
                    <p class="mt-2 text-gray-600 text-sm">{{ $step['description'] }}</p>
                </div>

                {{-- Konektor (Chevron) untuk Desktop --}}
                @if (!$loop->last)
                    <div class="hidden md:flex items-center text-gray-300 mx-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

