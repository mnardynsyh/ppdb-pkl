@extends('layouts.siswa')

@section('title', 'Dashboard Pendaftaran Siswa')

@section('content')

{{-- 
    Logika Utama Tampilan:
    - Jika data orangTuaWali belum ada, ATAU jika ada query `action=edit` dan status masih 'pending', tampilkan form.
    - Selain itu, tampilkan halaman status.
--}}
@if(!$siswa->orangTuaWali || (request()->query('action') == 'edit' && $siswa->status_pendaftaran == 'pending'))

    {{-- =================================================================== --}}
    {{-- TAMPILAN FORMULIR PENDAFTARAN (UNTUK PENGISIAN AWAL / EDIT) --}}
    {{-- =================================================================== --}}
    <div x-data="{ step: 1, konfirmasi: false, showModal: false, status: '{{ $siswa->status_pendaftaran }}' }" class="max-w-full mx-auto bg-white shadow-2xl rounded-xl p-4 sm:p-8 my-6 sm:my-10 border border-gray-200 relative">
        
        <div class="absolute top-4 right-4 md:top-6 md:right-6">
            <form action="{{ route('siswa.logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300 flex items-center gap-2 text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span class="hidden sm:inline">Logout</span>
                </button>
            </form>
        </div>

        <h1 class="text-2xl md:text-3xl font-bold mb-2 text-center text-gray-800 pt-10 sm:pt-0">Formulir Pendaftaran Siswa Baru</h1>
        <p class="text-center text-gray-500 mb-8 px-4 sm:px-0">Silakan lengkapi semua data dengan benar.</p>

        @include('partials.siswa.stepper')

        <div class="mt-8">
            <form x-ref="pendaftaranForm" action="{{ route('siswa.dashboard.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                
                <fieldset :disabled="status !== 'pending'">
                    @include('partials.siswa.step1')
                    @include('partials.siswa.step2')
                    @include('partials.siswa.step3')
                    @include('partials.siswa.step4')
                    @include('partials.siswa.step5')

                    <div class="flex justify-between mt-10 pt-6 border-t">
                        <button type="button"
                                class="px-4 py-2 sm:px-6 text-sm sm:text-base bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                                @click="if(step > 1) step--"
                                :disabled="step === 1">
                            Sebelumnya
                        </button>

                        <button type="button"
                                class="px-4 py-2 sm:px-6 text-sm sm:text-base bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300"
                                @click="if(step < 5) step++"
                                x-show="step < 5">
                            Berikutnya
                        </button>

                        <button type="button"
                                @click="showModal = true"
                                class="px-4 py-2 sm:px-6 text-sm sm:text-base bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                                x-show="step === 5"
                                :disabled="!konfirmasi">
                            <span>{{ $siswa->orangTuaWali ? 'Simpan Perubahan' : 'Kirim Pendaftaran' }}</span>
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>

        <!-- Modal Konfirmasi -->
        <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
            <div @click.away="showModal = false" class="bg-white rounded-lg shadow-xl p-6 sm:p-8 w-11/12 max-w-md mx-auto">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                        <svg class="h-6 w-6 text-blue-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.546-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mt-5">Konfirmasi Pendaftaran</h3>
                    <div class="mt-2 px-7 py-3">
                        <p class="text-sm text-gray-500">
                            Apakah Anda yakin semua data yang diisi sudah benar? Anda masih dapat mengubah data selama pendaftaran belum diverifikasi oleh panitia.
                        </p>
                    </div>
                    <div class="mt-6 flex justify-center gap-4">
                        <button type="button" @click="showModal = false" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition">
                            Batal
                        </button>
                        <button type="button" @click="$refs.pendaftaranForm.submit()" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                            Ya, Kirim Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@else

    {{-- =================================================================== --}}
    {{-- TAMPILAN HALAMAN STATUS (SETELAH SUBMIT) --}}
    {{-- =================================================================== --}}
    <div class="max-w-4xl mx-auto bg-white shadow-2xl rounded-xl p-4 sm:p-8 my-6 sm:my-10 border border-gray-200 relative">
        <div class="absolute top-4 right-4 md:top-6 md:right-6">
            <form action="{{ route('siswa.logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300 flex items-center gap-2 text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span class="hidden sm:inline">Logout</span>
                </button>
            </form>
        </div>

        <div class="text-center">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 pt-10 sm:pt-0">Status Pendaftaran Anda</h1>
            <p class="text-gray-500 mt-2">Terima kasih telah melakukan pendaftaran. Berikut adalah ringkasan data Anda.</p>
        </div>

        <!-- Status Pendaftaran -->
        <div class="mt-8 mb-6 p-4 rounded-lg flex flex-col sm:flex-row items-center justify-between
            @if($siswa->status_pendaftaran == 'pending') bg-yellow-100 text-yellow-800 
            @elseif($siswa->status_pendaftaran == 'diterima') bg-green-100 text-green-800 
            @else bg-red-100 text-red-800 @endif">
            <div class="flex items-center">
                <span class="font-semibold text-lg">Status: &nbsp;</span>
                <span class="font-bold text-lg uppercase">{{ $siswa->status_pendaftaran }}</span>
            </div>
            @if($siswa->status_pendaftaran == 'pending')
                <div class="mt-4 sm:mt-0">
                    <p class="text-sm text-center sm:text-right mb-2">Data Anda sedang dalam proses verifikasi oleh panitia.</p>
                    <a href="{{ route('siswa.dashboard', ['action' => 'edit']) }}" 
                       class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-semibold">
                        Ubah Data Pendaftaran
                    </a>
                </div>
            @elseif($siswa->status_pendaftaran == 'diterima')
                <p class="mt-2 sm:mt-0 text-sm text-center sm:text-left">Selamat! Pendaftaran Anda diterima. Silakan tunggu informasi selanjutnya.</p>
            @else
                <p class="mt-2 sm:mt-0 text-sm text-center sm:text-left">Mohon maaf, pendaftaran Anda ditolak. Silakan hubungi panitia untuk informasi lebih lanjut.</p>
            @endif
        </div>

        <!-- Ringkasan Data -->
        <div class="space-y-6">
             <div class="p-5 border rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Data Calon Siswa</h3>
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3 text-sm">
                    <div class="grid grid-cols-2"><dt class="font-medium text-gray-500">Nama Lengkap:</dt><dd class="text-gray-900">{{ $siswa->nama_lengkap }}</dd></div>
                    <div class="grid grid-cols-2"><dt class="font-medium text-gray-500">NISN:</dt><dd class="text-gray-900">{{ $siswa->nisn }}</dd></div>
                    <div class="grid grid-cols-2"><dt class="font-medium text-gray-500">NIK:</dt><dd class="text-gray-900">{{ $siswa->nik }}</dd></div>
                    <div class="grid grid-cols-2"><dt class="font-medium text-gray-500">Asal Sekolah:</dt><dd class="text-gray-900">{{ $siswa->asal_sekolah }}</dd></div>
                </dl>
            </div>
             <div class="p-5 border rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Berkas Terunggah</h3>
                <ul class="text-sm space-y-2">
                    @forelse ($siswa->lampiran->keyBy('jenis_berkas') as $jenis => $file)
                         <li class="flex items-center justify-between p-2 bg-gray-50 rounded-md">
                            <span class="font-medium text-gray-600">{{ ucwords(str_replace('_', ' ', $jenis)) }}</span>
                            <a href="{{ Storage::url($file->path_file) }}" target="_blank" class="text-blue-600 hover:underline font-semibold">Lihat Berkas</a>
                        </li>
                    @empty
                        <p class="text-gray-500">Belum ada berkas yang diunggah.</p>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

@endif

<script src="//unpkg.com/alpinejs" defer></script>
@endsection

