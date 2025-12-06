@extends('layouts.admin')

@section('title', 'Profil Saya')

@section('content')

<div class="w-full min-h-screen bg-neutral-50 px-4 pt-8 lg:px-4 lg:pt-4 flex flex-col font-sans text-neutral-800">

    <div class="max-w-3xl mx-4 w-full flex-1 flex flex-col gap-6">

        {{-- 1. HEADER --}}
        <div class="shrink-0 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-neutral-900">Profil Saya</h1>
                <p class="text-sm text-neutral-500 mt-1">Kelola informasi akun dan keamanan.</p>
            </div>
        </div>

        {{-- 2. ALERTS --}}
        <div class="flex flex-col gap-4">
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition.duration.300ms 
                     class="p-4 rounded-xl bg-primary-50 border border-primary-100 text-primary-800 flex items-center gap-3 shadow-sm">
                    <div class="w-8 h-8 rounded-full bg-primary-200 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-check text-primary-700 text-sm"></i>
                    </div>
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                    <button @click="show = false" class="ml-auto text-primary-600 hover:text-primary-800 transition-colors">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div x-data="{ show: true }" x-show="show" x-transition.duration.300ms 
                     class="p-4 rounded-xl bg-rose-50 border border-rose-100 text-rose-800 flex items-start gap-3 shadow-sm">
                    <div class="w-8 h-8 rounded-full bg-rose-200 flex items-center justify-center shrink-0 mt-0.5">
                        <i class="fa-solid fa-triangle-exclamation text-rose-700 text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <span class="font-bold text-sm block">Gagal memperbarui profil:</span>
                        <ul class="list-disc list-inside text-sm mt-1 text-rose-700 opacity-90">
                            @foreach ($errors->all() as $error) 
                                <li>{{ $error }}</li> 
                            @endforeach
                        </ul>
                    </div>
                    <button @click="show = false" class="text-rose-600 hover:text-rose-800 transition-colors">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif
        </div>

        {{-- 3. FORM CARD --}}
        <div class="bg-white rounded-2xl border border-neutral-200 shadow-sm overflow-hidden">
            
            {{-- Header Card --}}
            <div class="px-6 py-4 border-b border-neutral-100 bg-neutral-50/50 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 ring-1 ring-primary-50">
                    <i class="fa-solid fa-user-gear text-lg"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-neutral-800">Edit Informasi</h3>
                    <p class="text-xs text-neutral-500">Perbarui nama, email, atau kata sandi Anda.</p>
                </div>
            </div>

            <form action="{{ route('admin.profil.update') }}" method="POST" class="p-6 md:p-8">
                @csrf
                @method('PUT')

                <div class="space-y-8">
                    
                    {{-- Nama & Email --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-xs font-bold text-neutral-500 uppercase tracking-wider mb-2">Nama Lengkap</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400 group-focus-within:text-primary-500 transition-colors">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required 
                                       class="w-full pl-10 py-2.5 rounded-xl border border-neutral-300 text-sm font-bold text-neutral-700 focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all placeholder-neutral-400 shadow-sm">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-bold text-neutral-500 uppercase tracking-wider mb-2">Alamat Email</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400 group-focus-within:text-primary-500 transition-colors">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required 
                                       class="w-full pl-10 py-2.5 rounded-xl border border-neutral-300 text-sm font-bold text-neutral-700 focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all placeholder-neutral-400 shadow-sm">
                            </div>
                        </div>
                    </div>

                    {{-- Divider dengan Label --}}
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-neutral-100"></div>
                        </div>
                        <div class="relative flex justify-start">
                            <span class="bg-white pr-3 text-xs font-bold text-primary-600 uppercase tracking-wider">Keamanan Akun</span>
                        </div>
                    </div>

                    {{-- Password Section --}}
                    <div class="bg-neutral-50 rounded-xl p-5 border border-neutral-100">
                        <div class="flex items-start gap-3 mb-5">
                            <i class="fa-solid fa-lock text-neutral-400 mt-0.5"></i>
                            <div>
                                <h4 class="text-sm font-bold text-neutral-800">Ubah Kata Sandi</h4>
                                <p class="text-xs text-neutral-500">Kosongkan kolom di bawah jika tidak ingin mengubah kata sandi.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="password" class="block text-xs font-bold text-neutral-500 uppercase tracking-wider mb-2">Kata Sandi Baru</label>
                                <input type="password" name="password" id="password" placeholder="Minimal 8 karakter"
                                       class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 text-sm font-medium text-neutral-700 focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all placeholder-neutral-400 shadow-sm">
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-xs font-bold text-neutral-500 uppercase tracking-wider mb-2">Konfirmasi Kata Sandi</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi kata sandi baru"
                                       class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 text-sm font-medium text-neutral-700 focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all placeholder-neutral-400 shadow-sm">
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Action Buttons --}}
                <div class="mt-8 pt-6 border-t border-neutral-100 flex justify-end gap-3">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="px-6 py-2.5 rounded-xl border border-neutral-200 bg-white text-sm font-bold text-neutral-600 hover:bg-neutral-50 hover:text-neutral-800 transition-colors shadow-sm">
                        Kembali
                    </a>
                    <button type="submit" 
                            class="px-6 py-2.5 rounded-xl bg-primary-600 text-white text-sm font-bold shadow-lg shadow-primary-200 hover:bg-primary-700 hover:shadow-primary-300 transition-all flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection