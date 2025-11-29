<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- CORREÇÃO 1: h-screen no body garante a altura total para flex-col --}}
<body class="bg-[#F4F4F2] flex flex-col h-screen overflow-hidden"> 

    <header class="bg-[#243A69] flex w-full text-sm">
        <div name="logo" class="flex items-center justify-start w-full px-4 py-6">
            <img class="w-32 ml-4" src="{{ asset('images/Logo_dark.png') }}" alt="Logo Sumiu Achou">
        </div>
        <div class="flex items-center justify-end w-full px-4 py-6">
            <a href="{{route('user-option')}}" 
               class="text-[#243A69] font-semibold bg-[#F4F4F2] hover:bg-[#D4CDC5] px-4 py-2 rounded-md">
                Trocar Acesso
            </a>
        </div>
    </header>

    <div class="flex w-full flex-1 overflow-hidden">
        

        <aside class="w-64 bg-[#5b88a5] border-r border-gray-300 p-5 hidden lg:flex flex-col h-full">
            
            <div class="flex-grow">
                <h2 class="text-[#243A69] font-bold mb-6 text-lg text-center">Menu</h2>

                <nav class="flex flex-col gap-3">
                    <x-sidebar-link href="{{route('admin.listar-usuarios')}}" title="Usuários" />
                    <x-sidebar-link href="{{route('admin.listar-lugares')}}" title="Lugares" />
                    <x-sidebar-link href="{{route('admin.home')}}" title="Dashboard" />
                    <x-sidebar-link href="{{route('admin.listar-item')}}" title="Listagem de Itens" />
                    <x-sidebar-link href="{{route('admin.noticias')}}" title="Notícias" />
                    <x-sidebar-link href="#" title="Configurações" />
                </nav>
            </div>
            <div class="mt-auto relative pt-4 border-t border-[#497187]">
                
                {{-- Botão Clicável do Usuário --}}
                <div id="user-menu-button" class="cursor-pointer flex items-center justify-between p-3 rounded-md bg-[#243A69] hover:bg-[#1a2c52] transition duration-150 text-white font-semibold">
                    {{-- Nome do Usuário Logado --}}
                    <span>
                        {{ Auth::user()->name ?? 'Nome do Usuário' }}
                    </span>
                    
                    {{-- Ícone para indicar o dropdown --}}
                    <svg id="arrow-icon" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                </div>

                {{-- Dropdown Menu --}}
                <div id="user-menu-dropdown" class="absolute bottom-full left-0 w-full mb-2 bg-white rounded-md shadow-xl border border-gray-200 hidden z-10">
                    <a href="{{ route('admin.logout') }}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Sair
                    </a>
                </div>
                
                {{-- Formulário de Logout --}}
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </aside>

        <main class="flex-1 p-6 overflow-y-auto">
            {{ $slot }}
        </main>

    </div>
    @stack('scripts')
  <script>
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.getElementById('user-menu-button');
            const dropdown = document.getElementById('user-menu-dropdown');
            const icon = document.getElementById('arrow-icon'); 

            button.addEventListener('click', function() {
                dropdown.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            });

            document.addEventListener('click', function(event) {
                if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.classList.add('hidden');
                    icon.classList.remove('rotate-180');
                }
            });
        });
    </script>  
</body>
</html>