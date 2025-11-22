<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard Siswa') - PPDB Online</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="bg-gray-50" x-data="{ profileModalOpen: false }" @keydown.escape.window="profileModalOpen = false">

    @include('partials.nav-siswa')

    <main class="pt-10">
        @yield('content')
    </main>

    @stack('scripts')
    {{-- Flowbite dan AOS --}}
    <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });
        @if ($errors->any())
            window.addEventListener('alpine:init', () => {
                Alpine.data('page', () => ({
                    init() {
                        this.$store.app.profileModalOpen = true;
                    }
                }))
            });
        @endif
    </script>
</body>
</html>

