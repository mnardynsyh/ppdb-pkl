<nav class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="{{ route('siswa.dashboard') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
      <span class="self-center text-2xl font-semibold whitespace-nowrap">PPDB Online</span>
    </a>
    
    {{-- User Profile Dropdown & Sapaan --}}
    <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
        {{-- Sapaan personal (hanya tampil di desktop) --}}
        <span class="hidden sm:inline text-sm text-gray-600 mr-3">Halo, {{ Auth::user()->nama_lengkap }}</span>

        <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
            <span class="sr-only">Open user menu</span>
            {{-- Foto profil dinamis dengan fallback --}}
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
                <form action="{{ route('siswa.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                      Logout
                    </button>
                </form>
              </li>
            </ul>
        </div>
        {{-- Tombol Hamburger untuk Mobile --}}
        <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-user" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/></svg>
        </button>
    </div>
    
  </div>
</nav>

