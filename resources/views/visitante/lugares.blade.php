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
                <h1 class="text-3xl md:text-4xl font-bold family-poppins text-[#243a69] mb-6 border-b-2 border-[#243a69] pb-2">Onde ficam os Itens Perdidos?</h1>
            </div>

            <div class="flex-1 mb-12">
                
                @forelse ($places as $place)
                    <div class="bg-white rounded-lg shadow-xl p-8 md:p-10 mb-8 border-l-4 border-[#243A69]">
                        <h2 class="text-3xl font-bold text-[#243A69] mb-4">{{ $place->full_address ?? 'Local de Armazenamento' }}</h2>
                        <p class="text-lg text-gray-700 mb-6">
                            Este é um dos locais onde você pode recuperar ou entregar itens perdidos.
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-[#243A69] text-lg">
                            
                            {{-- Informações de Contato e Endereço --}}
                            <div class="space-y-4">
                                <h3 class="text-xl font-semibold border-b pb-2 mb-3">Contato e Endereço</h3>
                                
                                <p class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 text-[#5B88A5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-4.5a18.067 18.067 0 01-13.492-13.492H3z" />
                                    </svg>
                                    <span>Telefone: <span class="font-medium">{{ $place->phone ?? 'Não Informado' }}</span></span>
                                </p>
                                
                                <p class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 text-[#5B88A5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span>Email: <span class="font-medium">{{ $place->email ?? 'Não Informado' }}</span></span>
                                </p>
                            </div>

                            {{-- Horário de Funcionamento --}}
                            <div>
                                <h3 class="text-xl font-semibold border-b pb-2 mb-3">Horário de Funcionamento</h3>
                                <p class="flex items-start gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 mt-0.5 text-[#5B88A5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="font-medium whitespace-pre-line">{{ $place->operating_hours ?? 'Horário não cadastrado.' }}</span>
                                </p>

                                <div class="bg-[#F4F4F2] rounded-lg p-4 mt-6 border border-gray-300">
                                    <h4 class="text-base font-semibold text-[#243A69] mb-1">Dica Importante:</h4>
                                    <p class="text-sm">Sempre ligue ou envie um e-mail antes de se dirigir ao local, especialmente em feriados.</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    @empty
                    <div class="bg-white rounded-lg shadow-md p-10 text-center border-l-4 border-gray-400">
                        <h2 class="text-2xl font-bold text-[#243A69] mb-3">Nenhum Local de Armazenamento Cadastrado</h2>
                        <p class="text-lg text-gray-700">Não há informações sobre locais de Achados e Perdidos disponíveis no momento.</p>
                    </div>
                @endforelse
                
            </div>
            
            {{-- --------------------------------------- --}}
            
        </div>

        <footer class="bg-[#5B88A5] w-full py-4 mt-auto">
            <p class="text-center text-[#F4F4F2] text-sm">© 2025 Sumiu&Achou - Site para fins educativos</p>
        </footer>

        @stack('scripts')
    </body>
</html>