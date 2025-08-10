@extends('layouts.app')

@section('title', 'PPDB Online')

@section('content')

<section 
  style="background-image: url('{{ asset('img/bg-sekolah.jpg') }}')" 
  class="bg-cover bg-center bg-no-repeat w-full h-[90vh] sm:h-[90vh] min-h-[500px] relative"
>
  <!-- Overlay -->
  <div class="absolute inset-0 bg-black bg-opacity-70"></div>

  <!-- Konten -->
  <div class="relative z-10 px-4 mx-auto max-w-screen-xl text-center py-16 sm:py-24 lg:py-40">
    <h1 class="mb-4 text-3xl sm:text-4xl md:text-5xl lg:text-5xl font-extrabold tracking-tight leading-tight text-white">
      Selamat Datang di PPDB Online <br>
      SMK Muhammadiyah Bumiayu
    </h1>
    
    <p class="mb-8 text-sm sm:text-base lg:text-xl font-normal text-gray-300 sm:px-10 lg:px-48">
      Daftarkan dirimu sekarang untuk bergabung bersama sekolah unggulan kami!
    </p>

    <!-- Tombol -->
    <div class="flex flex-col space-y-3 sm:flex-row sm:justify-center sm:space-y-0">
      <a 
        href="/daftar" 
        class="inline-flex justify-center items-center py-2 px-4 text-sm sm:text-base font-medium text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300"
      >
        Daftar Sekarang
        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
        </svg>
      </a>
      
      <a 
        href="#alur" 
        class="inline-flex justify-center items-center py-2 px-4 sm:ms-4 text-sm sm:text-base font-medium text-white rounded-lg border border-white hover:bg-gray-100 hover:text-gray-900"
      >Alur Pendaftaran
      </a>
    </div>
  </div>
</section>

<section class="max-w-full mx-auto p-4 bg-gray-100">
    <h2 class="text-3xl text-center font-bold mb-6 py-2 bg-blue-200 rounded-lg">Alur Pendaftaran PPDB</h2>

    <div id="alurAccordion" data-accordion="collapse" class="space-y-2">
        
        <!-- Tahap 1 -->
        <div class="border rounded-lg">
            <h2>
                <button type="button" class="flex items-center justify-between w-full p-4 font-medium text-left text-gray-500 border-b border-gray-200 rounded-t-lg hover:bg-gray-100"
                    data-accordion-target="#tahap1" aria-expanded="false" aria-controls="tahap1">
                    <span>Tahap 1: Pra-Pendaftaran & Pembuatan Akun</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-0 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </h2>
            <div id="tahap1" class="hidden p-4 border-b border-gray-200">
                <p><strong>Mengunjungi Website PPDB:</strong> Buka alamat website PPDB resmi sekolah.</p>
                <p><strong>Mencari Informasi:</strong> Baca jadwal, persyaratan dokumen, dan alur pendaftaran.</p>
                <p><strong>Membuat Akun:</strong> Isi NISN, email aktif, password, lalu verifikasi via email.</p>
                <p><strong>Hasil:</strong> Akun siap digunakan untuk login.</p>
            </div>
        </div>

        <!-- Tahap 2 -->
        <div class="border rounded-lg">
            <h2>
                <button type="button" class="flex items-center justify-between w-full p-4 font-medium text-left text-gray-500 border-b border-gray-200 hover:bg-gray-100"
                    data-accordion-target="#tahap2" aria-expanded="false" aria-controls="tahap2">
                    <span>Tahap 2: Login & Pengisian Formulir</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-0 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </h2>
            <div id="tahap2" class="hidden p-4 border-b border-gray-200">
                <p><strong>Login:</strong> Masukkan email/NISN dan password.</p>
                <p><strong>Dashboard Siswa:</strong> Lihat progres pendaftaran.</p>
                <p><strong>Isi Formulir:</strong> Data diri siswa, orang tua, sekolah asal, nilai, jalur, dan jurusan.</p>
                <p><strong>Hasil:</strong> Semua data tersimpan di sistem.</p>
            </div>
        </div>

        <!-- Tahap 3 -->
        <div class="border rounded-lg">
            <h2>
                <button type="button" class="flex items-center justify-between w-full p-4 font-medium text-left text-gray-500 border-b border-gray-200 hover:bg-gray-100"
                    data-accordion-target="#tahap3" aria-expanded="false" aria-controls="tahap3">
                    <span>Tahap 3: Mengunggah Berkas (Upload Dokumen)</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-0 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </h2>
            <div id="tahap3" class="hidden p-4 border-b border-gray-200">
                <p><strong>Siapkan Dokumen:</strong> KK, Akta, Ijazah/SKL, Pas Foto, KIP/KKS (jika ada), Sertifikat (jika ada).</p>
                <p><strong>Upload ke Sistem:</strong> Unggah file PDF/JPG sesuai ketentuan.</p>
                <p><strong>Hasil:</strong> Dokumen tersimpan di sistem panitia.</p>
            </div>
        </div>

        <!-- Tahap 4 -->
        <div class="border rounded-lg">
            <h2>
                <button type="button" class="flex items-center justify-between w-full p-4 font-medium text-left text-gray-500 border-b border-gray-200 hover:bg-gray-100"
                    data-accordion-target="#tahap4" aria-expanded="false" aria-controls="tahap4">
                    <span>Tahap 4: Finalisasi & Cetak Bukti Pendaftaran</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-0 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </h2>
            <div id="tahap4" class="hidden p-4 border-b border-gray-200">
                <p><strong>Review Data:</strong> Periksa semua data dan dokumen.</p>
                <p><strong>Finalisasi:</strong> Kunci data, tidak dapat diubah lagi.</p>
                <p><strong>Cetak Bukti:</strong> Unduh PDF bukti pendaftaran.</p>
                <p><strong>Hasil:</strong> Bukti resmi pendaftaran di tangan.</p>
            </div>
        </div>

        <!-- Tahap 5 -->
        <div class="border rounded-lg">
            <h2>
                <button type="button" class="flex items-center justify-between w-full p-4 font-medium text-left text-gray-500 border-b border-gray-200 hover:bg-gray-100"
                    data-accordion-target="#tahap5" aria-expanded="false" aria-controls="tahap5">
                    <span>Tahap 5: Menunggu Verifikasi & Pengumuman</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-0 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </h2>
            <div id="tahap5" class="hidden p-4 border-b border-gray-200">
                <p><strong>Verifikasi Panitia:</strong> Panitia memeriksa data dan dokumen.</p>
                <p><strong>Pantau Status:</strong> Lihat status di dashboard.</p>
                <p><strong>Pengumuman:</strong> Cek hasil kelulusan sesuai jadwal.</p>
            </div>
        </div>

        <!-- Tahap 6 -->
        <div class="border rounded-lg">
            <h2>
                <button type="button" class="flex items-center justify-between w-full p-4 font-medium text-left text-gray-500 border-b border-gray-200 hover:bg-gray-100"
                    data-accordion-target="#tahap6" aria-expanded="false" aria-controls="tahap6">
                    <span>Tahap 6: Daftar Ulang (Bagi yang Lulus)</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-0 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </h2>
            <div id="tahap6" class="hidden p-4 border-b border-gray-200">
                <p><strong>Baca Info Daftar Ulang:</strong> Ikuti prosedur sesuai jadwal.</p>
                <p><strong>Proses Daftar Ulang:</strong> Konfirmasi online atau datang langsung.</p>
                <p><strong>Hasil:</strong> Resmi diterima sebagai siswa baru.</p>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('[data-accordion-target]').forEach(button => {
        button.setAttribute("aria-expanded", "false");

        const targetId = button.getAttribute("data-accordion-target");
        const target = document.querySelector(targetId);
        if (target) target.classList.add("hidden");

        const icon = button.querySelector("[data-accordion-icon]");
        if (icon) {
            icon.classList.remove("rotate-180");
            icon.style.transform = "";
        }
    });
});
</script>




@endsection
