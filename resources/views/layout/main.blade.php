<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="icon" href="{{ asset('assets/logo_2.png') }}" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Primary Meta Tags -->
    <title>Smart Serve</title>
    <meta name="title" content="Smart Serve Restaurant" />
    <meta name="description" content="Smart Serve Restaurant." />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="smart serve link" />
    <meta property="og:title" content="Smart Serve Restaurant" />
    <meta property="og:description" content="Smart Serve Restaurant." />
    <meta property="og:image" content="{{ asset('assets/logo_2.png') }}" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="twitter link" />
    <meta property="twitter:title" content="Smart Serve Restaurant" />
    <meta property="twitter:description" content="Smart Serve Restaurant." />
    <meta property="twitter:image" content="{{ asset('assets/logo_2.png') }}" />

    <!-- Meta Tags Generated with https://metatags.io -->
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
