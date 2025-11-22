@extends('layouts.admin')

@section('title', 'Profil Sekolah')

@section('content')
{{-- ROOT CONTAINER --}}
<div x-data="{ editing: {{ $errors->any() ? 'true' : 'false' }} }" 
     class="w-full min-h-screen lg:h-screen bg-[#F8FAFC] px-4 pt-20 pb-6 lg:px-8 lg:pt-16 lg:pb-0 flex flex-col font-sans text-slate-800">

    <div class="max-w-5xl mx-auto w-full flex-1 flex flex-col lg:justify-center">

        {{-- 1. HEADER --}}
        <div class="shrink-0 mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900">Profil Sekolah</h1>
                <p class="text-sm text-slate-500 mt-1 font-medium">Kelola informasi kontak dan lokasi sekolah.</p>
            </div>
            
            {{-- Tombol Edit --}}
            <div x-show="!editing" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <button @click="editing = true" 
                        class="flex items-center gap-2 px-6 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-lg shadow-sm hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>Ubah Data</span>
                </button>
            </div>
        </div>

        {{-- ALERTS --}}
        @if(session('success'))
            <div class="shrink-0 mb-6 p-4 rounded-lg bg-emerald-50 border border-emerald-100 text-emerald-700 flex items-center gap-3 shadow-sm animate-fade-in-down">
                <i class="fa-solid fa-circle-check"></i>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="shrink-0 mb-6 p-4 rounded-lg bg-rose-50 border border-rose-100 text-rose-700 shadow-sm animate-fade-in-down">
                <div class="flex items-center gap-2 mb-1">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span class="font-bold text-sm">Periksa Inputan:</span>
                </div>
                <ul class="list-disc list-inside text-sm ml-5 opacity-80">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        {{-- 2. CONTENT AREA --}}
        <div class="flex-1 lg:overflow-y-auto lg:pr-2 scrollbar-hide pb-6 relative">

            {{-- A. VIEW MODE --}}
            <div x-show="!editing" 
                 x-transition:enter="transition ease-out duration-300" 
                 x-transition:enter-start="opacity-0 translate-y-2" 
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="h-full">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- CARD 1: EMAIL --}}
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 flex items-center gap-5 hover:border-blue-300 transition-all duration-300 group relative overflow-hidden">
                        <div class="absolute right-0 top-0 w-24 h-full bg-gradient-to-l from-blue-50/50 to-transparent"></div>
                        
                        <div class="w-14 h-14 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 shadow-sm z-10">
                            <i class="fa-solid fa-envelope text-2xl"></i>
                        </div>
                        <div class="z-10 overflow-hidden">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Email Resmi</p>
                            <p class="text-base md:text-lg font-bold text-slate-900 truncate" title="{{ $pengaturan->email }}">
                                {{ $pengaturan->email ?? '-' }}
                            </p>
                        </div>
                    </div>

                    {{-- CARD 2: TELEPON --}}
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 flex items-center gap-5 hover:border-emerald-300 transition-all duration-300 group relative overflow-hidden">
                        <div class="absolute right-0 top-0 w-24 h-full bg-gradient-to-l from-emerald-50/50 to-transparent"></div>

                        <div class="w-14 h-14 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 shadow-sm z-10">
                            <i class="fa-solid fa-phone text-2xl"></i>
                        </div>
                        <div class="z-10">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Telepon / WhatsApp</p>
                            <p class="text-base md:text-lg font-bold text-slate-900">
                                {{ $pengaturan->telepon ?? '-' }}
                            </p>
                        </div>
                    </div>

                    {{-- CARD 3: ALAMAT SEKOLAH (Full Width) --}}
                    <div class="md:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm p-8 flex flex-col hover:border-indigo-300 transition-all duration-300 relative overflow-hidden group">
                        
                        {{-- Background Icon --}}
                        <div class="absolute -right-6 -bottom-6 text-slate-50 group-hover:text-slate-100 transition-colors duration-500">
                            <i class="fa-solid fa-location-dot text-[150px]"></i>
                        </div>

                        <div class="flex items-start gap-5 relative z-10">
                            <div class="w-14 h-14 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 shadow-sm">
                                <i class="fa-solid fa-map-location-dot text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Alamat Lengkap Sekolah</p>
                                <p class="text-lg md:text-xl font-medium text-slate-800 leading-relaxed">
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
                 class="absolute inset-0 bg-white rounded-xl shadow-2xl border border-slate-200 overflow-hidden flex flex-col z-20 max-h-[500px]">
                
                <form action="{{ route('admin.kontak.update') }}" method="POST" class="flex flex-col h-full">
                    @csrf
                    @method('PUT')
                    
                    {{-- Form Header --}}
                    <div class="px-8 py-5 border-b border-slate-100 flex justify-between items-center shrink-0 bg-slate-50/50">
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-blue-600"></span> Edit Profil Sekolah
                        </h3>
                        <button type="button" @click="editing = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>
                    </div>

                    {{-- Form Body --}}
                    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8 overflow-y-auto flex-1">
                        
                        {{-- Kolom Kiri --}}
                        <div class="space-y-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email Resmi</label>
                                <div class="relative group">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>
                                    <input type="email" name="email" value="{{ old('email', $pengaturan->email) }}" 
                                           class="w-full pl-10 py-2.5 rounded-lg border-2 border-slate-200 focus:border-blue-500 focus:ring-0 text-sm font-medium text-slate-700 placeholder-slate-300 transition-all"
                                           placeholder="contoh@sekolah.sch.id">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Nomor Telepon</label>
                                <div class="relative group">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 group-focus-within:text-emerald-500 transition-colors">
                                        <i class="fa-solid fa-phone"></i>
                                    </span>
                                    <input type="text" name="telepon" value="{{ old('telepon', $pengaturan->telepon) }}" 
                                           class="w-full pl-10 py-2.5 rounded-lg border-2 border-slate-200 focus:border-emerald-500 focus:ring-0 text-sm font-medium text-slate-700 placeholder-slate-300 transition-all"
                                           placeholder="0812...">
                                </div>
                            </div>
                        </div>

                        {{-- Kolom Kanan --}}
                        <div class="h-full flex flex-col">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Alamat Lengkap</label>
                            <div class="relative flex-1 group">
                                <textarea name="alamat_sekolah" rows="4" 
                                          class="w-full h-full p-4 rounded-lg border-2 border-slate-200 focus:border-indigo-500 focus:ring-0 text-sm font-medium text-slate-700 transition-colors resize-none placeholder-slate-300"
                                          placeholder="Jalan, Kelurahan, Kecamatan, Kota...">{{ old('alamat_sekolah', $pengaturan->alamat_sekolah) }}</textarea>
                                <div class="absolute bottom-3 right-3 text-slate-300 pointer-events-none group-focus-within:text-indigo-300 transition-colors">
                                    <i class="fa-solid fa-location-dot text-xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Form Footer --}}
                    <div class="px-8 py-5 border-t border-slate-100 bg-slate-50/30 flex justify-end gap-3 shrink-0">
                        <button type="button" @click="editing = false" class="px-5 py-2.5 rounded-lg text-xs font-bold text-slate-600 hover:bg-slate-200 hover:text-slate-800 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-2.5 rounded-lg text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-md transition-colors flex items-center gap-2">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection