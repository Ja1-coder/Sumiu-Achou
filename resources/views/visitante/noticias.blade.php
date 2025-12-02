<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#F4F4F2] flex items-center lg:justify-center min-h-screen flex-col">
        
        <header class="bg-[#243A69] flex w-full text-sm mb-6">
            <div name="logo" class="flex items-center justify-start w-full px-4 py-6">
                <img class="w-32 ml-4" src="{{ asset('images/Logo_dark.png') }}" alt="Logo Sumiu Achou">
            </div>
            <div class="flex items-center justify-end w-full px-4 py-6">
                <div class="flex items-center justify-end w-full px-4 py-6">
                    <a href="{{route('user-option')}}" 
                    class="text-[#243A69] font-semibold bg-[#F4F4F2] hover:bg-[#D4CDC5] px-4 py-2 rounded-md">
                        Trocar Acesso
                    </a>
                </div>
            </div>
        </header>

        <div class="flex flex-col w-full lg:grow px-4 md:px-12">
            <div class="mb-8">
                <a href="{{ route('home.page') }}"
                class="inline-flex items-center gap-3 bg-[#243A69] hover:bg-[#1a2a4a] text-white font-semibold px-5 py-3 rounded-lg shadow-md transition duration-300">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>

                    <span>Voltar</span>
                </a>
            </div>
            <div class="mb-12">
                <h1 class="text-3xl md:text-4xl font-bold family-poppins text-[#243a69] mb-6 border-b-2 border-[#243a69] pb-2">Notícias/Forum</h1>
            </div>

            <div class="flex-1 mb-12">
                <div class="bg-[#D4CDC5] rounded-lg shadow-lg p-8 md:p-12 min-h-[500px]">
                    
                    <div class="text-[#243A69] space-y-8">
                        
                        {{-- LOOP PARA EXIBIR TODAS AS NOTÍCIAS --}}
                        @forelse ($noticias as $noticia)
                            <article class="bg-white rounded-lg p-6 shadow-md border-l-4 border-[#243A69]">
                                <div class="flex items-center gap-2 text-sm text-gray-600 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{-- Data de Criação Formatada (Assumindo created_at) --}}
                                    <span>{{ \Carbon\Carbon::parse($noticia->created_at)->format('d \d\e F \d\e Y') }}</span>
                                </div>
                                
                                {{-- Título da Notícia --}}
                                <h2 class="text-2xl font-bold mb-3">{{ $noticia->title }}</h2>
                                
                                {{-- Conteúdo da Notícia (Limitado ou Completo, dependendo do campo) --}}
                                <p class="text-lg leading-relaxed">
                                    {{ $noticia->description }}
                                </p>
                            </article>
                        @empty
                            <div class="bg-white rounded-lg p-6 shadow-md border-l-4 border-gray-400 text-center">
                                <p class="text-xl font-medium">Nenhuma notícia ou atualização encontrada no momento. 😔</p>
                            </div>
                        @endforelse
                        {{-- FIM DO LOOP DE NOTÍCIAS --}}

                        <div class="bg-[#243A69] rounded-lg p-6 mt-8">
                            <h2 class="text-2xl font-bold text-[#F4F4F2] mb-4">Fórum da Comunidade</h2>
                            <p class="text-[#F4F4F2] text-lg mb-4">
                                Compartilhe suas experiências, dicas e ajude outros membros da comunidade a encontrar seus pertences.
                            </p>
                            <button class="bg-[#F4F4F2] hover:bg-[#D4CDC5] text-[#243A69] font-bold px-6 py-3 rounded-md transition duration-300">
                                Acessar Fórum
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="bg-[#5B88A5] w-full py-4 mt-auto">
            <p class="text-center text-[#F4F4F2] text-sm">© 2025 Sumiu&Achou - Site para fins educativos</p>
        </footer>

        @stack('scripts')
    </body>
</html>