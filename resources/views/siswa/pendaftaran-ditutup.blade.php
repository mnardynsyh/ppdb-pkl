@extends('layouts.siswa')

@section('title', 'Pendaftaran Ditutup')

@section('content')
<div class="max-w-xl mx-auto mt-20">
    <div class="rounded-2xl bg-white border border-gray-200 shadow-sm p-8 text-center">

        <div class="flex justify-center mb-4">
            <div class="w-14 h-14 rounded-full bg-red-100 flex items-center justify-center">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M5.07 19h13.86A2.07 2.07 0 0021 16.93V7.07A2.07 2.07 0 0018.93 5.07H5.07A2.07 2.07 0 003 7.07v9.86A2.07 2.07 0 005.07 19z"/>
                </svg>
            </div>
        </div>

        <h1 class="text-xl font-bold text-gray-800 mb-2">Pendaftaran Ditutup</h1>

        <p class="text-gray-600 text-sm leading-relaxed mb-6">
            {{ $status['pesan'] ?? 'Pendaftaran saat ini sedang ditutup oleh panitia.' }}
        </p>

        <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
            class="inline-block mt-4 px-6 py-2 rounded-lg text-sm font-semibold bg-gray-800 text-white hover:bg-gray-900 w-full">
            Kembali ke Halaman Login
        </button>
    </form>


    </div>
</div>
@endsection
