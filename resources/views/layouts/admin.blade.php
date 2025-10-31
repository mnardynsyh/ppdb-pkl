<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin') - PPDB Online</title>
    
    {{-- Memuat Tailwind CSS --}}   
    @vite('resources/css/app.css')

    {{-- [BARU] Memuat Font Awesome untuk Ikon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" xintegrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- [BARU] Memuat AlpineJS (dengan defer) --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    {{-- Font Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50">

    {{-- [BARU] Menambahkan wrapper x-data untuk mengelola state sidebar mobile --}}
    <div x-data="{ sidebarOpen: false }">
        {{-- Memanggil sidebar/navbar --}}
        @include('partials.sidebar-admin')

        {{-- [DIUBAH] Menambahkan padding-top (pt-16) agar konten tidak tertutup navbar --}}
        <main class="p-4 sm:ml-64 pt-8">
            @yield('content')
        </main>
    </div>

    {{-- Memuat JS aplikasi (termasuk Vite) --}}
    @vite('resources/js/app.js')
    {{-- Stack untuk script khusus per halaman --}}
    @stack('scripts')
</body>
</html>

