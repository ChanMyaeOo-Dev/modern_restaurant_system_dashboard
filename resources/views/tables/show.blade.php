<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dash</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="qr_bg w-full h-screen relative">
        <img src="{{ asset('assets/qr_bg_mobile.jpg') }}" class="object-cover w-full h-full absolute start-0 top-0 z-10">
        <div class="p-6 absolute top-20 start-0 end-0 z-20 flex items-center justify-center flex-col">
            <div>
                <p class="text-slate-800 fw-bold text-2xl -mb-6 text-center">Scan To</p>
                <p class="text-slate-800 font-bold text-[4.5em] text-center">Order</p>
            </div>
            <img src="{{ asset('qr_codes/' . $table->qr_code) }}" class="bg-white rounded-lg p-6" />
        </div>
    </div>
</body>

</html>
