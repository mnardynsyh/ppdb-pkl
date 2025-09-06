<section class="bg-white py-16">
  <div class="w-full px-4 sm:px-8 lg:px-16">
    <h2 class="text-4xl font-bold text-center mb-12">Jadwal Pendaftaran</h2>

    {{-- Memeriksa apakah ada data jadwal sebelum menampilkan timeline --}}
    @if($jadwals->count() > 0)
      <ol class="relative border-l border-gray-300 ml-8 sm:ml-12 lg:ml-0">              
        {{-- Melakukan perulangan untuk setiap item jadwal dari database --}}
        @foreach($jadwals as $jadwal)
          <li class="mb-10 ml-6 lg:ml-6 opacity-0 transition-opacity duration-700 ease-in-out" data-fade>
            <span class="absolute -left-3 lg:-left-3 flex items-center justify-center w-6 h-6 bg-blue-600 rounded-full text-white text-xs font-bold">
              {{ $loop->iteration }}
            </span>
            <h3 class="font-semibold text-lg">{{ $jadwal->title }}</h3>
            <time class="block mb-2 text-sm text-gray-500">{{ $jadwal->date_range }}</time>
            <p class="text-gray-600">{{ $jadwal->description }}</p>
          </li>
        @endforeach
      </ol>
    @else
      {{-- Tampilan jika tidak ada jadwal yang diatur oleh admin --}}
      <p class="text-center text-gray-500">Jadwal pendaftaran akan segera diumumkan.</p>
    @endif
  </div>
</section>

<script>
  // Script Intersection Observer Anda tetap sama dan akan berfungsi dengan konten dinamis
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

