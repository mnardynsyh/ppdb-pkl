<nav 
    x-data="navbar()"
    class="bg-white/80 backdrop-blur-2xl shadow-lg sticky top-0 z-50 border-b border-gray-100/50"
    style="font-family: 'Poppins', sans-serif;"
>
    <div class="max-w-screen-2xl mx-auto px-6 py-4 flex items-center justify-between">
        <!-- Brand Logo & Text -->
        <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
            <div class="relative">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-700 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/25 group-hover:scale-105 transition-transform duration-300">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l9-5m-9 5v6"/>
                    </svg>
                </div>
                <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl blur opacity-20 group-hover:opacity-30 transition duration-300"></div>
            </div>
            
            <div class="flex flex-col">
                <span class="text-2xl font-black bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent tracking-tight">
                    PPDB Online
                </span>
                <span class="text-xs text-gray-500 font-medium tracking-wide">TA 2024/2025</span>
            </div>
        </a>

        <!-- Desktop Navigation -->
        <div class="hidden lg:flex items-center space-x-1">
            <!-- Beranda -->
            <a href="{{ route('home') }}"
                :class="activeMenu === 'home' 
                    ? 'bg-gradient-to-r from-blue-50 to-indigo-50 text-blue-700 border border-blue-200/50 shadow-sm' 
                    : 'text-gray-700 hover:bg-gray-50/80 hover:text-gray-900'"
                class="relative px-5 py-2.5 rounded-xl font-semibold text-sm transition-all duration-200 group"
                @click="setActive('home')"
            >
                <span class="relative z-10">Beranda</span>
                {{-- <div x-show="activeMenu === 'home'" class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-blue-400 to-blue-600"></div> --}}
            </a>

            <!-- Informasi Pendaftaran Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button 
                    @click="open = !open"
                    @click.outside="open = false"
                    :class="activeMenu.startsWith('info') 
                        ? 'bg-gradient-to-r from-blue-50 to-indigo-50 text-blue-700 border border-blue-200/50 shadow-sm' 
                        : 'text-gray-700 hover:bg-gray-50/80 hover:text-gray-900'"
                    class="flex items-center space-x-1 px-5 py-2.5 rounded-xl font-semibold text-sm transition-all duration-200 group"
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
                    class="absolute left-0 mt-2 w-64 bg-white/95 backdrop-blur-xl rounded-2xl shadow-xl border border-gray-200/50 py-3 z-50"
                >
                    <div class="space-y-1">
                        <a href="/#alur" 
                           @click="setActive('info-alur'); open = false"
                           class="flex items-center space-x-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50/50 hover:text-blue-700 transition-all duration-200 group"
                        >
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold">Alur Pendaftaran</div>
                            </div>
                        </a>
                        
                        <a href="{{ route('jadwal') }}"
                           @click="setActive('info-jadwal'); open = false"
                           class="flex items-center space-x-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-green-50/50 hover:text-green-700 transition-all duration-200 group"
                        >
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold">Jadwal Penting</div>
                            </div>
                        </a>
                        
                        <a href="/#persyaratan"
                           @click="setActive('info-persyaratan'); open = false"
                           class="flex items-center space-x-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-orange-50/50 hover:text-orange-700 transition-all duration-200 group"
                        >
                            <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                                <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold">Persyaratan</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profil Sekolah Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button 
                    @click="open = !open"
                    @click.outside="open = false"
                    :class="activeMenu.startsWith('profil') 
                        ? 'bg-gradient-to-r from-blue-50 to-indigo-50 text-blue-700 border border-blue-200/50 shadow-sm' 
                        : 'text-gray-700 hover:bg-gray-50/80 hover:text-gray-900'"
                    class="flex items-center space-x-1 px-5 py-2.5 rounded-xl font-semibold text-sm transition-all duration-200 group"
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
                    class="absolute left-0 mt-2 w-64 bg-white/95 backdrop-blur-xl rounded-2xl shadow-xl border border-gray-200/50 py-3 z-50"
                >
                    <div class="space-y-1">
                        <a href="#" 
                           @click="setActive('profil-tentang'); open = false"
                           class="flex items-center space-x-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-purple-50/50 hover:text-purple-700 transition-all duration-200 group"
                        >
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold">Tentang Kami</div>
                            </div>
                        </a>
                        
                        <a href="#" 
                           @click="setActive('profil-visi'); open = false"
                           class="flex items-center space-x-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50/50 hover:text-indigo-700 transition-all duration-200 group"
                        >
                            <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center group-hover:bg-indigo-200 transition-colors">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold">Visi & Misi</div>
                            </div>
                        </a>
                        
                        <a href="{{ route('kontak') }}"
                           @click="setActive('profil-kontak'); open = false"
                           class="flex items-center space-x-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-pink-50/50 hover:text-pink-700 transition-all duration-200 group"
                        >
                            <div class="w-8 h-8 bg-pink-100 rounded-lg flex items-center justify-center group-hover:bg-pink-200 transition-colors">
                                <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold">Kontak Kami</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- FAQ -->
            <a href="/#faq"
                :class="activeMenu === 'faq' 
                    ? 'bg-gradient-to-r from-blue-50 to-indigo-50 text-blue-700 border border-blue-200/50 shadow-sm' 
                    : 'text-gray-700 hover:bg-gray-50/80 hover:text-gray-900'"
                class="relative px-5 py-2.5 rounded-xl font-semibold text-sm transition-all duration-200 group"
                @click="setActive('faq')"
            >
                <span class="relative z-10">FAQ</span>
            </a>
        </div>

        <!-- Right Controls -->
        <div class="flex items-center space-x-4">
            <!-- Login Button -->
            <a href="{{ route('login') }}"
                class="hidden md:flex items-center space-x-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-6 py-2.5 rounded-xl font-semibold text-sm shadow-lg shadow-blue-500/25 hover:shadow-xl hover:shadow-blue-500/30 transition-all duration-200 group"
            >
                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                <span>Masuk</span>
            </a>

            <!-- Mobile Menu Button -->
            <button 
                @click="toggleMobile()"
                class="lg:hidden w-10 h-10 flex items-center justify-center rounded-xl
                       text-gray-600 hover:bg-gray-100 transition-all duration-200 border border-gray-200"
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

    <!-- Mobile Menu -->
    <div 
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="lg:hidden absolute top-full left-0 w-full bg-white/95 backdrop-blur-2xl border-b border-gray-200/50 shadow-xl"
    >
        <div class="px-6 py-4 space-y-2">
            <!-- Mobile Navigation Items -->
            <a href="{{ route('home') }}" 
               @click="toggleMobile()"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Beranda</span>
            </a>
            
            <a href="/#alur" 
               @click="toggleMobile()"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-green-50 hover:text-green-700 transition-all duration-200 font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                <span>Alur Pendaftaran</span>
            </a>
            
            <a href="{{ route('jadwal') }}" 
               @click="toggleMobile()"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-orange-50 hover:text-orange-700 transition-all duration-200 font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>Jadwal Penting</span>
            </a>

            <a href="/#persyaratan" 
               @click="toggleMobile()"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-all duration-200 font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span>Persyaratan</span>
            </a>

            <a href="/#faq" 
               @click="toggleMobile()"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-pink-50 hover:text-pink-700 transition-all duration-200 font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>FAQ</span>
            </a>
            
            <!-- Mobile Login Button -->
            <div class="pt-4 space-y-3 border-t border-gray-200/50">
                <a href="{{ route('login') }}" 
                   @click="toggleMobile()"
                   class="flex items-center justify-center space-x-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-3 rounded-xl font-semibold text-sm shadow-lg shadow-blue-500/25 transition-all duration-200">
                    <span>Masuk Akun</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
function navbar() {
    return {
        mobileOpen: false,
        activeMenu: 'home',
        activeClass: 'bg-gradient-to-r from-blue-50 to-indigo-50 text-blue-700 border border-blue-200/50 shadow-sm',
        inactiveClass: 'text-gray-700 hover:bg-gray-50/80 hover:text-gray-900',
        
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