{{-- Section FAQ --}}
<section class="relative bg-neutral-50 py-24 lg:py-24 overflow-hidden" id="faq">

    <div class="absolute top-1/2 left-0 -translate-y-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-primary-100/40 rounded-full blur-3xl -z-10"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        
        <div class="text-center max-w-3xl mx-auto mb-20" data-aos="fade-up">
            <h2 class="text-3xl lg:text-4xl font-extrabold text-neutral-900 tracking-tight mb-4">
                Pertanyaan Umum
            </h2>
            <p class="text-lg text-neutral-500 leading-relaxed">
                Temukan jawaban cepat untuk pertanyaan yang sering diajukan seputar proses pendaftaran.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">
            <div class="lg:col-span-2 space-y-6">
                
                @php
                    $faqs = [
                        [
                            'q' => 'Kapan pendaftaran dibuka?',
                            'a' => 'Pendaftaran dibuka dan ditutup sesuai dengan jadwal yang telah ditetapkan oleh panitia. Silakan kunjungi menu "Jadwal Penting" untuk melihat linimasa lengkap.'
                        ],
                        [
                            'q' => 'Bagaimana jika saya lupa password?',
                            'a' => 'Gunakan fitur "Lupa Password" di halaman login. Sistem akan meminta email terdaftar untuk proses reset kata sandi akun Anda.'
                        ],
                        [
                            'q' => 'Apakah berkas persyaratan wajib diunggah semua?',
                            'a' => 'Ya, semua dokumen pada bagian "Dokumen Wajib" harus diunggah. Jika ada kendala (misal SKL belum terbit), silakan hubungi panitia untuk kebijakan khusus.'
                        ],
                        [
                            'q' => 'Bisakah saya mengubah data setelah dikirim?',
                            'a' => 'Data dapat diubah selama status pendaftaran masih "Pending". Jika sudah diverifikasi atau status berubah, Anda harus menghubungi admin sekolah untuk pembukaan akses edit.'
                        ],
                    ];
                @endphp

                @foreach ($faqs as $index => $faq)
                    <div class="group bg-white rounded-2xl p-6 border border-neutral-200 shadow-sm hover:border-primary-200 hover:shadow-md transition-all duration-300" 
                         data-aos="fade-up" 
                         data-aos-delay="{{ $index * 100 }}">
                        
                        <h4 class="flex items-start gap-4 text-lg font-bold text-neutral-800 group-hover:text-primary-700 transition-colors">
                            <span class="flex-shrink-0 flex items-center justify-center w-8 h-8 rounded-lg bg-primary-50 text-primary-600 text-sm font-extrabold">Q</span>
                            <span class="mt-0.5">{{ $faq['q'] }}</span>
                        </h4>
                        
                        <div class="mt-3 pl-[3.25rem] text-neutral-600 leading-relaxed text-sm">
                            <p class="border-l-2 border-neutral-100 pl-4 py-1">{{ $faq['a'] }}</p>
                        </div>
                    </div>
                @endforeach

            </div>


            <div class="lg:col-span-1" data-aos="fade-left" data-aos-delay="300">
                <div class="relative overflow-hidden bg-gradient-to-br from-primary-600 to-primary-800 rounded-3xl p-8 text-center text-white shadow-xl shadow-primary-900/20 group">
                    
                    <div class="absolute -top-12 -right-12 w-40 h-40 bg-white/10 rounded-full blur-2xl group-hover:scale-110 transition-transform duration-700"></div>
                    <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-black/20 to-transparent"></div>

                    <div class="relative z-10 flex flex-col items-center">
                        <div class="w-16 h-16 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center mb-6 ring-1 ring-white/20">
                            <i class="fa-solid fa-headset text-3xl text-white"></i>
                        </div>

                        <h3 class="text-2xl font-bold mb-2">Butuh Bantuan?</h3>
                        <p class="text-primary-100 text-sm mb-8 leading-relaxed">
                            Jika pertanyaan Anda tidak tersedia di sini, jangan ragu untuk menghubungi tim support kami.
                        </p>

                        <a href="{{ route('kontak') }}" 
                           class="inline-flex items-center gap-2 px-6 py-3.5 bg-white text-primary-700 font-bold rounded-xl shadow-lg hover:bg-primary-50 hover:scale-105 transition-all duration-300 w-full justify-center">
                            <i class="fa-regular fa-envelope"></i>
                            Hubungi Kami
                        </a>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>