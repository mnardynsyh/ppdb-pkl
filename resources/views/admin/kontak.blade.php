@extends('layouts.admin')

@section('title', 'Profil Sekolah')

@section('content')
{{-- ROOT CONTAINER --}}
<div x-data="{ editing: {{ $errors->any() ? 'true' : 'false' }} }" 
     class="w-full min-h-screen bg-neutral-50 px-4 pt-8 lg:px-4 lg:pt-4 flex flex-col font-sans text-neutral-800">

    <div class="max-w-5xl mx-auto w-full flex-1 flex flex-col gap-6">

        {{-- 1. HEADER --}}
        <div class="shrink-0 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-neutral-900">Profil Sekolah</h1>
                <p class="text-sm text-neutral-500 mt-1">Kelola informasi kontak dan lokasi sekolah.</p>
            </div>
            
            {{-- Tombol Edit --}}
            <div x-show="!editing" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <button @click="editing = true" 
                        class="flex items-center gap-2 px-5 py-2.5 bg-primary-600 text-white text-sm font-bold rounded-xl shadow-lg shadow-primary-200 hover:bg-primary-700 transition-all focus:outline-none focus:ring-4 focus:ring-primary-100">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>Ubah Data</span>
                </button>
            </div>
        </div>

        {{-- 2. ALERTS (UPDATED) --}}
        <div class="flex flex-col gap-4">
            
            {{-- Alert Sukses --}}
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition.duration.300ms 
                     class="p-4 rounded-xl bg-primary-50 border border-primary-100 text-primary-800 flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-primary-200 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-check text-primary-700 text-sm"></i>
                        </div>
                        <span class="text-sm font-semibold">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-primary-600 hover:text-primary-800 transition-colors"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            {{-- Alert Error --}}
            @if ($errors->any())
                <div x-data="{ show: true }" x-show="show" x-transition.duration.300ms 
                     class="p-4 rounded-xl bg-rose-50 border border-rose-100 text-rose-800 flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-rose-200 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-triangle-exclamation text-rose-700 text-sm"></i>
                        </div>
                        <div class="text-sm">
                            <span class="font-bold block">Periksa Inputan:</span>
                            <ul class="list-disc list-inside text-xs mt-1 text-rose-700 opacity-90">
                                @foreach ($errors->all() as $error) 
                                    <li>{{ $error }}</li> 
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button @click="show = false" class="text-rose-600 hover:text-rose-800 transition-colors"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif
        </div>

        {{-- 3. CONTENT AREA --}}
        <div class="flex-1 relative">

            {{-- A. VIEW MODE --}}
            <div x-show="!editing" 
                 x-transition:enter="transition ease-out duration-300" 
                 x-transition:enter-start="opacity-0 translate-y-2" 
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="h-full">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- CARD 1: EMAIL --}}
                    <div class="bg-white rounded-2xl border border-neutral-200 shadow-sm p-6 flex items-center gap-5 hover:border-primary-300 transition-all duration-300 group relative overflow-hidden">
                        <div class="absolute right-0 top-0 w-32 h-full bg-gradient-to-l from-primary-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <div class="w-14 h-14 rounded-2xl bg-primary-50 text-primary-600 flex items-center justify-center shrink-0 shadow-sm ring-1 ring-primary-100 z-10">
                            <i class="fa-solid fa-envelope text-2xl"></i>
                        </div>
                        <div class="z-10 overflow-hidden">
                            <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-widest mb-1">Email Resmi</p>
                            <p class="text-base md:text-lg font-bold text-neutral-900 truncate" title="{{ $pengaturan->email }}">
                                {{ $pengaturan->email ?? '-' }}
                            </p>
                        </div>
                    </div>

                    {{-- CARD 2: TELEPON --}}
                    <div class="bg-white rounded-2xl border border-neutral-200 shadow-sm p-6 flex items-center gap-5 hover:border-primary-300 transition-all duration-300 group relative overflow-hidden">
                        <div class="absolute right-0 top-0 w-32 h-full bg-gradient-to-l from-primary-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        <div class="w-14 h-14 rounded-2xl bg-primary-50 text-primary-600 flex items-center justify-center shrink-0 shadow-sm ring-1 ring-primary-100 z-10">
                            <i class="fa-solid fa-phone text-2xl"></i>
                        </div>
                        <div class="z-10">
                            <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-widest mb-1">Telepon / WhatsApp</p>
                            <p class="text-base md:text-lg font-bold text-neutral-900">
                                {{ $pengaturan->telepon ?? '-' }}
                            </p>
                        </div>
                    </div>

                    {{-- CARD 3: ALAMAT SEKOLAH (Full Width) --}}
                    <div class="md:col-span-2 bg-white rounded-2xl border border-neutral-200 shadow-sm p-8 flex flex-col hover:border-primary-300 transition-all duration-300 relative overflow-hidden group">
                        
                        {{-- Background Icon --}}
                        <div class="absolute -right-6 -bottom-6 text-neutral-50 group-hover:text-primary-50/50 transition-colors duration-500">
                            <i class="fa-solid fa-location-dot text-[150px]"></i>
                        </div>

                        <div class="flex items-start gap-5 relative z-10">
                            <div class="w-14 h-14 rounded-2xl bg-primary-50 text-primary-600 flex items-center justify-center shrink-0 shadow-sm ring-1 ring-primary-100">
                                <i class="fa-solid fa-map-location-dot text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-widest mb-2">Alamat Lengkap Sekolah</p>
                                <p class="text-lg md:text-xl font-medium text-neutral-800 leading-relaxed">
                                    {{ $pengaturan->alamat_sekolah ?? 'Alamat sekolah belum diatur.' }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- B. EDIT MODE (Overlay Form) --}}
            <div x-show="editing" style="display: none;"
                 x-transition:enter="transition ease-out duration-300" 
                 x-transition:enter-start="opacity-0 scale-95" 
                 x-transition:enter-end="opacity-100 scale-100"
                 class="absolute inset-0 bg-white rounded-2xl shadow-2xl border border-neutral-200 overflow-hidden flex flex-col z-20">
                
                <form action="{{ route('admin.kontak.update') }}" method="POST" class="flex flex-col h-full">
                    @csrf
                    @method('PUT')
                    
                    {{-- Form Header --}}
                    <div class="px-8 py-5 border-b border-neutral-100 flex justify-between items-center shrink-0 bg-neutral-50/50">
                        <h3 class="text-sm font-bold text-neutral-800 uppercase tracking-wide flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-primary-600"></span> Edit Profil Sekolah
                        </h3>
                        <button type="button" @click="editing = false" class="text-neutral-400 hover:text-rose-500 transition-colors">
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>
                    </div>

                    {{-- Form Body --}}
                    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8 overflow-y-auto flex-1">
                        
                        {{-- Kolom Kiri --}}
                        <div class="space-y-6">
                            <div>
                                <label class="block text-xs font-bold text-neutral-500 uppercase tracking-wider mb-2">Email Resmi</label>
                                <div class="relative group">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-neutral-400 group-focus-within:text-primary-500 transition-colors">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>
                                    <input type="email" name="email" value="{{ old('email', $pengaturan->email) }}" 
                                           class="w-full pl-10 py-2.5 rounded-xl border border-neutral-300 focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 text-sm font-medium text-neutral-700 placeholder-neutral-400 transition-all shadow-sm"
                                           placeholder="contoh@sekolah.sch.id">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-neutral-500 uppercase tracking-wider mb-2">Nomor Telepon</label>
                                <div class="relative group">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-neutral-400 group-focus-within:text-primary-500 transition-colors">
                                        <i class="fa-solid fa-phone"></i>
                                    </span>
                                    <input type="text" name="telepon" value="{{ old('telepon', $pengaturan->telepon) }}" 
                                           class="w-full pl-10 py-2.5 rounded-xl border border-neutral-300 focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 text-sm font-medium text-neutral-700 placeholder-neutral-400 transition-all shadow-sm"
                                           placeholder="0812...">
                                </div>
                            </div>
                        </div>

                        {{-- Kolom Kanan --}}
                        <div class="h-full flex flex-col">
                            <label class="block text-xs font-bold text-neutral-500 uppercase tracking-wider mb-2">Alamat Lengkap</label>
                            <div class="relative flex-1 group">
                                <textarea name="alamat_sekolah" rows="4" 
                                          class="w-full h-full p-4 rounded-xl border border-neutral-300 focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 text-sm font-medium text-neutral-700 transition-all resize-none placeholder-neutral-400 shadow-sm"
                                          placeholder="Jalan, Kelurahan, Kecamatan, Kota...">{{ old('alamat_sekolah', $pengaturan->alamat_sekolah) }}</textarea>
                                <div class="absolute bottom-3 right-3 text-neutral-300 pointer-events-none group-focus-within:text-primary-300 transition-colors">
                                    <i class="fa-solid fa-location-dot text-xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Form Footer --}}
                    <div class="px-8 py-5 border-t border-neutral-100 bg-neutral-50 flex justify-end gap-3 shrink-0">
                        <button type="button" @click="editing = false" class="px-5 py-2.5 rounded-xl text-xs font-bold text-neutral-600 bg-white border border-neutral-200 hover:bg-neutral-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-white bg-primary-600 hover:bg-primary-700 shadow-lg shadow-primary-200 transition-colors flex items-center gap-2">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection