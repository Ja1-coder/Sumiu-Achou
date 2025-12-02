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
                <a href="{{route('user-option')}}" 
                class="text-[#243A69] font-semibold bg-[#F4F4F2] hover:bg-[#D4CDC5] px-4 py-2 rounded-md">
                    Trocar Acesso
                </a>
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
                <h1 class="text-3xl md:text-4xl font-bold family-poppins text-[#243a69] mb-6 border-b-2 border-[#243a69] pb-2">Todos os Itens</h1>
            </div>

            <div class="mb-8">
                <form action="{{ route('item.all') }}" method="GET" class="flex py-3 px-4 rounded-md border-2 border-[#243a69] overflow-hidden max-w-2xl mb-6">
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
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                {{-- Verifica se existem itens. Se não houver, exibe uma mensagem. --}}
                @forelse ($allItems as $item)
                    <a href="{{ route('item.show', ['id' => $item->id]) }}" 
                       class="bg-[#D4CDC5] rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 cursor-pointer">
                        
                        {{-- Imagem do Item. Certifique-se de que `image_path` está correto. --}}
                        @php
                            $img = $item->picture 
                                ? (Str::startsWith($item->picture, 'http') 
                                    ? $item->picture 
                                    : asset('storage/' . $item->picture))
                                : asset('images/no-image.png');
                        @endphp
                        <div class="h-48 bg-cover bg-center" 
                            style="background-image: url('{{ $img }}')">
                        </div>
                        
                        <div class="p-4 flex flex-col justify-between h-full">
                            <div>
                                {{-- Nome/Título do Item (Melhorado o espaçamento) --}}
                                <h3 class="text-[#243A69] font-extrabold text-xl mb-3 border-b-2 border-gray-300 pb-1 truncate">
                                    {{ $item->name }}
                                </h3>
                                
                                {{-- Detalhes (Data, Local, Tipo) --}}
                                <div class="space-y-1 text-sm text-[#243A69]">
                                    
                                    {{-- Data de Registro --}}
                                    <p>
                                        <span class="font-semibold">Data:</span> 
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                                    </p>
                                    
                                    {{-- Local de Encontro --}}
                                    <p>
                                        <span class="font-semibold">Local:</span> 
                                        {{ $item->place->full_address ?? 'Não Informado' }}
                                    </p>

                                    {{-- Tipo do Item --}}
                                    <p>
                                        <span class="font-semibold">Tipo:</span> 
                                        {{ $item->type->name ?? 'Não Classificado' }}
                                    </p>
                                    {{-- Status (Cor da Letra Dinâmica, Fundo Removido) --}}
                                    <p class="text-sm">
                                        <span class="font-semibold text-[#243A69]">Status:</span>

                                        @php
                                            // Definição das classes de cor para TEXTO, sem fundo
                                            $text_color = match($item->status) {
                                                \App\Models\Item::STATUS_STORED   => 'text-blue-600 font-bold',  // Ex: Armazenado
                                                \App\Models\Item::STATUS_RETURNED => 'text-green-600 font-bold', // Ex: Devolvido
                                                \App\Models\Item::STATUS_REPORTED => 'text-red-600 font-bold',   // Ex: Reportado
                                                default                           => 'text-gray-600',
                                            };
                                        @endphp

                                        {{-- Remoção de px-3, py-1, rounded-lg e substituição de 'text-white' pela cor dinâmica --}}
                                        <span class="text-sm {{ $text_color }}">
                                            {{ $item->status_label }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </a>
                @empty
                    {{-- Mensagem se a coleção estiver vazia --}}
                    <div class="md:col-span-2 lg:col-span-4 bg-white p-8 rounded-lg shadow-md">
                        <p class="text-center text-[#243A69] font-medium text-xl">
                            @if (request('q'))
                                {{-- Se houve um termo de busca, exibe-o --}}
                                Nenhum item encontrado para "{{ request('q') }}". 
                            @else
                                {{-- Se não houve termo de busca, exibe a mensagem padrão --}}
                                Nenhum item encontrado no momento. 
                            @endif
                        </p>
                    </div>
                @endforelse
            </div>
            
        </div>

        <footer class="bg-[#5B88A5] w-full py-4 mt-auto">
            <p class="text-center text-[#F4F4F2] text-sm">© 2025 Sumiu&Achou - Site para fins educativos</p>
        </footer>

        @stack('scripts')
    </body>
</html>