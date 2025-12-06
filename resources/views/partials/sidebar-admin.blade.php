<nav class="fixed top-0 z-50 w-full bg-white border-b border-neutral-200 shadow-sm">
    <div class="px-3 py-3 lg:px-5 lg:pl-3 h-16 flex items-center justify-between">
        <div class="flex items-center justify-start rtl:justify-end">
            <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-neutral-500 rounded-lg sm:hidden hover:bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-neutral-200">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                </svg>
            </button>
            <a href="{{ route('admin.dashboard') }}" class="flex ms-2 md:me-24 items-center gap-2 group">
                <div class="w-8 h-8 rounded-lg bg-primary-600 flex items-center justify-center text-white">
                    <i class="fa-solid fa-graduation-cap text-sm"></i>
                </div>
                <span class="self-center text-xl font-bold sm:text-2xl whitespace-nowrap text-neutral-800 tracking-tight group-hover:text-primary-600 transition-colors">PPDB Online</span>
            </a>
        </div>
        <div class="flex items-center">
            <div class="flex items-center ms-3">
                <div>
                    <button type="button" class="flex text-sm bg-neutral-800 rounded-full focus:ring-4 focus:ring-primary-100 transition-all" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-9 h-9 rounded-full object-cover border-2 border-white shadow-sm" src="{{ Auth::user()->foto ? Storage::url(Auth::user()->foto) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=14B8A6&color=FFFFFF&bold=true' }}" alt="user photo">
                    </button>
                </div>
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-neutral-100 rounded-lg shadow-xl border border-neutral-100 w-56" id="dropdown-user">
                    <div class="px-4 py-3 bg-neutral-50 rounded-t-lg" role="none">
                        <p class="text-sm font-semibold text-neutral-900" role="none">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-neutral-500 truncate font-medium" role="none">{{ Auth::user()->email }}</p>
                    </div>
                    <ul class="py-1" role="none">
                        <li>
                            <a href="{{ route('admin.profil.edit') }}" class="block px-4 py-2 text-sm text-neutral-700 hover:bg-primary-50 hover:text-primary-600 transition-colors" role="menuitem">
                                <i class="fa-solid fa-user mr-2 text-neutral-400"></i> Profil Saya
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-rose-600 hover:bg-rose-50 transition-colors" role="menuitem">
                                    <i class="fa-solid fa-right-from-bracket mr-2 text-rose-400"></i> Sign out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-neutral-200 sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full pb-4 overflow-y-auto flex flex-col justify-between font-sans custom-scrollbar px-3">
        
        <ul class="space-y-1 font-medium">
            
            <div class="px-3 mb-2 mt-2 text-[11px] font-bold text-neutral-400 uppercase tracking-widest">
                Main Menu
            </div>

            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group
                   {{ request()->routeIs('admin.dashboard') 
                       ? 'bg-primary-50 text-primary-700 font-semibold shadow-sm ring-1 ring-primary-100' 
                       : 'text-neutral-600 hover:bg-neutral-50 hover:text-primary-600' }}">
                    
                    <i class="fa-solid fa-house w-5 text-center text-[18px] transition duration-200 
                       {{ request()->routeIs('admin.dashboard') ? 'text-primary-600' : 'text-neutral-400 group-hover:text-primary-500' }}"></i>
                    <span class="flex-1 whitespace-nowrap tracking-wide">Dashboard</span>
                </a>
            </li>

            <li x-data="{ open: {{ request()->routeIs('admin.pendaftaran.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" 
                        class="flex items-center w-full px-3 py-2.5 rounded-lg transition-all duration-200 group justify-between
                        {{ request()->routeIs('admin.pendaftaran.*') 
                            ? 'bg-primary-50 text-primary-700 font-semibold ring-1 ring-primary-100' 
                            : 'text-neutral-600 hover:bg-neutral-50 hover:text-primary-600' }}">
                    
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-users w-5 text-center text-[18px] transition duration-200 
                           {{ request()->routeIs('admin.pendaftaran.*') ? 'text-primary-600' : 'text-neutral-400 group-hover:text-primary-500' }}"></i>
                        <span class="flex-1 whitespace-nowrap tracking-wide">Data Pendaftar</span>
                    </div>
                    
                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform duration-200 opacity-50 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <ul x-show="open" 
                    x-collapse
                    class="mt-1 space-y-1 pl-2">
                    
                    <li>
                        <a href="{{ route('admin.pendaftaran.semua') }}" 
                           class="flex items-center w-full py-2 px-3 rounded-lg text-sm transition-all duration-200 group
                           {{ request()->routeIs('admin.pendaftaran.semua') 
                               ? 'text-primary-700 bg-primary-50/50 font-medium' 
                               : 'text-neutral-500 hover:text-primary-600 hover:bg-neutral-50' }}">
                           <span class="w-1.5 h-1.5 rounded-full mr-3 {{ request()->routeIs('admin.pendaftaran.semua') ? 'bg-primary-500' : 'bg-neutral-300 group-hover:bg-primary-400' }}"></span>
                           Semua Pendaftar
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pendaftaran.masuk') }}" 
                           class="flex items-center w-full py-2 px-3 rounded-lg text-sm transition-all duration-200 group
                           {{ request()->routeIs('admin.pendaftaran.masuk') 
                               ? 'text-yellow-700 bg-yellow-50 font-medium' 
                               : 'text-neutral-500 hover:text-yellow-600 hover:bg-yellow-50' }}">
                           <span class="w-1.5 h-1.5 rounded-full mr-3 {{ request()->routeIs('admin.pendaftaran.masuk') ? 'bg-yellow-500' : 'bg-neutral-300 group-hover:bg-yellow-400' }}"></span>
                           Masuk / Pending
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pendaftaran.diterima') }}" 
                           class="flex items-center w-full py-2 px-3 rounded-lg text-sm transition-all duration-200 group
                           {{ request()->routeIs('admin.pendaftaran.diterima') 
                               ? 'text-primary-700 bg-primary-50 font-medium' 
                               : 'text-neutral-500 hover:text-primary-600 hover:bg-primary-50' }}">
                           <span class="w-1.5 h-1.5 rounded-full mr-3 {{ request()->routeIs('admin.pendaftaran.diterima') ? 'bg-primary-500' : 'bg-neutral-300 group-hover:bg-primary-400' }}"></span>
                           Diterima
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pendaftaran.ditolak') }}" 
                           class="flex items-center w-full py-2 px-3 rounded-lg text-sm transition-all duration-200 group
                           {{ request()->routeIs('admin.pendaftaran.ditolak') 
                               ? 'text-rose-700 bg-rose-50 font-medium' 
                               : 'text-neutral-500 hover:text-rose-600 hover:bg-rose-50' }}">
                           <span class="w-1.5 h-1.5 rounded-full mr-3 {{ request()->routeIs('admin.pendaftaran.ditolak') ? 'bg-rose-500' : 'bg-neutral-300 group-hover:bg-rose-400' }}"></span>
                           Ditolak
                        </a>
                    </li>
                </ul>
            </li>

            <div class="px-3 mb-2 mt-6 text-[11px] font-bold text-neutral-400 uppercase tracking-widest">
                Konfigurasi
            </div>

            <li>
                <a href="{{ route('admin.pengaturan.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group
                   {{ request()->routeIs(['admin.pengaturan.*', 'admin.jadwal.*']) 
                       ? 'bg-primary-50 text-primary-700 font-semibold shadow-sm ring-1 ring-primary-100' 
                       : 'text-neutral-600 hover:bg-neutral-50 hover:text-primary-600' }}">
                    
                    <i class="fa-solid fa-sliders w-5 text-center text-[18px] transition duration-200 
                       {{ request()->routeIs(['admin.pengaturan.*', 'admin.jadwal.*']) ? 'text-primary-600' : 'text-neutral-400 group-hover:text-primary-500' }}"></i>
                    <span class="flex-1 whitespace-nowrap tracking-wide">Pengaturan Sistem</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.kontak.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group
                   {{ request()->routeIs('admin.kontak.*') 
                       ? 'bg-primary-50 text-primary-700 font-semibold shadow-sm ring-1 ring-primary-100' 
                       : 'text-neutral-600 hover:bg-neutral-50 hover:text-primary-600' }}">
                    
                    <i class="fa-solid fa-address-book w-5 text-center text-[18px] transition duration-200 
                       {{ request()->routeIs('admin.kontak.*') ? 'text-primary-600' : 'text-neutral-400 group-hover:text-primary-500' }}"></i>
                    <span class="flex-1 whitespace-nowrap tracking-wide">Informasi Kontak</span>
                </a>
            </li>

        </ul>

        <div class="px-3 pb-6 mt-4 border-t border-neutral-200 pt-6">
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit"
                        class="flex items-center gap-3 px-3 py-2.5 w-full text-left transition-all duration-200 text-neutral-500 hover:bg-rose-50 hover:text-rose-600 rounded-lg group">
                    <i class="fa-solid fa-right-from-bracket w-5 text-center text-[18px] transition group-hover:translate-x-1"></i>
                    <span class="font-medium tracking-wide">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>