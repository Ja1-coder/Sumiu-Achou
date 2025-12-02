<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

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
            <a href="{{route('user-option')}}" 
            class="text-[#243A69] font-semibold bg-[#F4F4F2] hover:bg-[#D4CDC5] px-4 py-2 rounded-md">
                Trocar Acesso
            </a>
        </div>
    </header>

    <div class="flex flex-col w-full lg:grow px-4 md:px-12">

        <!-- Botão Voltar -->
        <div class="mb-8">
            <a href="{{ url()->previous() }}"
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


        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-12 max-w-6xl mx-auto">

            <!-- Imagem -->
            <div class="flex items-start justify-center">
                <div class="bg-[#D4CDC5] rounded-lg shadow-lg overflow-hidden w-full max-w-md">
                    
                    @php
                        $img = $item->picture 
                            ? (Str::startsWith($item->picture, 'http') 
                                ? $item->picture 
                                : asset('storage/' . $item->picture))
                            : asset('images/no-image.png');
                    @endphp

                    <img src="{{ $img }}" class="w-full h-auto object-cover" alt="Imagem do item">
                </div>
            </div>

            <!-- Informações -->
            <div class="flex flex-col gap-8">

                <!-- Informações do Item -->
                <div class="bg-white p-8 rounded-lg shadow border border-[#243A69]">
                    <h2 class="text-[#243A69] font-bold text-2xl mb-6">Informações do Item</h2>

                    <p class="text-[#243A69] mb-4">
                        <span class="font-semibold">Nome:</span>
                        {{ $item->name }}
                    </p>

                    <p class="text-[#243A69] mb-4">
                        <span class="font-semibold">Tipo:</span>
                        {{ $item->type->name ?? 'Não informado' }}
                    </p>

                    <p class="text-[#243A69] mb-4">
                        <span class="font-semibold">Status:</span>

                        @php
                            $color = match($item->status) {
                                \App\Models\Item::STATUS_STORED   => 'bg-blue-600',
                                \App\Models\Item::STATUS_RETURNED => 'bg-green-600',
                                \App\Models\Item::STATUS_REPORTED => 'bg-red-600',
                                default => 'bg-gray-500',
                            };
                        @endphp

                        <span class="px-3 py-1 rounded-lg text-white {{ $color }}">
                            {{ $item->status_label }}
                        </span>
                    </p>


                    <p class="text-[#243A69] mb-4">
                        <span class="font-semibold">Cadastrado em:</span>
                        {{ $item->created_at->format('d/m/Y H:i') }}
                    </p>

                    <p class="text-[#243A69]">
                        <span class="font-semibold">Descrição:</span><br>
                        {{ $item->description ?? 'Nenhuma descrição informada.' }}
                    </p>
                </div>

                <!-- Local onde foi encontrado -->
                <div class="bg-white p-8 rounded-lg shadow border border-[#243A69]">
                    <h2 class="text-[#243A69] font-bold text-2xl mb-6">Local onde está armazenado</h2>

                    <p class="text-[#243A69] mb-4">
                        <span class="font-semibold">Endereço:</span><br>
                        {{ $item->place->full_address ?? 'Não informado' }}
                    </p>

                    <p class="text-[#243A69] mb-4">
                        <span class="font-semibold">Telefone:</span>
                        {{ $item->place->phone ?? 'Não informado' }}
                    </p>

                    <p class="text-[#243A69] mb-4">
                        <span class="font-semibold">E-mail:</span>
                        {{ $item->place->email ?? 'Não informado' }}
                    </p>

                    <p class="text-[#243A69]">
                        <span class="font-semibold">Horário de funcionamento:</span><br>
                        {{ $item->place->operating_hours ?? 'Não informado' }}
                    </p>
                </div>

                <!-- Contato -->
                <div class="bg-white rounded-lg shadow-lg p-8 border-2 border-[#243A69]">
                    <h2 class="text-[#243A69] font-bold text-3xl mb-6 text-center">
                        É seu? Entre em contato!
                    </h2>

                    <p class="text-[#243A69] text-xl mb-4 text-center">
                        <span class="font-semibold">Telefone do responsável:</span><br>
                        {{ $item->user->telefone ?? 'Não informado' }}
                    </p>

                    @php
                        $tel = preg_replace('/\D/', '', $item->user->telefone ?? '');
                    @endphp

                    <div class="flex justify-center">
                        <a href="{{ $tel ? 'https://wa.me/55' . $tel : '#' }}"
                           target="_blank"
                           class="inline-flex items-center bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold text-lg px-8 py-4 rounded-lg shadow-lg transition duration-300">

                            <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967 ..."/>
                            </svg>

                            WhatsApp
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-[#5B88A5] w-full py-4 mt-auto">
        <p class="text-center text-[#F4F4F2] text-sm">© 2025 Sumiu&Achou - Site para fins educativos</p>
    </footer>

</body>
</html>
