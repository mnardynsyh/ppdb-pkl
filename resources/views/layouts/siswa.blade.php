<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 dark:bg-gray-900">

    @include('partials.nav-siswa')

    <main class="container mx-auto mt-8 px-4">
        @yield('content')
    </main>

    @vite('resources/js/app.js')
</body>
</html>
