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
        <main class="start-64 h-screen fixed top-16 end-0 overflow-y-auto border border-gray-300 rounded-2xl">
            <div class="px-4 pt-4 pb-20 bg-gray-100 max-w-screen min-h-screen">
                @yield('content')
            </div>
        </main>
    </div>
    @include('components.notificataion')
</body>

</html>
