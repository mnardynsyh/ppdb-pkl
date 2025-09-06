
<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
        <a href="https://flowbite.com" class="flex ms-2 md:me-24">
          <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">PPDB Online</span>
        </a>
      </div>
      <div class="flex items-center">
          <div class="flex items-center ms-3">
            <div>
              <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
              </button>
            </div>
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
              <div class="px-4 py-3" role="none">
                <p class="text-sm text-gray-900 dark:text-white" role="none">
                  Neil Sims
                </p>
                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                  neil.sims@flowbite.com
                </p>
              </div>
              <ul class="py-1" role="none">
              <li>
                <a href="{{ route('admin.dashboard') }}"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                  role="menuitem">
                  Dashboard
                </a>
              </li>

              <li>
                <form action="{{ route('admin.logout') }}" method="POST">
                  @csrf
                  <button type="submit"
                          class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
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

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="{{ route('admin.dashboard') }}"
              class="flex items-center p-2 rounded-lg hover:bg-gray-100 hover:text-gray-800
              {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 text-gray-900' : 'text-gray-500' }}">
                
                <svg class="w-5 h-5 transition duration-75"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 
                            8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                    <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975
                            a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565
                            A8.51 8.51 0 0 0 12.5 0Z"/>
              </svg>

              <span class="ms-3">Dashboard</span>
            </a>
        </li>
         <li>
            <button 
                type="button" 
                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group 
                    hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" 
                aria-controls="dropdown-data" 
                data-collapse-toggle="dropdown-data"
                onclick="document.getElementById('arrow-data').classList.toggle('rotate-180')">

                <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 
                    group-hover:text-gray-900 dark:group-hover:text-white" 
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" 
                    viewBox="0 0 18 18">
                    <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                </svg>

                <span class="flex-1 ms-3 text-left whitespace-nowrap">Master Data</span>

                <svg id="arrow-data" class="w-3 h-3 ms-auto transition-transform duration-300" aria-hidden="true" 
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" 
                        stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>

            <ul id="dropdown-data" class="hidden py-2 space-y-2">
              <li>
                  <a href="{{route ('admin.penghasilan.index')}}" class="flex items-center w-full p-2 pl-11 text-gray-900 transition duration-75 rounded-lg 
                      hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                      Penghasilan Ortu
                  </a>
              </li>
              <li>
                  <a href="{{route ('admin.pendidikan.index')}}" class="flex items-center w-full p-2 pl-11 text-gray-900 transition duration-75 rounded-lg 
                      hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                      Pendidikan Ortu
                  </a>
              </li>
                <li>
                    <a href="{{route ('admin.job.index')}}" class="flex items-center w-full p-2 pl-11 text-gray-900 transition duration-75 rounded-lg 
                        hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 @active('admin.job.index')">
                        Pekerjaan Ortu
                    </a>
                </li>
                <li>
                    <a href="{{route ('admin.agama.index')}}" class="flex items-center w-full p-2 pl-11 text-gray-900 transition duration-75 rounded-lg 
                        hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        Agama
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <button 
                type="button" 
                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group 
                    hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" 
                aria-controls="dropdown-siswa" 
                data-collapse-toggle="dropdown-siswa"
                onclick="document.getElementById('arrow-siswa').classList.toggle('rotate-180')">

                <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 
                    group-hover:text-gray-900 dark:group-hover:text-white" 
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" 
                    viewBox="0 0 18 18">
                    <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                </svg>

                <span class="flex-1 ms-3 text-left whitespace-nowrap">Manajemen Pendaftar</span>

                <svg id="arrow-siswa" class="w-3 h-3 ms-auto transition-transform duration-300" aria-hidden="true" 
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" 
                        stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>

            <ul id="dropdown-siswa" class="hidden py-2 space-y-2">
                <li>
                  <li>
                    <a href="{{ route('admin.pendaftaran.semua') }}" class="flex items-center w-full p-2 pl-11 text-gray-900 transition duration-75 rounded-lg 
                        hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        Semua Pendaftar
                    </a>
                </li>
                    <a href="{{ route('admin.pendaftaran.masuk') }}" class="flex items-center w-full p-2 pl-11 text-gray-900 transition duration-75 rounded-lg 
                        hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        Masuk
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pendaftaran.diterima') }}" class="flex items-center w-full p-2 pl-11 text-gray-900 transition duration-75 rounded-lg 
                        hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        Diterima
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pendaftaran.ditolak') }}" class="flex items-center w-full p-2 pl-11 text-gray-900 transition duration-75 rounded-lg 
                        hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        Ditolak
                    </a>
                </li>
            </ul>
        </li>

         <li>
            <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                    aria-controls="dropdown-pengaturan" data-collapse-toggle="dropdown-pengaturan">
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M18 7.5h-.423l-.452-1.09.3-.3a1.5 1.5 0 0 0 0-2.121L16.01 2.575a1.5 1.5 0 0 0-2.121 0l-.3.3-1.089-.452V2A1.5 1.5 0 0 0 11 .5H9A1.5 1.5 0 0 0 7.5 2v.423l-1.09.452-.3-.3a1.5 1.5 0 0 0-2.121 0L2.576 3.99a1.5 1.5 0 0 0 0 2.121l.3.3L2.423 7.5H2A1.5 1.5 0 0 0 .5 9v2A1.5 1.5 0 0 0 2 12.5h.423l.452 1.09-.3.3a1.5 1.5 0 0 0 0 2.121l1.414 1.414a1.5 1.5 0 0 0 2.121 0l.3-.3 1.09.452V18A1.5 1.5 0 0 0 9 19.5h2a1.5 1.5 0 0 0 1.5-1.5v-.423l1.09-.452.3.3a1.5 1.5 0 0 0 2.121 0l1.414-1.414a1.5 1.5 0 0 0 0-2.121l-.3-.3.452-1.09H18A1.5 1.5 0 0 0 19.5 11V9A1.5 1.5 0 0 0 18 7.5Zm-8 6a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7Z"/>
                </svg>
               <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Pengaturan</span>
               <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
               </svg>
            </button>
            <ul id="dropdown-pengaturan" class="hidden py-2 space-y-2">
               <li><a href="{{ route('admin.pengaturan.index') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Status Pendaftaran</a></li>
               <li><a href="{{ route('admin.jadwal.index')}}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Manajemen Jadwal</a></li>
               <li><a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Manajemen Pengguna</a></li>
            </ul>
         </li>
      </ul>
   </div>
</aside>


