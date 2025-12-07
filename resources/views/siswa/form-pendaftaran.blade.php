@extends('layouts.siswa')

@section('title', 'Formulir Pendaftaran')

@section('content')

{{-- LOGIKA PENGUNCIAN (Jika status Diterima/Ditolak) --}}
@php
    $isLocked = in_array($siswa->status_pendaftaran, ['Diterima', 'Ditolak']);
@endphp

<div x-data="{ step: 1, konfirmasi: false, showModal: false }" class="max-w-5xl mx-auto mb-16">
    
    {{-- Header --}}
    <div class="text-center mb-10" data-aos="fade-down">
        <h1 class="text-3xl font-bold text-neutral-900 tracking-tight">Formulir Pendaftaran Calon Siswa</h1>
        
        @if($isLocked)
            <div class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-yellow-50 text-yellow-700 border border-yellow-200 rounded-lg text-sm font-medium">
                <i class="fa-solid fa-lock"></i>
                Data terkunci karena status: <strong>{{ $siswa->status_pendaftaran }}</strong>
            </div>
        @else
            <p class="text-neutral-500 mt-2">Lengkapi data diri Anda dengan benar dan valid.</p>
        @endif
    </div>

    {{-- Error Alert --}}
    @if ($errors->any())
        <div class="mb-8 p-4 bg-rose-50 border border-rose-100 rounded-2xl flex items-start gap-4 shadow-sm" role="alert">
            <div class="shrink-0 w-10 h-10 rounded-full bg-rose-100 flex items-center justify-center text-rose-600">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div>
                <h3 class="font-bold text-rose-700 text-sm">Periksa kembali inputan Anda:</h3>
                <ul class="mt-1 list-disc list-inside text-sm text-rose-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-[2rem] border border-neutral-200 shadow-xl shadow-neutral-200/40 overflow-hidden relative">
        
        {{-- Stepper --}}
        <div class="bg-neutral-50/50 border-b border-neutral-100 p-6 md:p-8">
            @include('partials.siswa.stepper')
        </div>
        
        {{-- Form Content --}}
        <div class="p-6 md:p-10 relative">
            <form x-ref="pendaftaranForm" action="{{ route('siswa.formulir.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- Steps --}}
                @include('partials.siswa.step1', ['isLocked' => $isLocked])
                @include('partials.siswa.step2', ['isLocked' => $isLocked])
                @include('partials.siswa.step3', ['isLocked' => $isLocked])
                @include('partials.siswa.step4', ['isLocked' => $isLocked])
                @include('partials.siswa.step5', ['isLocked' => $isLocked])

                {{-- Navigation Buttons --}}
                <div class="flex items-center justify-between mt-12 pt-8 border-t border-neutral-100">
                    
                    {{-- Prev --}}
                    <button type="button"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold text-neutral-600 bg-white border border-neutral-200 hover:bg-neutral-50 hover:text-neutral-900 transition-all disabled:opacity-50"
                            @click="if(step > 1) step--"
                            :disabled="step === 1"
                            :class="{ 'opacity-0 pointer-events-none': step === 1 }">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>Sebelumnya</span>
                    </button>

                    {{-- Next --}}
                    <button type="button"
                            class="inline-flex items-center gap-2 px-8 py-3 rounded-xl text-sm font-bold text-white bg-primary-600 hover:bg-primary-700 shadow-lg shadow-primary-500/20 hover:shadow-primary-500/30 transition-all transform hover:-translate-y-0.5"
                            @click="if(step < 5) step++"
                            x-show="step < 5">
                        <span>Berikutnya</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>

                    {{-- Submit --}}
                    @if(!$isLocked)
                        <button type="button"
                                @click="showModal = true"
                                class="inline-flex items-center gap-2 px-8 py-3 rounded-xl text-sm font-bold text-white bg-primary-600 hover:bg-primary-700 shadow-lg shadow-primary-500/20 hover:shadow-primary-500/30 transition-all transform hover:-translate-y-0.5 disabled:opacity-50 disabled:bg-neutral-300 disabled:shadow-none"
                                x-show="step === 5"
                                :disabled="!konfirmasi"
                                x-cloak>
                            <i class="fa-solid fa-paper-plane"></i>
                            <span>{{ $siswa && $siswa->alamat ? 'Simpan Perubahan' : 'Kirim Pendaftaran' }}</span>
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Konfirmasi --}}
    <div x-show="showModal" 
         class="fixed inset-0 z-50 flex items-center justify-center px-4" 
         style="display: none;" x-cloak>
        <div class="absolute inset-0 bg-neutral-900/60 backdrop-blur-sm" @click="showModal = false"></div>
        <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-md w-full relative z-10 transform transition-all">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-primary-50 border-4 border-primary-100 mb-6">
                    <i class="fa-solid fa-check text-2xl text-primary-600"></i>
                </div>
                <h3 class="text-xl font-bold text-neutral-900 mb-2">Kirim Data?</h3>
                <p class="text-sm text-neutral-500 leading-relaxed mb-8">
                    Pastikan seluruh data sudah benar. Data akan diverifikasi oleh panitia.
                </p>
                <div class="grid grid-cols-2 gap-3">
                    <button type="button" @click="showModal = false" class="px-5 py-3 rounded-xl border border-neutral-200 text-neutral-600 font-bold hover:bg-neutral-50">Batal</button>
                    <button type="button" @click="$refs.pendaftaranForm.submit()" class="px-5 py-3 rounded-xl bg-primary-600 text-white font-bold hover:bg-primary-700 shadow-lg">Ya, Kirim</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('addressHandler', (provinces) => ({
            provinces: provinces,
            regencies: [],
            districts: [],
            villages: [], 

            selectedProvince: '{{ old('provinsi_id', $siswa->provinsi_id) ?? '' }}',
            selectedRegency: '{{ old('kabupaten_id', $siswa->kabupaten_id) ?? '' }}',
            selectedDistrict: '{{ old('kecamatan_id', $siswa->kecamatan_id) ?? '' }}',
            selectedVillage: '{{ old('desa_id', $siswa->desa_id) ?? '' }}', 

            async init() {
                if (this.selectedProvince) {
                    await this.fetchRegencies(true); 
                }
            },

            async fetchRegencies(isInitialLoad = false) {
                if (!isInitialLoad) {
                    this.regencies = []; this.districts = []; this.villages = [];
                    this.selectedRegency = ''; this.selectedDistrict = ''; this.selectedVillage = '';
                }
                if (!this.selectedProvince) return;

                const response = await fetch(`{{ route('wilayah.kabupaten') }}?provinsi_id=${this.selectedProvince}`);
                this.regencies = await response.json();

                if (isInitialLoad && this.selectedRegency) {
                    await this.fetchDistricts(true); 
                }
            },

            async fetchDistricts(isInitialLoad = false) {
                if (!isInitialLoad) {
                    this.districts = []; this.villages = [];
                    this.selectedDistrict = ''; this.selectedVillage = '';
                }
                if (!this.selectedRegency) return;

                const response = await fetch(`{{ route('wilayah.kecamatan') }}?kabupaten_id=${this.selectedRegency}`);
                this.districts = await response.json();

                if (isInitialLoad && this.selectedDistrict) {
                    await this.fetchVillages(true); 
                }
            },

            async fetchVillages(isInitialLoad = false) {
                if (!isInitialLoad) {
                    this.villages = [];
                    this.selectedVillage = '';
                }
                if (!this.selectedDistrict) return;

                const response = await fetch(`{{ route('wilayah.desa') }}?kecamatan_id=${this.selectedDistrict}`);
                this.villages = await response.json();
            }
        }));
    });
</script>
@endpush