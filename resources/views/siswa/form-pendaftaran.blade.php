@extends('layouts.siswa')

@section('title', 'Formulir Pendaftaran')

@section('content')
{{-- Menggunakan AlpineJS untuk manajemen step dan modal --}}
<div x-data="{ step: 1, konfirmasi: false, showModal: false, status: '{{ $siswa->status_pendaftaran }}' }" class="max-w-full mx-auto bg-white shadow-2xl rounded-xl p-4 sm:p-8 my-6 sm:my-10 border border-gray-200 relative">
    
    <h1 class="text-2xl md:text-3xl font-bold mb-2 text-center text-gray-800">Formulir Pendaftaran Siswa Baru</h1>
    <p class="text-center text-gray-500 mb-8 px-4 sm:px-0">Silakan lengkapi semua data dengan benar.</p>

    {{-- Menampilkan Ringkasan Error Validasi --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded-r-lg" role="alert">
            <p class="font-bold">Terjadi Kesalahan!</p>
            <p>Mohon periksa kembali data yang Anda isikan. Terdapat beberapa kolom yang belum diisi dengan benar:</p>
            <ul class="list-disc list-inside text-sm mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Memanggil partial stepper --}}
    @include('partials.siswa.stepper')

    {{-- Konten Form Berdasarkan Step --}}
    <div class="mt-8">
        <form x-ref="pendaftaranForm" action="{{ route('siswa.formulir.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            
            {{-- Fieldset ini akan menonaktifkan seluruh form jika status pendaftaran bukan 'Pending' --}}
            <fieldset :disabled="status !== 'Pending'">
                {{-- Memanggil partial untuk setiap step --}}
                @include('partials.siswa.step1')
                @include('partials.siswa.step2')
                @include('partials.siswa.step3')
                @include('partials.siswa.step4')
                @include('partials.siswa.step5')

                {{-- Tombol Navigasi --}}
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


@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('addressHandler', () => ({
            provinces: [],
            regencies: [],
            districts: [],
            selectedProvince: '{{ old('provinsi_id', $siswa->provinsi_id) ?? '' }}',
            selectedRegency: '{{ old('kabupaten_id', $siswa->kabupaten_id) ?? '' }}',
            selectedDistrict: '{{ old('kecamatan_id', $siswa->kecamatan_id) ?? '' }}',

            async init() {
                const provinceResponse = await fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
                this.provinces = await provinceResponse.json();
                
                if (this.selectedProvince) {
                    const regencyResponse = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${this.selectedProvince}.json`);
                    this.regencies = await regencyResponse.json();
                }

                if (this.selectedRegency) {
                    const districtResponse = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${this.selectedRegency}.json`);
                    this.districts = await districtResponse.json();
                }
            },

            async fetchRegencies() {
                this.regencies = [];
                this.districts = [];
                this.selectedRegency = '';
                this.selectedDistrict = '';
                if (!this.selectedProvince) return;
                const response = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${this.selectedProvince}.json`);
                this.regencies = await response.json();
            },

            async fetchDistricts() {
                this.districts = [];
                this.selectedDistrict = '';
                if (!this.selectedRegency) return;
                const response = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${this.selectedRegency}.json`);
                this.districts = await response.json();
            }
        }));
    });
</script>
@endpush

