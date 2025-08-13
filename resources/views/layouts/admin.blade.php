<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    {{-- Navbar --}}
    @include('partials.navbar-admin')

    {{-- Main Layout --}}

    <div class="flex">
        {{-- Sidebar --}}
        @include('partials.sidebar-admin')

        {{-- Content Area --}}

        {{-- Main Content --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    @vite('resources/js/app.js')
</body>
</html>
