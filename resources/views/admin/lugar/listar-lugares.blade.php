<x-admin-layout>
    
    <h1 class="text-3xl font-bold text-[#243A69] mb-8 border-b pb-4 flex justify-between items-center">
        Gerenciar Lugares
        {{-- Botão para adicionar novo lugar --}}
        <a href="#" class="px-4 py-2 bg-[#243A69] text-white text-sm font-semibold rounded-md hover:bg-[#1a2c52] transition duration-150">
            + Novo Lugar
        </a>
    </h1>
    
    ---

    {{-- Seção de Cards (Grid Responsivo) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        
        {{-- Exemplo de Loop (Substitua por seu loop real, e.g., @foreach ($lugares as $lugar)) --}}
        @php
            $lugares = [
                ['nome' => 'Recepção Principal', 'itens' => 15, 'cor' => 'blue'],
                ['nome' => 'Sala de Reuniões A', 'itens' => 5, 'cor' => 'green'],
                ['nome' => 'Armário de TI', 'itens' => 22, 'cor' => 'red'],
                ['nome' => 'Portaria Sul', 'itens' => 8, 'cor' => 'yellow'],
                ['nome' => 'Estacionamento', 'itens' => 3, 'cor' => 'indigo'],
                ['nome' => 'Cozinha', 'itens' => 12, 'cor' => 'pink'],
            ];
            
            $colors = [
                'blue' => ['bg-blue-100', 'text-blue-800', 'border-blue-500'],
                'green' => ['bg-green-100', 'text-green-800', 'border-green-500'],
                'red' => ['bg-red-100', 'text-red-800', 'border-red-500'],
                'yellow' => ['bg-yellow-100', 'text-yellow-800', 'border-yellow-500'],
                'indigo' => ['bg-indigo-100', 'text-indigo-800', 'border-indigo-500'],
                'pink' => ['bg-pink-100', 'text-pink-800', 'border-pink-500'],
            ];
        @endphp

        @foreach ($lugares as $lugar)
            @php
                $color = $colors[$lugar['cor']];
            @endphp
            
            {{-- Card Individual --}}
            <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 {{ $color[2] }} hover:shadow-xl transition duration-200 flex flex-col justify-between">
                
                <div class="mb-4">
                    {{-- Nome do Lugar --}}
                    <h3 class="text-xl font-bold text-gray-800 mb-2 flex items-center">
                        {{-- Ícone de Localização --}}
                        <svg class="w-6 h-6 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $lugar['nome'] }}
                    </h3>
                    
                    {{-- Status/Métrica --}}
                    <p class="text-sm font-medium text-gray-600">
                        Itens Cadastrados:
                    </p>
                    <span class="text-3xl font-extrabold {{ $color[1] }}">
                        {{ $lugar['itens'] }}
                    </span>
                    <span class="text-base text-gray-500">
                        itens
                    </span>
                </div>

                {{-- Ações do Card --}}
                <div class="flex justify-between items-center mt-4 pt-3 border-t border-gray-100">
                    <a href="#" class="text-sm font-semibold text-[#5b88a5] hover:text-[#497187]">
                        Ver Itens →
                    </a>
                    <div>
                        <a href="#" class="text-sm text-gray-500 hover:text-gray-700 mr-4">Editar</a>
                        <a href="#" class="text-sm text-red-500 hover:text-red-700">Excluir</a>
                    </div>
                </div>

            </div>
        @endforeach
        {{-- Fim do Exemplo de Loop --}}

    </div>
    
</x-admin-layout>