<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 shadow-sm">
    {{-- Navbar Code Tetap Sama --}}
    <div class="px-3 py-3 lg:px-5 lg:pl-3 h-16 flex items-center justify-between">
        <div class="flex items-center justify-start rtl:justify-end">
            <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                </svg>
            </button>
            <a href="{{ route('admin.dashboard') }}" class="flex ms-2 md:me-24 items-center gap-2">
                <span class="self-center text-xl font-bold sm:text-2xl whitespace-nowrap text-gray-800 tracking-tight">PPDB Online</span>
            </a>
        </div>
        <div class="flex items-center">
            <div class="flex items-center ms-3">
                <div>
                    <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-blue-100 transition-all" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-9 h-9 rounded-full object-cover border-2 border-white shadow-sm" src="{{ Auth::user()->foto ? Storage::url(Auth::user()->foto) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=3B82F6&color=FFFFFF&bold=true' }}" alt="user photo">
                    </button>
                </div>
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-xl border border-gray-100 w-56" id="dropdown-user">
                    <div class="px-4 py-3 bg-gray-50 rounded-t-lg" role="none">
                        <p class="text-sm font-semibold text-gray-900" role="none">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate font-medium" role="none">{{ Auth::user()->email }}</p>
                    </div>
                    <ul class="py-1" role="none">
                        <li>
                            <a href="{{ route('admin.profil.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors" role="menuitem">
                                <i class="fa-solid fa-user mr-2 text-gray-400"></i> Profil Saya
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors" role="menuitem">
                                    <i class="fa-solid fa-right-from-bracket mr-2 text-red-400"></i> Sign out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-slate-900 border-r border-slate-800 sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full pb-4 overflow-y-auto flex flex-col justify-between font-sans">
        
        {{-- Menu Utama --}}
        <ul class="space-y-1 font-medium">
            
            {{-- Label Section --}}
            <div class="px-4 mb-3 mt-2 text-[11px] font-bold text-slate-500 uppercase tracking-widest">
                Main Menu
            </div>

            {{-- 1. Dashboard --}}
            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 transition-all duration-200 border-l-[6px] text-[15px]
                   {{ request()->routeIs('admin.dashboard') 
                       ? 'border-blue-500 bg-slate-800 text-white shadow-[inset_0_1px_0_0_rgba(255,255,255,0.02)]' 
                       : 'border-transparent text-slate-400 hover:text-slate-100 hover:bg-slate-800/50' }}">
                    
                    <i class="fa-solid fa-house w-5 text-center text-[18px] transition duration-200 
                       {{ request()->routeIs('admin.dashboard') ? 'text-blue-500 drop-shadow-md' : 'text-slate-500' }}"></i>
                    <span class="flex-1 whitespace-nowrap tracking-wide">Dashboard</span>
                </a>
            </li>

            {{-- 2. Data Pendaftar (DIPINDAHKAN KE ATAS) --}}
            <li x-data="{ open: {{ request()->routeIs('admin.pendaftaran.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" 
                        class="flex items-center w-full px-4 py-3 transition-all duration-200 border-l-[6px] text-[15px] group relative z-10
                        {{ request()->routeIs('admin.pendaftaran.*') 
                            ? 'border-transparent bg-slate-800/40 text-slate-100' 
                            : 'border-transparent text-slate-400 hover:text-slate-100 hover:bg-slate-800/50' }}">
                    
                    <i class="fa-solid fa-users w-5 text-center text-[18px] transition duration-200 
                       {{ request()->routeIs('admin.pendaftaran.*') ? 'text-blue-400' : 'text-slate-500 group-hover:text-slate-300' }}"></i>
                    
                    <span class="flex-1 ms-3 text-left whitespace-nowrap tracking-wide">Data Pendaftar</span>
                    
                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform duration-200 opacity-50 group-hover:opacity-100" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>

                {{-- Submenu --}}
                <ul x-show="open" 
                    x-transition:enter="transition ease-out duration-150" 
                    x-transition:enter-start="opacity-0 -translate-y-2" 
                    x-transition:enter-end="opacity-100 translate-y-0" 
                    class="py-1 relative">
                    
                    {{-- Connector Line --}}
                    <div class="absolute left-[29px] top-0 h-full w-px bg-slate-700/50"></div>

                    <li>
                        <a href="{{ route('admin.pendaftaran.semua') }}" 
                           class="flex items-center w-full py-2.5 pr-4 pl-12 transition-all duration-200 text-sm border-l-[6px] group
                           {{ request()->routeIs('admin.pendaftaran.semua') 
                               ? 'border-blue-500 text-white bg-slate-800' 
                               : 'border-transparent text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
                           <i class="fa-solid fa-list-ul w-4 text-center text-[12px] mr-3 transition-colors
                              {{ request()->routeIs('admin.pendaftaran.semua') ? 'text-blue-400' : 'text-slate-600 group-hover:text-slate-400' }}"></i>
                           Semua Pendaftar
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pendaftaran.masuk') }}" 
                           class="flex items-center w-full py-2.5 pr-4 pl-12 transition-all duration-200 text-sm border-l-[6px] group
                           {{ request()->routeIs('admin.pendaftaran.masuk') 
                               ? 'border-yellow-500 text-white bg-slate-800' 
                               : 'border-transparent text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
                           <i class="fa-solid fa-hourglass-half w-4 text-center text-[12px] mr-3 transition-colors
                              {{ request()->routeIs('admin.pendaftaran.masuk') ? 'text-yellow-400' : 'text-slate-600 group-hover:text-slate-400' }}"></i>
                           Masuk / Pending
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pendaftaran.diterima') }}" 
                           class="flex items-center w-full py-2.5 pr-4 pl-12 transition-all duration-200 text-sm border-l-[6px] group
                           {{ request()->routeIs('admin.pendaftaran.diterima') 
                               ? 'border-green-500 text-white bg-slate-800' 
                               : 'border-transparent text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
                           <i class="fa-solid fa-circle-check w-4 text-center text-[12px] mr-3 transition-colors
                              {{ request()->routeIs('admin.pendaftaran.diterima') ? 'text-green-400' : 'text-slate-600 group-hover:text-slate-400' }}"></i>
                           Diterima
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pendaftaran.ditolak') }}" 
                           class="flex items-center w-full py-2.5 pr-4 pl-12 transition-all duration-200 text-sm border-l-[6px] group
                           {{ request()->routeIs('admin.pendaftaran.ditolak') 
                               ? 'border-red-500 text-white bg-slate-800' 
                               : 'border-transparent text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
                           <i class="fa-solid fa-circle-xmark w-4 text-center text-[12px] mr-3 transition-colors
                              {{ request()->routeIs('admin.pendaftaran.ditolak') ? 'text-red-400' : 'text-slate-600 group-hover:text-slate-400' }}"></i>
                           Ditolak
                        </a>
                    </li>
                </ul>
            </li>

            <div class="px-4 mb-3 mt-8 text-[11px] font-bold text-slate-500 uppercase tracking-widest">
                Konfigurasi
            </div>

            <li>
                <a href="{{ route('admin.pengaturan.index') }}"
                   class="flex items-center gap-3 px-4 py-3 transition-all duration-200 border-l-[6px] text-[15px]
                   {{ request()->routeIs(['admin.pengaturan.*', 'admin.jadwal.*']) 
                       ? 'border-blue-500 bg-slate-800 text-white shadow-[inset_0_1px_0_0_rgba(255,255,255,0.02)]' 
                       : 'border-transparent text-slate-400 hover:text-slate-100 hover:bg-slate-800/50' }}">
                    
                    <i class="fa-solid fa-sliders w-5 text-center text-[18px] transition duration-200 
                       {{ request()->routeIs(['admin.pengaturan.*', 'admin.jadwal.*']) ? 'text-blue-500 drop-shadow-md' : 'text-slate-500' }}"></i>
                    <span class="flex-1 whitespace-nowrap tracking-wide">Pengaturan Sistem</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.kontak.index') }}"
                   class="flex items-center gap-3 px-4 py-3 transition-all duration-200 border-l-[6px] text-[15px]
                   {{ request()->routeIs('admin.kontak.*') 
                       ? 'border-blue-500 bg-slate-800 text-white shadow-[inset_0_1px_0_0_rgba(255,255,255,0.02)]' 
                       : 'border-transparent text-slate-400 hover:text-slate-100 hover:bg-slate-800/50' }}">
                    
                    <i class="fa-solid fa-address-book w-5 text-center text-[18px] transition duration-200 
                       {{ request()->routeIs('admin.kontak.*') ? 'text-blue-500 drop-shadow-md' : 'text-slate-500' }}"></i>
                    <span class="flex-1 whitespace-nowrap tracking-wide">Informasi Kontak</span>
                </a>
            </li>

        </ul>

        {{-- Menu Logout --}}
        <div class="px-3 pb-6 mt-4 border-t border-slate-800 pt-6">
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit"
                        class="flex items-center gap-3 px-4 py-3 w-full text-left transition-all duration-200 text-slate-400 hover:bg-red-900/20 hover:text-red-400 rounded-lg group border-l-[6px] border-transparent">
                    <i class="fa-solid fa-right-from-bracket w-5 text-center text-[18px] transition group-hover:translate-x-1"></i>
                    <span class="font-medium text-[15px] tracking-wide">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>