@extends('layouts.app')

@section('title', 'Login Admin')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-blue-100 dark:from-gray-900 dark:to-gray-800 px-4">
    <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 space-y-6 border border-gray-100 dark:border-gray-700">

        <!-- Judul -->
        <div class="text-center">
            <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">PPDB Online - Admin</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Masuk ke akun admin Anda</p>
        </div>

        <!-- Pesan Error -->
        @if ($errors->any())
            <div class="p-3 mb-3 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form Login -->
        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all duration-200" />
                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" id="password" name="password" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all duration-200" />
                @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input id="remember" name="remember" type="checkbox"
                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                    <span class="ml-2 text-sm text-gray-900 dark:text-gray-300">Ingat saya</span>
                </label>
            </div>

            <button type="submit"
                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 text-center transition-all duration-200 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700">
                Masuk
            </button>
        </form>
    </div>
</div>
@endsection
