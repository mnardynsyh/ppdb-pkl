<nav x-data="{ mobileMenuOpen: false }" class="bg-[#fefae0]/80 backdrop-blur-sm border-b border-[#606c38]/20 shadow-sm sticky top-0 z-50" style="font-family: 'Poppins', sans-serif;">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

    <!-- Logo / Brand Name -->
    <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
      <span class="self-center text-2xl font-semibold whitespace-nowrap text-[#283618]">PPDB Online</span>
    </a>

    <!-- Tombol Aksi (Kanan) & Hamburger Menu -->
    <div class="flex items-center md:order-2 space-x-2 rtl:space-x-reverse">
      <a href="{{ route('siswa.login') }}" class="hidden sm:inline-block text-[#283618] hover:bg-[#dda15e]/40 focus:ring-4 focus:ring-[#dda15e]/50 font-medium rounded-lg text-sm px-4 py-2 text-center transition-colors">
        Masuk
      </a>
      <a href="{{ route('siswa.register') }}" class="text-white bg-[#bc6c25] hover:bg-[#a55d20] focus:ring-4 focus:outline-none focus:ring-[#dda15e]/80 font-medium rounded-lg text-sm px-4 py-2 text-center transition-colors">
        Daftar Sekarang
      </a>
      <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-[#606c38] rounded-lg md:hidden hover:bg-[#dda15e]/40 focus:outline-none focus:ring-2 focus:ring-[#dda15e]/50" aria-controls="navbar-menu" :aria-expanded="mobileMenuOpen">
        <span class="sr-only">Buka menu utama</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
      </button>
    </div>

    <!-- Menu Utama (Tengah) -->
    <div :class="{'block': mobileMenuOpen, 'hidden': !mobileMenuOpen}" class="items-center justify-between w-full md:flex md:w-auto md:order-1" id="navbar-menu">
      <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-[#606c38]/20 rounded-lg bg-[#fefae0]/95 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent">
        
        <!-- Menu Beranda -->
        <li>
          <a href="{{ route('home') }}" class="block py-2 px-3 rounded md:p-0 {{ request()->routeIs('home') ? 'text-white bg-[#bc6c25] md:bg-transparent md:text-[#bc6c25] font-semibold' : 'text-[#283618] hover:bg-[#dda15e]/40 md:hover:bg-transparent md:hover:text-[#bc6c25]' }}" aria-current="page">Beranda</a>
        </li>

        <!-- Dropdown Informasi Pendaftaran -->
        <li x-data="{ open: false }" class="relative">
          <button @click="open = !open" @click.away="open = false" class="flex items-center justify-between w-full py-2 px-3 text-[#283618] rounded hover:bg-[#dda15e]/40 md:hover:bg-transparent md:border-0 md:hover:text-[#bc6c25] md:p-0 md:w-auto">
            Informasi Pendaftaran
            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
          </button>
          <!-- Dropdown menu -->
          <div x-show="open" x-transition class="absolute mt-2 z-10 font-normal bg-[#fefae0] divide-y divide-[#606c38]/20 rounded-lg shadow-lg w-44">
            <ul class="py-2 text-sm text-[#283618]" aria-labelledby="dropdownLargeButton">
              <li><a href="{{ url('/#alur-pendaftaran') }}" class="block px-4 py-2 hover:bg-[#dda15e]/40">Alur Pendaftaran</a></li>
              <li><a href="{{ url('/#jadwal-penting') }}" class="block px-4 py-2 hover:bg-[#dda15e]/40">Jadwal Penting</a></li>
              <li><a href="{{ url('/#persyaratan') }}" class="block px-4 py-2 hover:bg-[#dda15e]/40">Persyaratan & Dokumen</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-[#dda15e]/40">Biaya Pendidikan</a></li>
            </ul>
          </div>
        </li>

        <!-- Dropdown Profil Sekolah -->
        <li x-data="{ open: false }" class="relative">
          <button @click="open = !open" @click.away="open = false" class="flex items-center justify-between w-full py-2 px-3 text-[#283618] rounded hover:bg-[#dda15e]/40 md:hover:bg-transparent md:border-0 md:hover:text-[#bc6c25] md:p-0 md:w-auto">
            Profil Sekolah
            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
          </button>
          <!-- Dropdown menu -->
          <div x-show="open" x-transition class="absolute mt-2 z-10 font-normal bg-[#fefae0] divide-y divide-[#606c38]/20 rounded-lg shadow-lg w-44">
            <ul class="py-2 text-sm text-[#283618]" aria-labelledby="dropdownLargeButton">
              <li><a href="#" class="block px-4 py-2 hover:bg-[#dda15e]/40">Tentang Kami</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-[#dda15e]/40">Visi & Misi</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-[#dda15e]/40">Program Unggulan</a></li>
            </ul>
          </div>
        </li>

        <!-- Menu FAQ -->
        <li>
          <a href="{{ url('/#faq') }}" class="block py-2 px-3 text-[#283618] rounded hover:bg-[#dda15e]/40 md:hover:bg-transparent md:border-0 md:hover:text-[#bc6c25] md:p-0">FAQ</a>
        </li>
      </ul>
    </div>
  </div>
</nav>