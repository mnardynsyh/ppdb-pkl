<nav class="bg-white/90 backdrop-blur-md border-b border-neutral-200 sticky top-0 z-50 shadow-sm" x-data="{ mobileOpen: false, profileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            {{-- 1. Logo (Kiri) --}}
            <div class="flex items-center">
                <a href="{{ route('siswa.dashboard') }}" class="flex-shrink-0 flex items-center gap-2.5 group">
                    <div class="w-9 h-9 bg-primary-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary-200 group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-graduation-cap text-sm"></i>
                    </div>
                    <span class="font-bold text-lg text-neutral-900 tracking-tight ml-1">
                        PPDB <span class="text-primary-600">Siswa</span>
                    </span>
                </a>
            </div>

            {{-- 2. Menu Navigasi (Tengah - Desktop Only) --}}
            <div class="hidden md:flex flex-1 items-center justify-center space-x-1">
                <a href="{{ route('siswa.dashboard') }}" 
                   class="px-4 py-2 rounded-full text-sm font-bold transition-all duration-200
                   {{ request()->routeIs('siswa.dashboard') 
                        ? 'bg-primary-50 text-primary-700' 
                        : 'text-neutral-500 hover:text-neutral-900 hover:bg-neutral-50' }}">
                    Dashboard
                </a>

                <a href="{{ route('siswa.formulir') }}" 
                   class="px-4 py-2 rounded-full text-sm font-bold transition-all duration-200
                   {{ request()->routeIs('siswa.formulir*') 
                        ? 'bg-primary-50 text-primary-700' 
                        : 'text-neutral-500 hover:text-neutral-900 hover:bg-neutral-50' }}">
                    Formulir Pendaftaran
                </a>
            </div>

            {{-- 3. Profil User (Kanan - Desktop Only) --}}
            <div class="hidden md:flex items-center">
                <div class="relative">
                    <button @click="profileOpen = !profileOpen" @click.outside="profileOpen = false"
                            class="flex items-center gap-3 pl-1 pr-2 py-1 rounded-full border border-transparent hover:border-neutral-200 hover:bg-neutral-50 transition-all group focus:outline-none">
                        
                        <div class="text-right leading-tight hidden lg:block">
                            <p class="text-xs font-bold text-neutral-800 group-hover:text-primary-700 transition-colors">
                                {{ strtok(Auth::user()->name, ' ') }}
                            </p>
                            <p class="text-[10px] text-neutral-400 font-medium uppercase tracking-wider">Calon Siswa</p>
                        </div>
                        
                        <div class="relative">
                            <img class="h-9 w-9 rounded-full object-cover border-2 border-white shadow-sm ring-1 ring-neutral-100 group-hover:ring-primary-200 transition-all"
                                 src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0d9488&color=ffffff&bold=true" 
                                 alt="{{ Auth::user()->name }}">
                        </div>

                        <i class="fa-solid fa-chevron-down text-[10px] text-neutral-400 group-hover:text-neutral-600 transition-transform duration-200"
                           :class="profileOpen ? 'rotate-180' : ''"></i>
                    </button>

                    {{-- Dropdown Menu --}}
                    <div x-show="profileOpen" 
                         x-transition.origin.top.right
                         class="absolute right-0 mt-2 w-56 rounded-2xl shadow-xl py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50 overflow-hidden border border-neutral-100"
                         style="display: none;">
                        
                        <div class="px-5 py-3 border-b border-neutral-100 bg-neutral-50/50">
                            <p class="text-xs text-neutral-400 font-medium mb-0.5">Masuk sebagai</p>
                            <p class="text-sm font-bold text-neutral-900 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <div class="py-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left flex items-center gap-3 px-5 py-2.5 text-sm font-medium text-rose-600 hover:bg-rose-50 transition-colors group">
                                    <div class="w-8 h-8 rounded-lg bg-rose-100 flex items-center justify-center text-rose-600 group-hover:bg-rose-200 transition-colors">
                                        <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                                    </div>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4. Mobile Menu Button --}}
            <div class="-mr-2 flex items-center md:hidden">
                <button @click="mobileOpen = !mobileOpen" 
                        class="inline-flex items-center justify-center p-2 rounded-xl text-neutral-400 hover:text-primary-600 hover:bg-primary-50 focus:outline-none transition-colors">
                    <i class="fa-solid text-lg" :class="mobileOpen ? 'fa-xmark' : 'fa-bars'"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu Dropdown --}}
    <div x-show="mobileOpen" x-collapse class="md:hidden border-t border-neutral-200 bg-white">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('siswa.dashboard') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-colors
               {{ request()->routeIs('siswa.dashboard') 
                    ? 'bg-primary-50 text-primary-700' 
                    : 'text-neutral-600 hover:bg-neutral-50 hover:text-neutral-900' }}">
                <i class="fa-solid fa-house w-5 text-center"></i> Dashboard
            </a>
            
            <a href="{{ route('siswa.formulir') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-colors
               {{ request()->routeIs('siswa.formulir.*') 
                    ? 'bg-primary-50 text-primary-700' 
                    : 'text-neutral-600 hover:bg-neutral-50 hover:text-neutral-900' }}">
                <i class="fa-solid fa-file-pen w-5 text-center"></i> Formulir Pendaftaran
            </a>
        </div>

        <div class="pt-4 pb-4 border-t border-neutral-200 bg-neutral-50/50">
            <div class="px-6 flex items-center gap-4 mb-4">
                <img class="h-10 w-10 rounded-full border border-white shadow-sm" 
                     src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0d9488&color=ffffff&bold=true" alt="">
                <div class="overflow-hidden">
                    <div class="text-sm font-bold text-neutral-900 truncate">{{ Auth::user()->name }}</div>
                    <div class="text-xs font-medium text-neutral-500 truncate">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="px-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-sm font-bold text-white bg-rose-700 hover:bg-rose-800 shadow-lg shadow-neutral-200 transition-all">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>