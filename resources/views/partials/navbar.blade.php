<nav x-data="{ mobileMenuOpen: false }" class="bg-white/80 backdrop-blur-sm border-b border-slate-200 sticky top-0 z-50" style="font-family: 'Poppins', sans-serif;">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

    <!-- Logo / Brand Name -->
    <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
      <span class="self-center text-2xl font-semibold whitespace-nowrap text-slate-800">PPDB Online</span>
    </a>

    <!-- Tombol Aksi (Kanan) & Hamburger Menu -->
    <div class="flex items-center md:order-2 space-x-2 rtl:space-x-reverse">
      {{-- Tombol "Masuk" dengan gaya sekunder (outline) berwarna Indigo --}}
      <a href="{{ route('login') }}" class="hidden sm:inline-block text-indigo-600 hover:bg-indigo-50 border border-indigo-600 font-medium rounded-lg text-sm px-4 py-2 text-center transition-colors duration-300">
        Masuk
      </a>
      {{-- Tombol "Daftar Sekarang" dengan warna aksen Teal yang menonjol --}}
      <a href="{{ route('register.siswa') }}" class="text-white bg-teal-500 hover:bg-teal-600 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-4 py-2 text-center transition-colors duration-300">
        Daftar Sekarang
      </a>
      {{-- Ikon hamburger --}}
      <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-slate-500 rounded-lg md:hidden hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-slate-200" aria-controls="navbar-menu" :aria-expanded="mobileMenuOpen">
        <span class="sr-only">Buka menu utama</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
      </button>
    </div>

    <!-- Menu Utama (Tengah) -->
    <div :class="{'block': mobileMenuOpen, 'hidden': !mobileMenuOpen}" class="items-center justify-between w-full md:flex md:w-auto md:order-1" id="navbar-menu">
      <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-slate-100 rounded-lg bg-slate-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent">
        
        <!-- Menu Beranda -->
        <li>
          <a href="{{ route('home') }}" class="block py-2 px-3 rounded md:p-0 transition-colors {{ request()->routeIs('home') ? 'text-indigo-600 font-semibold' : 'text-slate-700 hover:text-indigo-600' }}" aria-current="page">Beranda</a>
        </li>

        <!-- Dropdown Informasi Pendaftaran -->
        <li x-data="{ open: false }" class="relative">
          <button @click="open = !open" @click.away="open = false" class="flex items-center justify-between w-full py-2 px-3 text-slate-700 hover:text-indigo-600 rounded md:border-0 md:p-0 md:w-auto transition-colors">
            Informasi Pendaftaran
            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
          </button>
          <!-- Dropdown menu -->
          <div x-show="open" x-transition class="absolute mt-2 z-10 font-normal bg-white divide-y divide-slate-100 rounded-lg shadow-lg w-44 border border-slate-100">
            <ul class="py-2 text-sm text-slate-700" aria-labelledby="dropdownLargeButton">
              <li><a href="{{ url('/#alur') }}" class="block px-4 py-2 hover:bg-slate-100">Alur Pendaftaran</a></li>
              <li><a href="{{ route('jadwal') }}" class="block px-4 py-2 hover:bg-slate-100">Jadwal Penting</a></li>
              <li><a href="{{ url('/#persyaratan') }}" class="block px-4 py-2 hover:bg-slate-100">Persyaratan & Dokumen</a></li>
            </ul>
          </div>
        </li>

        <!-- Dropdown Profil Sekolah -->
        <li x-data="{ open: false }" class="relative">
          <button @click="open = !open" @click.away="open = false" class="flex items-center justify-between w-full py-2 px-3 text-slate-700 hover:text-indigo-600 rounded md:border-0 md:p-0 md:w-auto transition-colors">
            Profil Sekolah
            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
          </button>
          <!-- Dropdown menu -->
          <div x-show="open" x-transition class="absolute mt-2 z-10 font-normal bg-white divide-y divide-slate-100 rounded-lg shadow-lg w-44 border border-slate-100">
            <ul class="py-2 text-sm text-slate-700" aria-labelledby="dropdownLargeButton">
              <li><a href="#" class="block px-4 py-2 hover:bg-slate-100">Tentang Kami</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-slate-100">Visi & Misi</a></li>
              <li><a href="{{ route('kontak')}}" class="block px-4 py-2 hover:bg-slate-100">Kontak Kami</a></li>
            </ul>
          </div>
        </li>

        <!-- Menu FAQ -->
        <li>
          <a href="{{ url('/#faq') }}" class="block py-2 px-3 rounded md:p-0 text-slate-700 hover:text-indigo-600 transition-colors">FAQ</a>
        </li>
      </ul>
    </div>
  </div>
</nav>