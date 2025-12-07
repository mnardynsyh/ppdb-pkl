<section class="relative bg-white py-24 lg:py-24 overflow-hidden" id="persyaratan">
    
    <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/3 w-[600px] h-[600px] bg-primary-50/40 rounded-full blur-3xl -z-10 opacity-60"></div>
    <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/3 w-[600px] h-[600px] bg-neutral-100/60 rounded-full blur-3xl -z-10"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-20" data-aos="fade-up">
            <h2 class="text-3xl lg:text-4xl font-extrabold text-neutral-900 tracking-tight mb-4">
                Persyaratan Pendaftaran
            </h2>
            <p class="text-lg text-neutral-500 leading-relaxed">
                Mohon siapkan dokumen digital (PDF/Foto) berikut untuk kelancaran proses verifikasi data Anda.
            </p>
        </div>

        @php
            $dokumenWajib = [
                [
                    'title' => 'Kartu Keluarga (KK)', 
                    'description' => 'Scan asli atau fotokopi legalisir. Pastikan NIK calon siswa terbaca jelas.', 
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 20h5v-2a3 3 0 0 0-5.36-1.85M17 20H7m10 0v-2c0-.65-.12-1.28-.35-1.85m0 0a5 5 0 0 1 9.28 0M15 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM4 20h2.5a1.5 1.5 0 0 0 1.5-1.5v-2.5a1.5 1.5 0 0 0-1.5-1.5H4a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1Z"/></svg>'
                ],
                [
                    'title' => 'Akta Kelahiran', 
                    'description' => 'Scan dokumen asli Akta Kelahiran untuk validasi data usia dan orang tua.', 
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 7V5c0-1.1.9-2 2-2h4c1.1 0 2 .9 2 2v2"/><path d="M12 22a4 4 0 0 0 4-4v-1a2 2 0 0 0-2-2H10a2 2 0 0 0-2 2v1a4 4 0 0 0 4 4Z"/><path d="M12 7h.01"/></svg>'
                ],
                [
                    'title' => 'Ijazah / SKL', 
                    'description' => 'Scan Ijazah atau Surat Keterangan Lulus (SKL) dari sekolah asal.', 
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10.2V16a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-5.8"/><path d="M16 2a2 2 0 0 1 2 2v2"/><path d="M8 2a2 2 0 0 0-2 2v2"/><path d="M12 10a2 2 0 0 0-1 1.73v.54a2 2 0 0 0 2 0v-.54A2 2 0 0 0 12 10Z"/></svg>'
                ],
                [
                    'title' => 'Pas Foto', 
                    'description' => 'Foto formal terbaru ukuran 3x4, latar belakang merah/biru, wajah terlihat jelas.', 
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>'
                ],
                [
                    'title' => 'KTP Orang Tua', 
                    'description' => 'Scan KTP Ayah dan Ibu atau Wali yang bertanggung jawab atas siswa.', 
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>'
                ],
            ];
        @endphp

        <div class="mb-20">
            <div class="flex items-center gap-4 mb-10">
                <div class="h-px flex-1 bg-neutral-200"></div>
                <h3 class="text-lg font-bold text-neutral-500 uppercase tracking-widest flex items-center gap-3">
                    <span class="w-2 h-2 bg-primary-500 rounded-full"></span>
                    Dokumen Wajib
                </h3>
                <div class="h-px flex-1 bg-neutral-200"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($dokumenWajib as $index => $item)
                    <div class="group relative bg-white p-6 rounded-2xl border border-neutral-200 shadow-[0_2px_10px_rgb(0,0,0,0.02)] hover:border-primary-200 hover:shadow-[0_10px_30px_rgb(0,0,0,0.06)] hover:-translate-y-1 transition-all duration-300" 
                         data-aos="fade-up" 
                         data-aos-delay="{{ $index * 100 }}">
                        
                        <div class="flex items-start gap-5">
                            <div class="flex-shrink-0 w-12 h-12 bg-neutral-50 text-neutral-400 rounded-xl flex items-center justify-center border border-neutral-100 group-hover:bg-primary-50 group-hover:text-primary-600 group-hover:border-primary-100 transition-colors duration-300">
                                {!! $item['icon'] !!}
                            </div>
                            
                            <div>
                                <h4 class="text-lg font-bold text-neutral-900 mb-2 group-hover:text-primary-700 transition-colors">
                                    {{ $item['title'] }}
                                </h4>
                                <p class="text-sm text-neutral-500 leading-relaxed">
                                    {{ $item['description'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <div>
            <div class="flex items-center gap-4 mb-10">
                <div class="h-px flex-1 bg-neutral-200"></div>
                <h3 class="text-lg font-bold text-neutral-500 uppercase tracking-widest flex items-center gap-3">
                    <span class="w-2 h-2 bg-primary-500 rounded-full"></span>
                    Dokumen Pendukung
                </h3>
                <div class="h-px flex-1 bg-neutral-200"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="bg-white p-8 rounded-2xl border border-neutral-200 shadow-sm hover:border-yellow-200 hover:shadow-lg hover:shadow-yellow-100/50 transition-all duration-300 group h-full" 
                     data-aos="fade-up" 
                     data-aos-delay="100">
                    
                    <h4 class="text-xl font-bold text-neutral-900 mb-1">Jalur Afirmasi</h4>
                    <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-6 pb-4 border-b border-neutral-100">
                        Keluarga Kurang Mampu
                    </p>
                    <ul class="space-y-3">
                        <li class="flex gap-3 text-sm text-neutral-600">
                            <i class="fa-solid fa-check text-yellow-500 mt-1 flex-shrink-0"></i>
                            <span>Kartu KIP / PKH / KKS (Salah satu)</span>
                        </li>
                        <li class="flex gap-3 text-sm text-neutral-600">
                            <i class="fa-solid fa-check text-yellow-500 mt-1 flex-shrink-0"></i>
                            <span>Atau SKTM Asli dari Kelurahan</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-neutral-200 shadow-sm hover:border-primary-200 hover:shadow-lg hover:shadow-primary-100/50 transition-all duration-300 group h-full" 
                     data-aos="fade-up" 
                     data-aos-delay="200">
                    
                    <h4 class="text-xl font-bold text-neutral-900 mb-1">Jalur Prestasi</h4>
                    <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-6 pb-4 border-b border-neutral-100">
                        Akademik & Non-Akademik
                    </p>
                    <ul class="space-y-3">
                        <li class="flex gap-3 text-sm text-neutral-600">
                            <i class="fa-solid fa-check text-primary-500 mt-1 flex-shrink-0"></i>
                            <span>Sertifikat Juara (Min. Tingkat Kab/Kota)</span>
                        </li>
                        <li class="flex gap-3 text-sm text-neutral-600">
                            <i class="fa-solid fa-check text-primary-500 mt-1 flex-shrink-0"></i>
                            <span>Rapor Semester 1 s.d 5 (Legalisir)</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-neutral-200 shadow-sm hover:border-blue-200 hover:shadow-lg hover:shadow-blue-100/50 transition-all duration-300 group h-full" 
                      data-aos="fade-up" 
                      data-aos-delay="300">
                    
                    <h4 class="text-xl font-bold text-neutral-900 mb-1">Pindah Tugas</h4>
                    <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-6 pb-4 border-b border-neutral-100">
                        Orang Tua / Wali
                    </p>
                    <ul class="space-y-3">
                        <li class="flex gap-3 text-sm text-neutral-600">
                            <i class="fa-solid fa-check text-blue-500 mt-1 flex-shrink-0"></i>
                            <span>SK Pindah Tugas Orang Tua</span>
                        </li>
                        <li class="flex gap-3 text-sm text-neutral-600">
                            <i class="fa-solid fa-check text-blue-500 mt-1 flex-shrink-0"></i>
                            <span>Surat Keterangan Domisili</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</section>