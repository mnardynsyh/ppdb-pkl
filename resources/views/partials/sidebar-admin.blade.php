 
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
                    <form action="{{ route('admin.logout') }}" method="POST" class="w-full">
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

    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium">
            {{-- Link Dashboard --}}
            <li>
                <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-4 py-2 transition-colors duration-200 
                {{ request()->routeIs('admin.dashboard') 
                    ? 'bg-blue-50 text-blue-700 font-semibold border-l-4 border-blue-500' 
                    : 'text-gray-600 hover:bg-gray-100' }}">
                <i class="fa-solid fa-house w-5 text-center text-gray-400"></i>
                <span>Dashboard</span>
                </a>
            </li>
            
            {{-- Dropdown Master Data --}}
            <div x-data="{ open: {{ request()->routeIs(['admin.penghasilan.*', 'admin.job.*']) ? 'true' : 'false' }} }">
                <button @click="open = !open" 
                        class="flex items-center justify-between gap-3 px-4 py-2 rounded-lg w-full text-left transition-colors duration-200 
                        {{ request()->routeIs(['admin.penghasilan.*', 'admin.job.*']) ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100' }}">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-database w-5 text-center text-gray-500"></i>
                        <span>Master Data</span>
                    </span>
                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transform transition-transform text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div x-show="open" x-transition class="mt-1 ml-5 pl-3 border-l-2 border-gray-300 flex flex-col">
                <a href="{{route ('admin.penghasilan.index')}}" 
                    class="flex items-center gap-3 px-4 py-2 rounded text-sm transition-colors duration-200 
                    {{ request()->routeIs('admin.penghasilan.*') 
                        ? 'bg-blue-50 text-blue-700 font-semibold border-l-4 border-blue-500' 
                        : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                    <i class="fa-solid fa-dollar-sign w-4 text-center text-gray-400"></i>
                    <span>Penghasilan Ortu</span>
                </a>
                <a href="{{route ('admin.job.index')}}" 
                    class="flex items-center gap-3 px-4 py-2 rounded text-sm transition-colors duration-200 
                    {{ request()->routeIs('admin.job.*') 
                        ? 'bg-blue-50 text-blue-700 font-semibold border-l-4 border-blue-500' 
                        : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                    <i class="fa-solid fa-briefcase w-4 text-center text-gray-400"></i>
                    <span>Pekerjaan Ortu</span>
                </a>
                </div>
            </div>

            {{-- Dropdown Manajemen Pendaftar --}}
            <div x-data="{ open: {{ request()->routeIs('admin.pendaftaran.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" 
                        class="flex items-center justify-between gap-3 px-4 py-2 rounded-lg w-full text-left transition-colors duration-200 
                        {{ request()->routeIs('admin.pendaftaran.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100' }}">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-users w-5 text-center text-gray-500"></i>
                        <span>Manajemen Pendaftar</span>
                    </span>
                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transform transition-transform text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="open" x-transition class="mt-1 ml-5 pl-3 border-l-2 border-gray-300 flex flex-col">
                    <a href="{{ route('admin.pendaftaran.semua') }}" 
                    class="flex items-center gap-3 px-4 py-2 rounded text-sm transition-colors duration-200 
                    {{ request()->routeIs('admin.pendaftaran.semua') ? 'bg-blue-50 text-blue-700 font-semibold border-l-4 border-blue-500' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                    <i class="fa-solid fa-folder-tree w-4 text-center text-gray-400"></i>
                    <span>Semua Pendaftar</span>
                    </a>
                <a href="{{ route('admin.pendaftaran.masuk') }}" 
                    class="flex items-center gap-3 px-4 py-2 rounded text-sm transition-colors duration-200 
                    {{ request()->routeIs('admin.pendaftaran.masuk') ? 'bg-blue-50 text-blue-700 font-semibold border-l-4 border-blue-500' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                    <i class="fa-solid fa-inbox w-4 text-center text-gray-400"></i>
                    <span>Pendaftar Masuk</span>
                </a>
                <a href="{{ route('admin.pendaftaran.diterima') }}" 
                    class="flex items-center gap-3 px-4 py-2 rounded text-sm transition-colors duration-200 
                    {{ request()->routeIs('admin.pendaftaran.diterima') ? 'bg-blue-50 text-blue-700 font-semibold border-l-4 border-blue-500' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                    <i class="fa-solid fa-check-circle w-4 text-center text-gray-400"></i>
                    <span>Pendaftar Diterima</span>
                </a>
                <a href="{{ route('admin.pendaftaran.ditolak') }}" 
                    class="flex items-center gap-3 px-4 py-2 rounded text-sm transition-colors duration-200 
                    {{ request()->routeIs('admin.pendaftaran.ditolak') ? 'bg-blue-50 text-blue-700 font-semibold border-l-4 border-blue-500' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                    <i class="fa-solid fa-times-circle w-4 text-center text-gray-400"></i>
                    <span>Pendaftar Ditolak</span>
                </a>
                </div>
            </div>

            {{-- Dropdown Pengaturan --}}
            <div x-data="{ open: {{ request()->routeIs(['admin.pengaturan.*', 'admin.jadwal.*']) ? 'true' : 'false' }} }">
                <button @click="open = !open" 
                        class="flex items-center justify-between gap-3 px-4 py-2 rounded-lg w-full text-left transition-colors duration-200 
                        {{ request()->routeIs(['admin.pengaturan.*', 'admin.jadwal.*']) ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100' }}">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-gears w-5 text-center text-gray-500"></i>
                        <span>Pengaturan</span>
                    </span>
                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transform transition-transform text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="open" x-transition class="mt-1 ml-5 pl-3 border-l-2 border-gray-300 flex flex-col">
                <a href="{{ route('admin.pengaturan.index') }}" 
                    class="flex items-center gap-3 px-4 py-2 rounded text-sm transition-colors duration-200 
                    {{ request()->routeIs('admin.pengaturan.*') ? 'bg-blue-50 text-blue-700 font-semibold border-l-4 border-blue-500' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                    <i class="fa-solid fa-toggle-on w-4 text-center text-gray-400"></i>
                    <span>Status Pendaftaran</span>
                </a>
                <a href="{{ route('admin.jadwal.index') }}" 
                    class="flex items-center gap-3 px-4 py-2 rounded text-sm transition-colors duration-200 
                    {{ request()->routeIs('admin.jadwal.*') ? 'bg-blue-50 text-blue-700 font-semibold border-l-4 border-blue-500' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                    <i class="fa-solid fa-calendar-alt w-4 text-center text-gray-400"></i>
                    <span>Jadwal Pendaftaran</span>
                </a>
                {{-- Link Manajemen Pengguna yang duplikat telah dihapus --}}
                </div>
            </div>
        </ul>
    </div>
    </aside>

