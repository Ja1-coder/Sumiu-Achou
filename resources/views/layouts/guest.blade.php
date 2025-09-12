<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-row bg-[#243A69] ">
            <div class="hidden md:flex items-center justify-center w-1/2">
                <img src="{{ asset('images/Logo_dark.png') }}" alt="Logo Sumiu Achou">
            </div>
            <div class="w-full md:w-1/2 px-6 py-4 bg-[#5B88A5] shadow-md overflow-hidden flex md:items-center justify-center">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
