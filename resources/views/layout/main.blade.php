<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dash</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        @include('components.top_bar')
        @include('components.side_bar')
        <main class="p-4 md:ml-64 pt-20 h-screen">
            @yield('content')
        </main>
    </div>
</body>

</html>
