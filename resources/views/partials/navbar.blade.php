<nav 
    x-data="navbar('{{ 
        request()->routeIs('home') ? 'home' : 
        (request()->routeIs('jadwal') ? 'info-jadwal' : 
        (request()->routeIs('about') ? 'profil-tentang' : 
        (request()->routeIs('visiMisi') ? 'profil-visi' : 
        (request()->routeIs('kontak') ? 'profil-kontak' : 
        (request()->is('faq') ? 'faq' : '')))))
    }}')"
    class="bg-white/80 backdrop-blur-xl shadow-sm sticky top-0 z-50 border-b border-neutral-200"
    style="font-family: 'Plus Jakarta Sans', sans-serif;"
>
    <div class="max-w-screen-2xl mx-auto px-6 py-3 flex items-center justify-between">
        <a href="{{ route('home') }}" class="group">
            <div class="flex flex-col">
                <span class="text-2xl font-bold text-neutral-900 tracking-tight group-hover:text-primary-600 transition-colors">
                    PPDB Online
                </span>
                <span class="text-xs text-neutral-500 font-medium mt-0.5">TA {{ $tahun_ajaran ?? '2025/2026' }}</span>
            </div>
        </a>

        <div class="hidden lg:flex items-center space-x-2">
            <a href="{{ route('home') }}"
                :class="activeMenu === 'home' 
                    ? 'bg-primary-200/30 text-primary-700' 
                    : 'text-neutral-600 hover:text-neutral-700 hover:bg-neutral-100'"
                class="px-5 py-2.5 rounded-lg font-semibold text-sm transition-all duration-200"
                @click="setActive('home')"
            >
                Beranda
            </a>

            <div x-data="{ open: false }" class="relative">
                <button 
                    @click="open = !open"
                    @click.outside="open = false"
                    :class="activeMenu.startsWith('info') 
                        ? 'bg-primary-200/30 text-primary-700' 
                        : 'text-neutral-600 hover:text-neutral-700 hover:bg-neutral-50'"
                    class="flex items-center space-x-1.5 px-5 py-2.5 rounded-lg font-semibold text-sm transition-all duration-200"
                >
                    <span>Informasi</span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div 
                    x-show="open"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute left-0 mt-3 w-64 bg-white rounded-xl shadow-lg border border-neutral-200 py-3 z-50"
                >
                    <div class="space-y-1 px-2">
                        <a href="/#alur" 
                           @click="setActive('info-alur'); open = false"
                           class="flex items-center space-x-3 px-3 py-2.5 text-sm text-neutral-700 hover:bg-primary-50 hover:text-primary-700 rounded-lg transition-colors duration-200"
                        >
                            <div class="w-8 h-8 bg-primary-50 rounded-lg flex items-center justify-center text-primary-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                            </div>
                            <span class="font-medium">Alur Pendaftaran</span>
                        </a>
                        
                        <a href="{{ route('jadwal') }}"
                           @click="setActive('info-jadwal'); open = false"
                           class="flex items-center space-x-3 px-3 py-2.5 text-sm text-neutral-700 hover:bg-primary-50 hover:text-primary-700 rounded-lg transition-colors duration-200"
                           :class="activeMenu === 'info-jadwal' ? 'bg-primary-50 text-primary-700' : ''"
                        >
                            <div class="w-8 h-8 bg-primary-50 rounded-lg flex items-center justify-center text-primary-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="font-medium">Jadwal Penting</span>
                        </a>
                        
                        <a href="/#persyaratan"
                           @click="setActive('info-persyaratan'); open = false"
                           class="flex items-center space-x-3 px-3 py-2.5 text-sm text-neutral-700 hover:bg-primary-50 hover:text-primary-700 rounded-lg transition-colors duration-200"
                        >
                            <div class="w-8 h-8 bg-primary-50 rounded-lg flex items-center justify-center text-primary-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <span class="font-medium">Persyaratan</span>
                        </a>
                    </div>
                </div>
            </div>

            <div x-data="{ open: false }" class="relative">
                <button 
                    @click="open = !open"
                    @click.outside="open = false"
                    :class="activeMenu.startsWith('profil') 
                        ? 'bg-primary-200/30 text-primary-700' 
                        : 'text-neutral-600 hover:text-neutral-700 hover:bg-neutral-50'"
                    class="flex items-center space-x-1.5 px-5 py-2.5 rounded-lg font-semibold text-sm transition-all duration-200"
                >
                    <span>Profil Sekolah</span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div 
                    x-show="open"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute left-0 mt-3 w-64 bg-white rounded-xl shadow-lg border border-neutral-200 py-3 z-50"
                >
                    <div class="space-y-1 px-2">
                        <a href="{{ route('about') }}" 
                           @click="setActive('profil-tentang'); open = false"
                           class="flex items-center space-x-3 px-3 py-2.5 text-sm text-neutral-700 hover:bg-primary-50 hover:text-primary-700 rounded-lg transition-colors duration-200"
                           :class="activeMenu === 'profil-tentang' ? 'bg-primary-50 text-primary-700' : ''"
                        >
                            <div class="w-8 h-8 bg-primary-50 rounded-lg flex items-center justify-center text-primary-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="font-medium">Tentang Kami</span>
                        </a>
                        
                        <a href="{{ route('visiMisi') }}" 
                           @click="setActive('profil-visi'); open = false"
                           class="flex items-center space-x-3 px-3 py-2.5 text-sm text-neutral-700 hover:bg-primary-50 hover:text-primary-700 rounded-lg transition-colors duration-200"
                           :class="activeMenu === 'profil-visi' ? 'bg-primary-50 text-primary-700' : ''"
                        >
                            <div class="w-8 h-8 bg-primary-50 rounded-lg flex items-center justify-center text-primary-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                            <span class="font-medium">Visi & Misi</span>
                        </a>
                        
                        <a href="{{ route('kontak') }}"
                           @click="setActive('profil-kontak'); open = false"
                           class="flex items-center space-x-3 px-3 py-2.5 text-sm text-neutral-700 hover:bg-primary-50 hover:text-primary-700 rounded-lg transition-colors duration-200"
                           :class="activeMenu === 'profil-kontak' ? 'bg-primary-50 text-primary-700' : ''"
                        >
                            <div class="w-8 h-8 bg-primary-50 rounded-lg flex items-center justify-center text-primary-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <span class="font-medium">Kontak Kami</span>
                        </a>
                    </div>
                </div>
            </div>

            <a href="/#faq"
                :class="activeMenu === 'faq' 
                    ? 'bg-primary-200/30 text-primary-700' 
                    : 'text-neutral-600 hover:text-neutral-700 hover:bg-neutral-50'"
                class="px-5 py-2.5 rounded-lg font-semibold text-sm transition-all duration-200"
                @click="setActive('faq')"
            >
                FAQ
            </a>
        </div>

        <div class="flex items-center space-x-4">
            <a href="{{ route('login') }}"
                class="hidden md:flex items-center space-x-2 bg-primary-600 hover:bg-primary-700 text-white px-5 py-2.5 rounded-lg font-medium text-sm transition-colors duration-200 shadow-lg shadow-primary-200"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                <span>Masuk</span>
            </a>

            <button 
                @click="toggleMobile()"
                class="lg:hidden w-10 h-10 flex items-center justify-center rounded-lg text-neutral-600 hover:bg-neutral-100 transition-colors duration-200 border border-neutral-300"
            >
                <template x-if="!mobileOpen">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </template>
                <template x-if="mobileOpen">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </template>
            </button>
        </div>
    </div>

    <div 
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="lg:hidden absolute top-full left-0 w-full bg-white border-b border-neutral-200 shadow-lg z-40"
    >
        <div class="px-6 py-4 space-y-3">
            <a href="{{ route('home') }}" 
               @click="toggleMobile()"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium text-sm transition-colors duration-200"
               :class="activeMenu === 'home' ? 'bg-primary-50 text-primary-700' : 'text-neutral-700 hover:bg-primary-50 hover:text-primary-700'"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Beranda</span>
            </a>
            
            <a href="/#alur" 
               @click="toggleMobile()"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium text-sm transition-colors duration-200"
               :class="activeMenu === 'info-alur' ? 'bg-primary-50 text-primary-700' : 'text-neutral-700 hover:bg-primary-50 hover:text-primary-700'"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                <span>Alur Pendaftaran</span>
            </a>
            
            <a href="{{ route('jadwal') }}" 
               @click="toggleMobile()"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium text-sm transition-colors duration-200"
               :class="activeMenu === 'info-jadwal' ? 'bg-primary-50 text-primary-700' : 'text-neutral-700 hover:bg-primary-50 hover:text-primary-700'"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>Jadwal Penting</span>
            </a>

            <a href="/#persyaratan" 
               @click="toggleMobile()"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium text-sm transition-colors duration-200"
               :class="activeMenu === 'info-persyaratan' ? 'bg-primary-50 text-primary-700' : 'text-neutral-700 hover:bg-primary-50 hover:text-primary-700'"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span>Persyaratan</span>
            </a>

            <a href="{{ route('about') }}" 
               @click="toggleMobile()"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium text-sm transition-colors duration-200"
               :class="activeMenu === 'profil-tentang' ? 'bg-primary-50 text-primary-700' : 'text-neutral-700 hover:bg-primary-50 hover:text-primary-700'"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Tentang Kami</span>
            </a>

            <a href="{{ route('visiMisi') }}" 
               @click="toggleMobile()"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium text-sm transition-colors duration-200"
               :class="activeMenu === 'profil-visi' ? 'bg-primary-50 text-primary-700' : 'text-neutral-700 hover:bg-primary-50 hover:text-primary-700'"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                <span>Visi & Misi</span>
            </a>

            <a href="{{ route('kontak') }}" 
               @click="toggleMobile()"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg font-bold text-sm transition-colors duration-200"
               :class="activeMenu === 'profil-kontak' ? 'bg-primary-200 text-primary-700' : 'text-neutral-700 hover:bg-primary-50 hover:text-primary-700'"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                <span>Kontak Kami</span>
            </a>

            <a href="/#faq" 
               @click="toggleMobile()"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium text-sm transition-colors duration-200"
               :class="activeMenu === 'faq' ? 'bg-primary-50 text-primary-700' : 'text-neutral-700 hover:bg-primary-50 hover:text-primary-700'"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>FAQ</span>
            </a>
            
            <div class="pt-4 border-t border-neutral-200">
                <a href="{{ route('login') }}" 
                   @click="toggleMobile()"
                   class="flex items-center justify-center space-x-2 bg-primary-600 text-white px-4 py-3 rounded-lg font-medium text-sm transition-colors duration-200 hover:bg-primary-700"
                >
                    <span>Masuk Akun</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
function navbar(initialActive) {
    return {
        mobileOpen: false,
        activeMenu: initialActive,
        activeClass: 'bg-primary-50 text-primary-700',
        inactiveClass: 'text-neutral-600 hover:text-neutral-900 hover:bg-neutral-50',
        
        toggleMobile() {
            this.mobileOpen = !this.mobileOpen;
        },
        
        setActive(menu) {
            this.activeMenu = menu;
            this.mobileOpen = false;
        }
    }
}
</script>