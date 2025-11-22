<nav x-data="{ mobileOpen: false, userMenuOpen: false }" 
         class="bg-white/90 backdrop-blur-md border-b border-gray-200 sticky top-0 z-50 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                
                {{-- Logo & Desktop Nav --}}
                <div class="flex">
                    {{-- Logo --}}
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('siswa.dashboard') }}" class="flex items-center gap-2.5 group">
                            <span class="font-bold text-xl tracking-tight text-gray-900">PPDB <span class="text-blue-600">Online</span></span>
                        </a>
                    </div>

                    {{-- Desktop Menu Links --}}
                    <div class="hidden sm:ml-8 sm:flex sm:space-x-8">
                        <a href="{{ route('siswa.dashboard') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-all duration-200 h-full
                           {{ request()->routeIs('siswa.dashboard*') 
                                ? 'border-blue-600 text-blue-600' 
                                : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                            Dashboard
                        </a>
                    </div>
                </div>

                {{-- User Dropdown (Desktop & Mobile Trigger) --}}
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <div class="relative ml-3">
                        <div>
                            <button @click="userMenuOpen = !userMenuOpen" 
                                    @click.outside="userMenuOpen = false"
                                    type="button" 
                                    class="flex text-sm bg-white rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 items-center gap-3 p-1 pr-3 border border-gray-100 hover:bg-gray-50 transition-colors shadow-sm" 
                                    id="user-menu-button" 
                                    aria-expanded="false" 
                                    aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full object-cover ring-2 ring-white" 
                                     src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Siswa') }}&background=0D8ABC&color=fff" 
                                     alt="{{ Auth::user()->name }}">
                                <div class="text-left hidden md:block leading-tight">
                                    <p class="text-xs font-semibold text-gray-700">{{ strtok(Auth::user()->name, ' ') }}</p>
                                    <p class="text-[10px] text-gray-400 font-medium">Calon Siswa</p>
                                </div>
                                <svg class="w-4 h-4 text-gray-400" :class="userMenuOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="transition: transform 0.2s"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                        </div>

                        {{-- Dropdown Menu --}}
                        <div x-show="userMenuOpen" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="origin-top-right absolute right-0 mt-2 w-56 rounded-xl shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50" 
                             role="menu" 
                             style="display: none;">
                            <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/50 rounded-t-xl">
                                <p class="text-sm text-gray-900 font-semibold truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate font-medium">{{ Auth::user()->email }}</p>
                            </div>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 font-medium transition-colors" role="menuitem">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Mobile Menu Button --}}
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="mobileOpen = !mobileOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 transition-colors" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        {{-- Icon when menu is closed --}}
                        <svg x-show="!mobileOpen" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        {{-- Icon when menu is open --}}
                        <svg x-show="mobileOpen" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="sm:hidden border-t border-gray-200 bg-white absolute w-full shadow-lg" id="mobile-menu" style="display: none;">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('siswa.dashboard') }}" 
                   class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium 
                   {{ request()->routeIs('siswa.dashboard*') ? 'bg-blue-50 border-blue-500 text-blue-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">
                    Dashboard
                </a>
            </div>
            <div class="pt-4 pb-4 border-t border-gray-200 bg-gray-50">
                <div class="flex items-center px-4">
                    <div class="shrink-0">
                        <img class="h-10 w-10 rounded-full object-cover border-2 border-white shadow-sm" 
                             src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Siswa') }}&background=0D8ABC&color=fff" 
                             alt="{{ Auth::user()->name }}">
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-xs font-medium text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1 px-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 text-base font-medium text-red-600 rounded-md hover:bg-red-50 hover:text-red-800 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>