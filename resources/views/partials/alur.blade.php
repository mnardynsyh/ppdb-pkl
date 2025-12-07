{{-- Section Alur Pendaftaran --}}
<section class="bg-neutral-50 py-24 lg:py-24 relative overflow-hidden" id="alur">

    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        {{-- Header Section --}}
        <div class="text-center max-w-3xl mx-auto mb-20" data-aos="fade-up">
            <h2 class="text-3xl lg:text-4xl font-extrabold text-neutral-900 tracking-tight mb-4">
                Alur Pendaftaran Siswa Baru
            </h2>
            <p class="text-neutral-500 text-lg leading-relaxed">
                Ikuti 5 langkah berikut untuk bergabung menjadi bagian dari sekolah kami.
            </p>
        </div>

        @php
            $steps = [
                [
                    'nomor' => '01', 
                    'title' => 'Buat Akun', 
                    'description' => 'Registrasi akun siswa baru untuk mengakses dashboard pendaftaran.', 
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" x2="20" y1="8" y2="14"/><line x1="23" x2="17" y1="11" y2="11"/></svg>'
                ],
                [
                    'nomor' => '02', 
                    'title' => 'Lengkapi Data', 
                    'description' => 'Isi biodata diri, data orang tua, dan sekolah asal secara lengkap.', 
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22h6a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v10"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10.4 12.6a2 2 0 1 1 3 3L8 21l-4 1 1-4Z"/></svg>'
                ],
                [
                    'nomor' => '03', 
                    'title' => 'Unggah Berkas', 
                    'description' => 'Upload dokumen wajib seperti KK, Akta, dan Ijazah/SKL.', 
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>'
                ],
                [
                    'nomor' => '04', 
                    'title' => 'Verifikasi', 
                    'description' => 'Panitia akan memeriksa validitas data. Pantau status di dashboard.', 
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'
                ],
                [
                    'nomor' => '05', 
                    'title' => 'Daftar Ulang', 
                    'description' => 'Jika dinyatakan diterima, segera lakukan daftar ulang.', 
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>'
                ],
            ];
        @endphp

        <div class="hidden lg:flex items-start justify-between relative">
            
            @foreach ($steps as $step)
                {{-- Item Wrapper --}}
                <div class="relative flex flex-col items-center flex-1 group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    
                    {{-- Icon Container --}}
                    <div class="relative z-10 mb-6 transition-transform duration-300 group-hover:-translate-y-2">
                        <div class="w-20 h-20 rounded-2xl bg-white border border-neutral-200 shadow-[0_8px_30px_rgb(0,0,0,0.04)] flex items-center justify-center text-neutral-400 group-hover:text-primary-600 group-hover:border-primary-100 group-hover:shadow-[0_8px_30px_rgb(13,148,136,0.15)] transition-all duration-300">
                            {!! $step['icon'] !!}
                        </div>
                        
                        {{-- Badge Nomor --}}
                        <div class="absolute -top-3 -right-3 w-8 h-8 rounded-lg bg-primary-600 text-white flex items-center justify-center font-bold text-xs shadow-md group-hover:bg-primary-800 transition-colors duration-300">
                            {{ $step['nomor'] }}
                        </div>
                    </div>

                    {{-- Text Content --}}
                    <div class="text-center px-2">
                        <h3 class="text-lg font-bold text-neutral-900 mb-2 group-hover:text-primary-700 transition-colors">
                            {{ $step['title'] }}
                        </h3>
                        <p class="text-sm text-neutral-500 leading-relaxed max-w-[200px] mx-auto">
                            {{ $step['description'] }}
                        </p>
                    </div>

                    {{-- Connector Arrow (Kecuali item terakhir) --}}
                    @if (!$loop->last)
                        <div class="absolute top-8 -right-[50%] w-full flex justify-center items-center pointer-events-none opacity-30">
                            <svg class="w-6 h-6 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </div>
                    @endif

                </div>
            @endforeach
        </div>

        <div class="lg:hidden space-y-4">
             @foreach ($steps as $step)
                <div class="flex items-center gap-5 p-5 bg-white rounded-2xl border border-neutral-100 shadow-sm hover:border-primary-200 transition-colors" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    
                    {{-- Icon Mobile --}}
                    <div class="flex-shrink-0 relative">
                        <div class="w-14 h-14 rounded-xl bg-primary-50 flex items-center justify-center text-primary-600 border border-primary-100">
                            {!! $step['icon'] !!}
                        </div>
                    </div>

                    {{-- Text Mobile --}}
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-1">
                            <h3 class="text-base font-bold text-neutral-900">{{ $step['title'] }}</h3>
                            <span class="text-xs font-bold text-primary-600 bg-primary-50 px-2 py-0.5 rounded border border-primary-100">
                                {{ $step['nomor'] }}
                            </span>
                        </div>
                        <p class="text-xs text-neutral-500 leading-relaxed">
                            {{ $step['description'] }}
                        </p>
                    </div>
                </div>
             @endforeach
        </div>

    </div>
</section>