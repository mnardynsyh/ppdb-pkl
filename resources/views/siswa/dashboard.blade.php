@extends('layouts.siswa')

@section('title', 'Dashboard Pendaftaran Siswa')

@section('content')
<div x-data="{ step: 1, konfirmasi: false }" class="max-w-full mx-auto bg-white shadow-2xl rounded-xl p-8 my-10 border border-gray-200">
    <h1 class="text-3xl font-bold mb-2 text-center text-gray-800">Formulir Pendaftaran Siswa Baru</h1>
    <p class="text-center text-gray-500 mb-8">Silakan lengkapi semua data dengan benar.</p>

    <!-- Memanggil Stepper Partial -->
    @include('partials.siswa.stepper')

    <!-- Konten Form Berdasarkan Step -->
    <div class="mt-8">
        <form action="{{-- route('siswa.store.pendaftaran') --}}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Memanggil Partial untuk setiap step -->
            @include('partials.siswa.step1')
            @include('partials.siswa.step2')
            @include('partials.siswa.step3')
            @include('partials.siswa.step4')
            @include('partials.siswa.step5')

            <!-- Tombol Navigasi -->
            <div class="flex justify-between mt-10 pt-6 border-t">
                <button type="button"
                        class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                        @click="if(step > 1) step--"
                        :disabled="step === 1">
                    Sebelumnya
                </button>

                <button type="button"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 disabled:opacity-50"
                        @click="if(step < 5) step++"
                        x-show="step < 5">
                    Berikutnya
                </button>

                <button type="submit"
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                        x-show="step === 5"
                        :disabled="!konfirmasi">
                    Kirim Pendaftaran
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Pastikan AlpineJS sudah di-load di layout utama Anda --}}
{{-- Jika belum, tambahkan script ini di layout atau di sini --}}
<script src="//unpkg.com/alpinejs" defer></script>
@endsection
