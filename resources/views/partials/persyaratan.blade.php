{{-- Section Persyaratan Pendaftaran --}}
<section class="bg-slate-50 py-28" id="persyaratan">
    <div class="max-w-screen-xl mx-auto px-4">
        {{-- Header Section --}}
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-extrabold text-slate-900">Persyaratan Pendaftaran</h2>
            <p class="text-slate-600 mt-2 max-w-2xl mx-auto">Pastikan Anda telah menyiapkan semua dokumen yang diperlukan untuk kelancaran proses pendaftaran.</p>
        </div>

        @php
            // Daftar dokumen wajib dengan ikon yang lebih spesifik
            $dokumenWajib = [
                ['title' => 'Kartu Keluarga (KK)', 'description' => 'Pastikan nama calon siswa dan orang tua tercantum dengan jelas.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 20h5v-2a3 3 0 0 0-5.36-1.85M17 20H7m10 0v-2c0-.65-.12-1.28-.35-1.85m0 0a5 5 0 0 1 9.28 0M15 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM4 20h2.5a1.5 1.5 0 0 0 1.5-1.5v-2.5a1.5 1.5 0 0 0-1.5-1.5H4a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1Z"/></svg>'],
                ['title' => 'Akta Kelahiran', 'description' => 'Untuk verifikasi usia dan nama lengkap calon siswa.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 7V5c0-1.1.9-2 2-2h4c1.1 0 2 .9 2 2v2"/><path d="M12 22a4 4 0 0 0 4-4v-1a2 2 0 0 0-2-2H10a2 2 0 0 0-2 2v1a4 4 0 0 0 4 4Z"/><path d="M12 7h.01"/></svg>'],
                ['title' => 'Ijazah / SKL', 'description' => 'Scan Ijazah atau Surat Keterangan Lulus dari sekolah asal.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10.2V16a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-5.8"/><path d="M16 2a2 2 0 0 1 2 2v2"/><path d="M8 2a2 2 0 0 0-2 2v2"/><path d="M12 10a2 2 0 0 0-1 1.73v.54a2 2 0 0 0 2 0v-.54A2 2 0 0 0 12 10Z"/></svg>'],
                ['title' => 'Pas Foto', 'description' => 'File pas foto formal terbaru dengan latar belakang merah (ukuran 3x4).', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>'],
                ['title' => 'KTP Orang Tua/Wali', 'description' => 'Scan KTP Ayah dan Ibu atau Wali yang bertanggung jawab.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>'],
            ];
        @endphp

        {{-- === Bagian 1: Persyaratan Wajib === --}}
        <div class="mb-16">
            <h3 class="text-2xl font-bold text-center text-slate-800 mb-10" data-aos="fade-up">Dokumen Wajib (Semua Jalur)</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($dokumenWajib as $item)
                    <div class="bg-white p-6 rounded-lg shadow-lg border border-slate-200 flex items-start space-x-5 transition-transform duration-300 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                            {!! $item['icon'] !!}
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-slate-800">{{ $item['title'] }}</h4>
                            <p class="mt-1 text-slate-600 text-sm">{{ $item['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- === Bagian 2: Persyaratan Khusus === --}}
        <div>
            <h3 class="text-2xl font-bold text-center text-slate-800 mb-10" data-aos="fade-up">Dokumen Tambahan untuk Jalur Khusus</h3>
            <div class="max-w-4xl mx-auto space-y-6">
                <!-- Jalur Afirmasi -->
                <div class="bg-white p-6 rounded-lg shadow-lg border border-slate-200" data-aos="fade-up" data-aos-delay="100">
                    <h4 class="text-lg font-semibold text-slate-800 mb-2">Jalur Afirmasi (Siswa Kurang Mampu)</h4>
                    <ul class="list-disc list-inside space-y-1 text-sm text-slate-600 pl-2">
                        <li>Kartu Indonesia Pintar (KIP), Program Keluarga Harapan (PKH), atau Kartu Keluarga Sejahtera (KKS).</li>
                        <li>Jika tidak memiliki kartu di atas, dapat menggunakan Surat Keterangan Tidak Mampu (SKTM).</li>
                    </ul>
                </div>
                <!-- Jalur Prestasi -->
                <div class="bg-white p-6 rounded-lg shadow-lg border border-slate-200" data-aos="fade-up" data-aos-delay="150">
                    <h4 class="text-lg font-semibold text-slate-800 mb-2">Jalur Prestasi</h4>
                    <ul class="list-disc list-inside space-y-1 text-sm text-slate-600 pl-2">
                        <li>Sertifikat prestasi (akademik/non-akademik) minimal tingkat kabupaten/kota.</li>
                        <li>Nilai rapor semester 1 sampai 5 yang telah dilegalisir oleh sekolah asal.</li>
                    </ul>
                </div>
                <!-- Jalur Pindah Tugas -->
                 <div class="bg-white p-6 rounded-lg shadow-lg border border-slate-200" data-aos="fade-up" data-aos-delay="200">
                    <h4 class="text-lg font-semibold text-slate-800 mb-2">Jalur Pindah Tugas Orang Tua</h4>
                    <ul class="list-disc list-inside space-y-1 text-sm text-slate-600 pl-2">
                        <li>Surat Keputusan (SK) pindah tugas orang tua/wali dari instansi terkait yang sah.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

