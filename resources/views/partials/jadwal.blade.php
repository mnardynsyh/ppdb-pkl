<section class="bg-white py-16">
  <div class="w-full px-4 sm:px-8 lg:px-16">
    <h2 class="text-4xl font-bold text-center mb-12">Jadwal Pendaftaran</h2>

    <ol class="relative border-l border-gray-300 ml-8 sm:ml-12 lg:ml-0">                  
      <!-- Item 1 -->
      <li class="mb-10 ml-6 lg:ml-6 opacity-0 transition-opacity duration-700 ease-in-out" data-fade>
        <span class="absolute -left-3 lg:-left-3 flex items-center justify-center w-6 h-6 bg-blue-600 rounded-full text-white text-xs font-bold">
          1
        </span>
        <h3 class="font-semibold text-lg">Pembukaan Pendaftaran</h3>
        <time class="block mb-2 text-sm text-gray-500">1 September 2025</time>
        <p class="text-gray-600">Calon peserta mulai dapat mengisi formulir dan mengunggah dokumen yang diperlukan.</p>
      </li>

      <!-- Item 2 -->
      <li class="mb-10 ml-6 lg:ml-6 opacity-0 transition-opacity duration-700 ease-in-out" data-fade>
        <span class="absolute -left-3 lg:-left-3 flex items-center justify-center w-6 h-6 bg-blue-600 rounded-full text-white text-xs font-bold">
          2
        </span>
        <h3 class="font-semibold text-lg">Seleksi Administrasi</h3>
        <time class="block mb-2 text-sm text-gray-500">5 - 10 September 2025</time>
        <p class="text-gray-600">Panitia akan memverifikasi dokumen yang telah diunggah oleh pendaftar.</p>
      </li>

      <!-- Item 3 -->
      <li class="mb-10 ml-6 lg:ml-6 opacity-0 transition-opacity duration-700 ease-in-out" data-fade>
        <span class="absolute -left-3 lg:-left-3 flex items-center justify-center w-6 h-6 bg-blue-600 rounded-full text-white text-xs font-bold">
          3
        </span>
        <h3 class="font-semibold text-lg">Pengumuman Hasil Seleksi</h3>
        <time class="block mb-2 text-sm text-gray-500">15 September 2025</time>
        <p class="text-gray-600">Hasil seleksi akan diumumkan melalui website resmi PPDB.</p>
      </li>

      <!-- Item 4 -->
      <li class="ml-6 lg:ml-6 opacity-0 transition-opacity duration-700 ease-in-out" data-fade>
        <span class="absolute -left-3 lg:-left-3 flex items-center justify-center w-6 h-6 bg-blue-600 rounded-full text-white text-xs font-bold">
          4
        </span>
        <h3 class="font-semibold text-lg">Daftar Ulang</h3>
        <time class="block mb-2 text-sm text-gray-500">20 - 25 September 2025</time>
        <p class="text-gray-600">Peserta yang lolos seleksi wajib melakukan daftar ulang dengan membawa dokumen asli.</p>
      </li>
    </ol>
  </div>
</section>

<script>
  const fadeItems = document.querySelectorAll("[data-fade]");

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.remove("opacity-0");
        entry.target.classList.add("opacity-100");
      }
    });
  }, { threshold: 0.1 });

  fadeItems.forEach(item => observer.observe(item));
</script>
