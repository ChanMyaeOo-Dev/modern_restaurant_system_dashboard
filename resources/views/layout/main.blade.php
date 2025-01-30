<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MRSS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="antialiased bg-white dark:bg-gray-900">
        @include('components.side_bar')
        @include('components.top_bar')
        <main class="p-4 md:ml-64 mt-16 border rounded-2xl border-gray-200 bg-gray-100 min-h-screen">
            @yield('content')
        </main>
    </div>
    @include('components.notificataion')
</body>

</html>
