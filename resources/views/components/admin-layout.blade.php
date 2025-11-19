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

<body class="bg-[#F4F4F2] min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-[#243A69] flex w-full text-sm">
        <div name="logo" class="flex items-center justify-start w-full px-4 py-6">
            <img class="w-32 ml-4" src="{{ asset('images/Logo_dark.png') }}" alt="Logo Sumiu Achou">
        </div>
        <div class="flex items-center justify-end w-full px-4 py-6">
            <a href="#" 
               class="text-[#243A69] font-semibold bg-[#F4F4F2] hover:bg-[#D4CDC5] px-4 py-2 rounded-md">
                Trocar Acesso
            </a>
        </div>
    </header>

    <!-- Layout geral -->
    <div class="flex w-full flex-1">

        <!-- Sidebar fixa -->
        <aside class="w-64 bg-white border-r border-gray-300 p-5 hidden lg:flex flex-col">

            <h2 class="text-[#243A69] font-bold mb-6 text-lg">Menu</h2>

            <nav class="flex flex-col gap-3">

                <a href="#" class="text-[#243A69] hover:bg-[#E5E5E5] px-3 py-2 rounded-md">
                    Dashboard
                </a>

                <a href="#" class="text-[#243A69] hover:bg-[#E5E5E5] px-3 py-2 rounded-md">
                    Usuários
                </a>

                <a href="#" class="text-[#243A69] hover:bg-[#E5E5E5] px-3 py-2 rounded-md">
                    Registros
                </a>

                <a href="#" class="text-[#243A69] hover:bg-[#E5E5E5] px-3 py-2 rounded-md">
                    Itens Encontrados
                </a>

                <a href="#" class="text-[#243A69] hover:bg-[#E5E5E5] px-3 py-2 rounded-md">
                    Itens Perdidos
                </a>

                <a href="#" class="text-[#243A69] hover:bg-[#E5E5E5] px-3 py-2 rounded-md">
                    Configurações
                </a>

            </nav>
        </aside>

        <!-- Conteúdo dinâmico -->
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>

    </div>

    @stack('scripts')
</body>
</html>
