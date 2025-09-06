{{-- Section Persyaratan Pendaftaran --}}
<section class="py-16 bg-blue-100" id="persyaratan">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800">Persyaratan Pendaftaran</h2>
            <p class="text-gray-500 mt-2">Pastikan Anda telah menyiapkan semua dokumen yang diperlukan.</p>
        </div>

        {{-- === Bagian 1: Persyaratan Wajib === --}}
        <div>
            <h3 class="text-2xl font-semibold text-center text-gray-700 mb-10">Dokumen Wajib (Semua Jalur)</h3>
            {{-- [DIPERBARUI] Menggunakan Flexbox untuk centering otomatis pada baris terakhir --}}
            <div class="flex flex-wrap justify-center gap-8">
                
                {{-- Persyaratan 1: Kartu Keluarga --}}
                <div class="w-full max-w-sm lg:w-[30%] bg-white p-6 rounded-lg shadow-lg border border-gray-100 flex items-start space-x-4 transition-transform duration-300 hover:shadow-xl hover:-translate-y-1" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-100 text-blue-700 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.124-1.282-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm-1-4a1 1 0 11-2 0 1 1 0 012 0zM4 20h2.5a1.5 1.5 0 001.5-1.5v-2.5a1.5 1.5 0 00-1.5-1.5H4a1 1 0 00-1 1v4a1 1 0 001 1z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Kartu Keluarga (KK)</h3>
                        <p class="mt-1 text-gray-600">Scan dokumen KK yang masih berlaku. Pastikan nama calon siswa dan orang tua tercantum dengan jelas.</p>
                    </div>
                </div>

                {{-- Persyaratan 2: Akta Kelahiran --}}
                <div class="w-full max-w-sm lg:w-[30%] bg-white p-6 rounded-lg shadow-lg border border-gray-100 flex items-start space-x-4 transition-transform duration-300 hover:shadow-xl hover:-translate-y-1" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex-shrink-0 w-12 h-12 bg-green-100 text-green-700 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Akta Kelahiran</h3>
                        <p class="mt-1 text-gray-600">Scan Akta Kelahiran asli untuk verifikasi usia dan nama lengkap calon siswa.</p>
                    </div>
                </div>

                {{-- Persyaratan 3: Ijazah / SKL --}}
                <div class="w-full max-w-sm lg:w-[30%] bg-white p-6 rounded-lg shadow-lg border border-gray-100 flex items-start space-x-4 transition-transform duration-300 hover:shadow-xl hover:-translate-y-1" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex-shrink-0 w-12 h-12 bg-yellow-100 text-yellow-700 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Ijazah / SKL</h3>
                        <p class="mt-1 text-gray-600">Scan Ijazah atau Surat Keterangan Lulus (SKL) dari sekolah asal yang sudah dilegalisir.</p>
                    </div>
                </div>
                
                {{-- Persyaratan 4: Pas Foto --}}
                <div class="w-full max-w-sm lg:w-[30%] bg-white p-6 rounded-lg shadow-lg border border-gray-100 flex items-start space-x-4 transition-transform duration-300 hover:shadow-xl hover:-translate-y-1" data-aos="fade-up" data-aos-delay="400">
                    <div class="flex-shrink-0 w-12 h-12 bg-purple-100 text-purple-700 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Pas Foto</h3>
                        <p class="mt-1 text-gray-600">File pas foto formal terbaru dengan latar belakang merah, ukuran 3x4.</p>
                    </div>
                </div>

                {{-- Persyaratan 5: KTP Orang Tua --}}
                <div class="w-full max-w-sm lg:w-[30%] bg-white p-6 rounded-lg shadow-lg border border-gray-100 flex items-start space-x-4 transition-transform duration-300 hover:shadow-xl hover:-translate-y-1" data-aos="fade-up" data-aos-delay="500">
                    <div class="flex-shrink-0 w-12 h-12 bg-teal-100 text-teal-700 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">KTP Orang Tua/Wali</h3>
                        <p class="mt-1 text-gray-600">Scan KTP Ayah dan Ibu atau Wali untuk validasi data orang tua yang diisikan.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- === Bagian 2: Persyaratan Khusus === --}}
        <div class="mt-16">
            <h3 class="text-2xl font-semibold text-center text-gray-700 mb-10">Dokumen Tambahan untuk Jalur Khusus</h3>
            {{-- [DIPERBARUI] Tata letak kartu untuk desktop --}}
            <div class="max-w-screen-lg mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
                
                {{-- Jalur Afirmasi --}}
                <div class="border rounded-lg bg-white shadow-sm p-6" data-aos="fade-up" data-aos-delay="100">
                    <h4 class="font-semibold text-gray-900 mb-2">Jalur Afirmasi (Siswa Kurang Mampu)</h4>
                    <div class="text-gray-600">
                        <ul class="list-disc list-inside space-y-2">
                            <li>Scan Kartu Indonesia Pintar (KIP), Program Keluarga Harapan (PKH), atau Kartu Keluarga Sejahtera (KKS).</li>
                            <li>Jika tidak ada, dapat menggunakan Surat Keterangan Tidak Mampu (SKTM) dari kelurahan/desa.</li>
                        </ul>
                    </div>
                </div>

                {{-- Jalur Prestasi --}}
                <div class="border rounded-lg bg-white shadow-sm p-6" data-aos="fade-up" data-aos-delay="200">
                    <h4 class="font-semibold text-gray-900 mb-2">Jalur Prestasi</h4>
                    <div class="text-gray-600">
                        <ul class="list-disc list-inside space-y-2">
                            <li>Scan sertifikat prestasi (akademik/non-akademik) minimal tingkat kabupaten/kota.</li>
                            <li>Scan nilai rapor semester 1-5 yang telah dilegalisir oleh sekolah asal.</li>
                        </ul>
                    </div>
                </div>

                {{-- Jalur Pindah Tugas (di tengah) --}}
                <div class="md:col-span-2 flex justify-center">
                    <div class="w-full max-w-lg border rounded-lg bg-white shadow-sm p-6" data-aos="fade-up" data-aos-delay="300">
                        <h4 class="font-semibold text-gray-900 mb-2">Jalur Pindah Tugas Orang Tua</h4>
                        <div class="text-gray-600">
                            <ul class="list-disc list-inside space-y-2">
                                <li>Scan Surat Keputusan (SK) pindah tugas orang tua/wali dari instansi terkait.</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

