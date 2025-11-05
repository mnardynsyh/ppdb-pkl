@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4">
    <div class="w-full max-w-md bg-white rounded-lg shadow-xl p-8 space-y-8">
        <div>
            <h2 class="text-center text-3xl font-extrabold text-gray-900">
                Login Akun
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Masukkan Email (untuk Admin) atau NISN (untuk Siswa)
            </p>
        </div>

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Notifikasi error --}}
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">
                {{ $errors->first() }}
            </div>
        @endif

        <form class="mt-8 space-y-6" action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Email atau NISN</label>
                    <input id="username" name="username" type="text" value="{{ old('username') }}" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 shadow-sm rounded-md focus:ring-blue-500 focus:border-blue-500"
                        placeholder="contoh: admin@email.com atau 1234567890">
                    @error('username')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div x-data="{ show: false }">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" id="password" name="password" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 shadow-sm rounded-md focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Password">
                        <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-500 text-sm select-none">
                            <span x-text="show ? 'Hide' : 'Show'"></span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center text-sm text-gray-900">
                    <input id="remember" name="remember" type="checkbox"
                        class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <span class="ml-2">Ingat saya</span>
                </label>
            </div>

            <button type="submit"
                class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                Login
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-gray-500">
                ← Kembali ke Halaman Utama
            </a>
        </div>
    </div>
</div>
@endsection
