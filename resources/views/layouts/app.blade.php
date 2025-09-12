<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#F4F4F2] flex items-center lg:justify-center min-h-screen flex-col">
        
        <!-- Header -->
        <header class="bg-[#243A69] flex w-full text-sm mb-6">
            <div name="logo" class="flex items-center justify-start w-full px-4 py-6">
                <img class="w-32 ml-4" src="{{ asset('images/Logo_dark.png') }}" alt="Logo Sumiu Achou">
            </div>
            <div class="flex items-center justify-end w-full px-4 py-6">
                <a href="{{ route('user-option') }}" 
                   class="text-[#243A69] bold family-poppins bg-[#F4F4F2] hover:bg-[#D4CDC5] hover:text-[#243A69] px-4 py-2 rounded-md">
                    Trocar Acesso
                </a>
            </div>
        </header>

        <!-- Conteúdo da página -->
        <div class="flex flex-col w-full lg:grow">
            <x-navbar/>
            <main class="w-full">
                {{ $slot }}
            </main>
        </div>
        <!-- Scripts extras -->
        @stack('scripts')
    </body>
</html>
