{{-- Section Alur Pendaftaran --}}
<section class="bg-slate-50 py-20" id="alur">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-extrabold text-slate-900">Alur Pendaftaran</h2>
            <p class="text-slate-600 mt-2 max-w-2xl mx-auto">Ikuti lima langkah mudah untuk menjadi bagian dari sekolah kami.</p>
        </div>

        @php
            $steps = [
                ['nomor' => '01', 'title' => 'Buat Akun & Isi Formulir', 'description' => 'Daftarkan akun Anda, lalu lengkapi formulir pendaftaran dengan data yang valid.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>'],
                ['nomor' => '02', 'title' => 'Unggah Berkas', 'description' => 'Unggah semua dokumen persyaratan seperti Kartu Keluarga, Ijazah, dan lainnya.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>'],
                ['nomor' => '03', 'title' => 'Verifikasi Panitia', 'description' => 'Tim panitia akan memeriksa kelengkapan dan keabsahan data serta berkas Anda.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600"><path d="M20 6 9 17l-5-5"/></svg>'],
                ['nomor' => '04', 'title' => 'Lihat Pengumuman', 'description' => 'Hasil seleksi akan diumumkan secara online melalui dasbor akun siswa.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>'],
                ['nomor' => '05', 'title' => 'Daftar Ulang', 'description' => 'Siswa yang lolos seleksi wajib melakukan daftar ulang sesuai jadwal yang ditentukan.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>'],
            ];
        @endphp

        <!-- Tampilan Desktop: Alur Horizontal -->
        <div class="hidden md:flex items-start justify-center">
            @foreach ($steps as $step)
                <div class="flex items-center w-full">
                    <!-- Kartu Langkah -->
                    <div class="flex flex-col items-center text-center px-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="relative mb-4">
                            <div class="w-20 h-20 rounded-full bg-white shadow-lg flex items-center justify-center border-2 border-slate-100">
                                {!! $step['icon'] !!}
                            </div>
                            <div class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm border-2 border-white">
                                {{ str_replace('0', '', $step['nomor']) }}
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-800">{{ $step['title'] }}</h3>
                        <p class="mt-1 text-sm text-slate-600 leading-relaxed">{{ $step['description'] }}</p>
                    </div>

                    <!-- Konektor Panah -->
                    @if (!$loop->last)
                    <div class="flex-shrink-0 px-4 text-slate-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="md:hidden space-y-10">
             @foreach ($steps as $step)
                <div class="flex items-start gap-6" data-aos="fade-left" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="flex-shrink-0 relative mt-1">
                        <div class="w-16 h-16 rounded-full bg-white shadow-md flex items-center justify-center border border-slate-100">
                            {!! $step['icon'] !!}
                        </div>
                         <div class="absolute -top-1 -right-1 w-7 h-7 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs border-2 border-slate-50">
                             {{ str_replace('0', '', $step['nomor']) }}
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">{{ $step['title'] }}</h3>
                        <p class="mt-1 text-slate-600">{{ $step['description'] }}</p>
                    </div>
                </div>
             @endforeach
        </div>
    </div>
</section>

