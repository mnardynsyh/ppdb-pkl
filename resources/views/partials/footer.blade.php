<footer class="bg-neutral-900 text-white pt-16 pb-8 border-t border-neutral-800">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            
            {{-- Brand Section --}}
            <div class="lg:col-span-1 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary-900/20">
                        <i class="fa-solid fa-graduation-cap text-lg"></i>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-white">PPDB Online</span>
                </div>
                <p class="text-sm text-neutral-400 leading-relaxed">
                    Platform pendaftaran siswa baru yang transparan, efisien, dan terintegrasi untuk masa depan pendidikan yang lebih baik.
                </p>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Informasi</h4>
                <ul class="space-y-3 text-sm text-neutral-400">
                    <li><a href="{{ route('jadwal') }}" class="hover:text-primary-500 transition-colors">Jadwal Pendaftaran</a></li>
                    <li><a href="/#alur" class="hover:text-primary-500 transition-colors">Alur Pendaftaran</a></li>
                    <li><a href="/#persyaratan" class="hover:text-primary-500 transition-colors">Persyaratan</a></li>
                    <li><a href="/#faq" class="hover:text-primary-500 transition-colors">Tanya Jawab</a></li>
                </ul>
            </div>

            {{-- Profil --}}
            <div>
                <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Tentang Sekolah</h4>
                <ul class="space-y-3 text-sm text-neutral-400">
                    <li><a href="{{ route('about') }}" class="hover:text-primary-500 transition-colors">Profil Sekolah</a></li>
                    <li><a href="{{ route('visiMisi') }}" class="hover:text-primary-500 transition-colors">Visi & Misi</a></li>
                    <li><a href="{{ route('kontak') }}" class="hover:text-primary-500 transition-colors">Hubungi Kami</a></li>
                </ul>
            </div>

            {{-- Contact Info --}}
            <div>
                <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Alamat</h4>
                <div class="space-y-3 text-sm text-neutral-400">
                    <p class="flex items-start gap-3">
                        <i class="fa-solid fa-map-location-dot mt-1 text-primary-600"></i>
                        <span>{{ $global_pengaturan->alamat_sekolah ?? 'Alamat sekolah belum dikonfigurasi.' }}</span>
                    </p>
                    <p class="flex items-center gap-3">
                        <i class="fa-solid fa-envelope text-primary-600"></i>
                        <span>{{ $global_pengaturan->email ?? 'admin@sekolah.sch.id' }}</span>
                    </p>
                    <p class="flex items-center gap-3">
                        <i class="fa-solid fa-phone text-primary-600"></i>
                        <span>{{ $global_pengaturan->telepon ?? '(021) 12345678' }}</span>
                    </p>
                </div>
            </div>

        </div>

        {{-- Copyright --}}
        <div class="pt-8 border-t border-neutral-800 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-xs text-neutral-500 text-center md:text-left">
                &copy; {{ date('Y') }} <a href="https://github.com/mnardynsyh">PPDB Online.</a>
            </p>
        </div>
    </div>
</footer>