<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                </button>
                <a href="{{ route('admin.dashboard') }}" class="flex ms-2 md:me-24">
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-gray-900">PPDB Online</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button" class="flex text-sm bg-gray-200 rounded-full focus:ring-4 focus:ring-blue-300" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full object-cover" 
                                src="{{ Auth::user()->foto ? Storage::url(Auth::user()->foto) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=3B82F6&color=FFFFFF' }}" 
                                alt="user photo">
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-lg border border-gray-100" id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900" role="none">
                            {{ Auth::user()->name }}
                            </p>
                            <p class="text-sm font-medium text-gray-600 truncate" role="none">
                            {{ Auth::user()->email }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="{{ route('admin.profil.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">
                                    Profil Saya
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit"
                                            class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            role="menuitem">
                                    Sign out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-gradient-to-b from-slate-900 to-slate-800 border-r border-slate-700 sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto">
        <ul class="space-y-1 font-medium">
            {{-- Link Dashboard --}}
            <li>
                <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-4 py-2 transition-all duration-200 rounded-r-lg
                {{ request()->routeIs('admin.dashboard') 
                    ? 'text-white bg-blue-500/10 border-l-4 border-blue-500 font-medium' 
                    : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                    <i class="fa-solid fa-house w-5 text-center {{ request()->routeIs('admin.dashboard') ? 'text-blue-400' : 'text-slate-400' }}"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            {{-- Dropdown Manajemen Pendaftar --}}
            <div x-data="{ open: {{ request()->routeIs('admin.pendaftaran.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" 
                        class="flex items-center justify-between gap-3 px-4 py-3 rounded-r-lg w-full text-left transition-all duration-200
                        {{ request()->routeIs('admin.pendaftaran.*') 
                            ? 'text-white bg-blue-500/10 border-l-4 border-blue-500 font-medium' 
                            : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-users w-5 text-center {{ request()->routeIs('admin.pendaftaran.*') ? 'text-blue-400' : 'text-slate-400' }}"></i>
                        <span>Manajemen Pendaftar</span>
                    </span>
                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transform transition-transform {{ request()->routeIs('admin.pendaftaran.*') ? 'text-blue-400' : 'text-slate-400' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="open" x-transition class="mt-1 ml-4 pl-3 border-l border-slate-600 flex flex-col space-y-1">
                    <a href="{{ route('admin.pendaftaran.semua') }}" 
                    class="flex items-center gap-3 px-4 py-2 rounded-r text-sm transition-all duration-200
                    {{ request()->routeIs('admin.pendaftaran.semua') 
                        ? 'text-white bg-blue-500/10 border-l-4 border-blue-500 font-medium' 
                        : 'text-slate-400 hover:bg-slate-700/50 hover:text-white' }}">
                        <i class="fa-solid fa-folder-tree w-4 text-center {{ request()->routeIs('admin.pendaftaran.semua') ? 'text-blue-400' : 'text-slate-500' }}"></i>
                        <span>Semua Pendaftar</span>
                    </a>
                    <a href="{{ route('admin.pendaftaran.masuk') }}" 
                    class="flex items-center gap-3 px-4 py-2 rounded-r text-sm transition-all duration-200
                    {{ request()->routeIs('admin.pendaftaran.masuk') 
                        ? 'text-white bg-blue-500/10 border-l-4 border-blue-500 font-medium' 
                        : 'text-slate-400 hover:bg-slate-700/50 hover:text-white' }}">
                        <i class="fa-solid fa-inbox w-4 text-center {{ request()->routeIs('admin.pendaftaran.masuk') ? 'text-blue-400' : 'text-slate-500' }}"></i>
                        <span>Pendaftar Masuk</span>
                    </a>
                    <a href="{{ route('admin.pendaftaran.diterima') }}" 
                    class="flex items-center gap-3 px-4 py-2 rounded-r text-sm transition-all duration-200
                    {{ request()->routeIs('admin.pendaftaran.diterima') 
                        ? 'text-white bg-blue-500/10 border-l-4 border-blue-500 font-medium' 
                        : 'text-slate-400 hover:bg-slate-700/50 hover:text-white' }}">
                        <i class="fa-solid fa-check-circle w-4 text-center {{ request()->routeIs('admin.pendaftaran.diterima') ? 'text-blue-400' : 'text-slate-500' }}"></i>
                        <span>Pendaftar Diterima</span>
                    </a>
                    <a href="{{ route('admin.pendaftaran.ditolak') }}" 
                    class="flex items-center gap-3 px-4 py-2 rounded-r text-sm transition-all duration-200
                    {{ request()->routeIs('admin.pendaftaran.ditolak') 
                        ? 'text-white bg-blue-500/10 border-l-4 border-blue-500 font-medium' 
                        : 'text-slate-400 hover:bg-slate-700/50 hover:text-white' }}">
                        <i class="fa-solid fa-times-circle w-4 text-center {{ request()->routeIs('admin.pendaftaran.ditolak') ? 'text-blue-400' : 'text-slate-500' }}"></i>
                        <span>Pendaftar Ditolak</span>
                    </a>
                </div>
            </div>

            {{-- Dropdown Pengaturan --}}
            <div x-data="{ open: {{ request()->routeIs(['admin.pengaturan.*', 'admin.jadwal.*']) ? 'true' : 'false' }} }">
                <button @click="open = !open" 
                        class="flex items-center justify-between gap-3 px-4 py-3 rounded-r-lg w-full text-left transition-all duration-200
                        {{ request()->routeIs(['admin.pengaturan.*', 'admin.jadwal.*']) 
                            ? 'text-white bg-blue-500/10 border-l-4 border-blue-500 font-medium' 
                            : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-gears w-5 text-center {{ request()->routeIs(['admin.pengaturan.*', 'admin.jadwal.*']) ? 'text-blue-400' : 'text-slate-400' }}"></i>
                        <span>Pengaturan</span>
                    </span>
                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transform transition-transform {{ request()->routeIs(['admin.pengaturan.*', 'admin.jadwal.*']) ? 'text-blue-400' : 'text-slate-400' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="open" x-transition class="mt-1 ml-4 pl-3 border-l border-slate-600 flex flex-col space-y-1">
                    <a href="{{ route('admin.pengaturan.index') }}" 
                    class="flex items-center gap-3 px-4 py-2 rounded-r text-sm transition-all duration-200
                    {{ request()->routeIs('admin.pengaturan.*') 
                        ? 'text-white bg-blue-500/10 border-l-4 border-blue-500 font-medium' 
                        : 'text-slate-400 hover:bg-slate-700/50 hover:text-white' }}">
                        <i class="fa-solid fa-toggle-on w-4 text-center {{ request()->routeIs('admin.pengaturan.*') ? 'text-blue-400' : 'text-slate-500' }}"></i>
                        <span>Status Pendaftaran</span>
                    </a>
                    <a href="{{ route('admin.jadwal.index') }}" 
                    class="flex items-center gap-3 px-4 py-2 rounded-r text-sm transition-all duration-200
                    {{ request()->routeIs('admin.jadwal.*') 
                        ? 'text-white bg-blue-500/10 border-l-4 border-blue-500 font-medium' 
                        : 'text-slate-400 hover:bg-slate-700/50 hover:text-white' }}">
                        <i class="fa-solid fa-calendar-alt w-4 text-center {{ request()->routeIs('admin.jadwal.*') ? 'text-blue-400' : 'text-slate-500' }}"></i>
                        <span>Jadwal Pendaftaran</span>
                    </a>
                </div>
            </div>

            {{-- Menu Logout --}}
            <li class="pt-4 mt-4 border-t border-slate-700">
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit"
                            class="flex items-center gap-3 px-4 py-3 w-full text-left transition-all duration-200 text-slate-300 hover:bg-slate-700/50 hover:text-white rounded-r-lg">
                        <i class="fa-solid fa-right-from-bracket w-5 text-center text-slate-400"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>