<nav class="bg-white/80 backdrop-blur-sm border-b border-gray-200 shadow-sm sticky top-0 z-50">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    
    <a href="{{ route('siswa.dashboard') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
      <span class="self-center text-2xl font-semibold whitespace-nowrap">PPDB Online</span>
    </a>
    
    {{-- Menu Navigasi Utama (Desktop) --}}
    <div class="hidden md:flex md:w-auto md:order-1" id="navbar-default">
      <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-transparent">
        <li>
          <a href="{{ route('siswa.dashboard') }}" 
             class="block py-2 px-3 rounded-lg md:p-0 border-b-2
             {{ request()->routeIs('siswa.dashboard*') ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-700 hover:text-blue-600 hover:border-blue-600' }} 
             transition-colors duration-300" 
             aria-current="page">Dashboard</a>
        </li>
      </ul>
    </div>

    <div class="flex items-center md:order-2 space-x-3">
        <button type="button" class="flex items-center text-sm rounded-full focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
            <span class="sr-only">Open user menu</span>
            <span class="hidden sm:inline text-sm text-gray-600 mr-3">Halo, {{ strtok(Auth::user()->nama_lengkap, ' ') }}</span>
            <img class="w-8 h-8 rounded-full object-cover" 
                 src="{{ Auth::user()->pas_foto ? Storage::url(Auth::user()->pas_foto) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->nama_lengkap) }}" 
                 alt="Foto Profil">
        </button>
        <!-- Dropdown menu -->
        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow" id="user-dropdown">
            <div class="px-4 py-3">
              <span class="block text-sm text-gray-900">{{ Auth::user()->nama_lengkap }}</span>
              <span class="block text-sm text-gray-500 truncate">{{ Auth::user()->email }}</span>
            </div>
            <ul class="py-2" aria-labelledby="user-menu-button">
              <li>
                <button @click="profileModalOpen = true" class="w-full flex items-center gap-2 text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span>Profil Saya</span>
                </button>
              </li>
              <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span>Logout</span>
                    </button>
                </form>
              </li>
            </ul>
        </div>

        <button data-collapse-toggle="navbar-mobile-menu" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100" aria-controls="navbar-mobile-menu" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" fill="none" viewBox="0 0 17 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/></svg>
        </button>
    </div>
    
    {{-- Menu Navigasi Mobile --}}
    <div class="items-center justify-between hidden w-full md:hidden" id="navbar-mobile-menu">
      <ul class="flex flex-col font-medium p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50">
        <li>
          <a href="{{ route('siswa.dashboard') }}" class="block py-2 px-3 rounded-lg 
             {{ request()->routeIs('siswa.dashboard*') ? 'bg-blue-600 text-white' : 'text-gray-900 hover:bg-gray-100' }}" 
             aria-current="page">Dashboard</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

