<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard Siswa') - PPDB Online</title>
    
    <link rel="icon" href="{{ asset('img/favicon.png') }}">

    {{-- Fonts & Icons --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    
    {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-neutral-50 text-neutral-800 antialiased flex flex-col min-h-screen relative overflow-x-hidden selection:bg-primary-500 selection:text-white">

    {{-- === BACKGROUND DECORATION (ENHANCED) === --}}
    <div class="fixed inset-0 -z-50 pointer-events-none overflow-hidden">
        
        {{-- 1. Gradien Utama (Teal) di Kanan Atas --}}
        <div class="absolute -top-[10%] -right-[5%] w-[800px] h-[800px] rounded-full bg-primary-100/60 blur-[100px] opacity-70"></div>
        
        {{-- 2. Gradien Sekunder (Warm/Neutral) di Kiri Bawah --}}
        <div class="absolute -bottom-[10%] -left-[5%] w-[600px] h-[600px] rounded-full bg-neutral-200/60 blur-[100px] opacity-60"></div>
        
        {{-- 3. Grid Pattern (Tekstur Kotak-kotak Halus) --}}
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-[size:24px_24px]"></div>
        
        {{-- 4. Efek Vignette Putih (Agar tengah tetap bersih) --}}
        <div class="absolute inset-0 bg-gradient-to-b from-white/40 via-transparent to-white/60"></div>
        
    </div>

    {{-- Navbar Siswa --}}
    @include('partials.nav-siswa')

    {{-- Main Content --}}
    <main class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 relative z-10">
        @yield('content')
    </main>

    {{-- Footer Simple --}}
    <footer class="py-8 text-center text-xs text-neutral-400 border-t border-neutral-200 mt-auto bg-white/60 backdrop-blur-sm relative z-10">
        <p>&copy; {{ date('Y') }} PPDB Online. All rights reserved.</p>
    </footer>

    {{-- Scripts Stack --}}
    @stack('scripts')

</body>
</html>