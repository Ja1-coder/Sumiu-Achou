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

        <nav class="w-full bg-[#243A69] shadow-md mb-10">
            <div class="max-w-7xl mx-auto px-6">
                <ul class="flex flex-col sm:flex-row justify-around items-center text-[#F4F4F2]">

                    <li class="py-4">
                        <a href="{{ route('lugares') }}" class="flex items-center gap-2 text-lg font-semibold hover:text-[#D4CDC5] transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" 
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7l9-4 9 4-9 4-9-4zm0 6l9 4 9-4m-9 4v6" />
                            </svg>
                            Onde ficam os itens perdidos?
                        </a>
                    </li>

                    <li class="py-4">
                        <a href="{{ route('noticias') }}" class="flex items-center gap-2 text-lg font-semibold hover:text-[#D4CDC5] transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21H5a2 2 0 01-2-2V7a2 2 0 012-2h4l2-2h4l2 2h4a2 2 0 012 2v12a2 2 0 01-2 2z" />
                            </svg>
                            Notícias / Fórum
                        </a>
                    </li>

                    <li class="py-4">
                        <a href="{{ route('item.all') }}" class="flex items-center gap-2 text-lg font-semibold hover:text-[#D4CDC5] transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            Todos os itens perdidos
                        </a>
                    </li>

                </ul>
            </div>
        </nav>


        <div class="flex flex-col w-full lg:grow px-4 md:px-12">
            
            <div class="mb-12">
                <h1 class="text-3xl md:text-4xl font-bold family-poppins text-[#243a69] mb-6 border-b-2 border-[#243a69] pb-2">Achados Recentes:</h1>
                
                <form action="{{ route('home.page') }}" method="GET" class="flex py-3 px-4 rounded-md border-2 border-[#243a69] overflow-hidden max-w-2xl mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="20px"
                    class="fill-[#243a69] mr-3">
                    <path
                        d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                    </path>
                    </svg>

                    <input 
                        type="text" 
                        name="q"
                        placeholder="Buscar..." 
                        class="w-full outline-none bg-transparent text-[#243a69] text-base border-none focus:ring-0"
                    />
                </form>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    @forelse ($recentItems as $item)
                        <a href="{{ route('item.show', $item->id) }}" 
                        class="bg-[#D4CDC5] rounded-lg shadow-lg overflow-hidden flex flex-col md:flex-row 
                                transform transition duration-300 hover:scale-105 cursor-pointer">

                            @php
                                $img = $item->picture 
                                    ? (Str::startsWith($item->picture, 'http') 
                                        ? $item->picture 
                                        : asset('storage/' . $item->picture))
                                    : asset('images/no-image.png');
                            @endphp
                            <div class="md:w-1/3 h-48 md:h-auto bg-cover bg-center"
                                style="background-image: url('{{ $img ?? 'https://via.placeholder.com/300' }}');">
                            </div>

                            <div class="p-6 flex flex-col justify-between flex-1">
                                <div>
                                    <h3 class="text-[#243A69] font-bold text-xl mb-3">
                                        {{ $item->name ?? 'Item' }}
                                    </h3>

                                    <p class="text-[#243A69] mb-2">
                                        <span class="font-semibold">Data:</span>
                                        {{ $item->created_at->format('d/m/Y') }}
                                    </p>

                                    <p class="text-[#243A69]">
                                        <span class="font-semibold">Local:</span>
                                        {{ $item->place->full_address ?? '---' }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="text-[#243A69] text-lg">Nenhum item encontrado.</p>
                    @endforelse
                </div>
                <div class="text-center mt-8">
                    <a href="{{ route('item.all') }}" 
                    class="bg-[#243A69] hover:bg-[#1a2a4a] text-[#F4F4F2] font-bold px-8 py-3 rounded-md transition duration-300">
                        Ver Todos os Itens
                    </a>
                </div>

            </div>

            {{-- --------------------------------------- --}}
            {{-- INÍCIO: SEÇÃO ÚLTIMAS NOTÍCIAS --}}
            {{-- --------------------------------------- --}}
            <div class="mb-12">
                <h2 class="text-3xl md:text-4xl font-bold family-poppins text-[#243a69] mb-6 border-b-2 border-[#243a69] pb-2">
                    Últimas Notícias:
                </h2>

                @forelse ($noticiasRecentes as $noticia)
                    <a href="{{ route('noticias') }}" class="block p-4 mb-4 bg-white rounded-lg shadow-md hover:bg-[#D4CDC5] transition duration-300 border-l-4 border-blue-600">
                        <div class="flex justify-between items-start">
                            <h3 class="text-xl font-bold text-[#243A69] pr-4">{{ $noticia->title }}</h3>
                            <span class="text-sm text-gray-500 whitespace-nowrap">
                                {{ $noticia->created_at->format('d/m/Y') }}
                            </span>
                        </div>
                        <p class="text-[#243A69] mt-2 text-base line-clamp-2">
                            {{ Str::limit($noticia->content, 150) }}
                        </p>
                        <p class="text-sm text-blue-600 font-semibold mt-2">Leia mais...</p>
                    </a>
                @empty
                    <div class="p-4 bg-white rounded-lg shadow-md text-center">
                        <p class="text-[#243A69] text-lg">Nenhuma notícia recente disponível.</p>
                    </div>
                @endforelse
                
                <div class="text-center mt-8">
                    <a href="{{ route('noticias') }}" 
                       class="bg-[#243A69] hover:bg-[#1a2a4a] text-[#F4F4F2] font-bold px-8 py-3 rounded-md transition duration-300">
                        Ver Todas as Notícias
                    </a>
                </div>
            </div>
            {{-- --------------------------------------- --}}
            {{-- FIM: SEÇÃO ÚLTIMAS NOTÍCIAS --}}
            {{-- --------------------------------------- --}}
            
        </div>

        <footer class="bg-[#5B88A5] w-full py-4 mt-auto">
            <p class="text-center text-[#F4F4F2] text-sm">© 2025 Sumiu&Achou - Site para fins educativos</p>
        </footer>

        @stack('scripts')
    </body>
</html>