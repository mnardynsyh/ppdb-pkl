<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 dark:bg-gray-900">

    @include('partials.sidebar-admin')

    <main class="p-4 sm:ml-64">
        @yield('content')
    </main>

    @vite('resources/js/app.js')
</body>
</html>
