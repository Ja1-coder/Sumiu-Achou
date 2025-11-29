<x-admin-layout>
    
    <h1 class="text-3xl font-bold text-[#243A69] mb-8 border-b pb-4 flex justify-between items-center">
        Lista de Itens Cadastrados
        {{-- Botão para adicionar novo item --}}
        <a href="{{route('admin.cadastrar-item')}}" class="px-4 py-2 bg-[#5b88a5] text-white text-sm font-semibold rounded-md hover:bg-[#497187] transition duration-150">
            + Novo Item
        </a>
    </h1>


    {{-- Seção da Tabela com as colunas solicitadas --}}
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="p-4">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Itens Encontrados</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            {{-- Nome --}}
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nome
                            </th>
                            {{-- Tipo --}}
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tipo
                            </th>
                            {{-- Status --}}
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Data de Cadastro
                            </th>
                            {{-- Ações --}}
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Ações</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        
                        {{-- Exemplo de Loop (Substitua por seu loop real, e.g., @foreach ($itens as $item)) --}}
                        @php
                            $statuses = [
                                'Recebido' => 'bg-green-100 text-green-800', 
                                'Aguardando Devolução' => 'bg-yellow-100 text-yellow-800',
                                'Devolvido' => 'bg-blue-100 text-blue-800'
                            ];
                            $tipos = ['eletronico', 'documento', 'vestimenta', 'outro'];
                        @endphp

                        @for ($i = 0; $i < 5; $i++)
                            @php
                                $currentStatus = array_keys($statuses)[$i % count($statuses)];
                                $statusClasses = $statuses[$currentStatus];
                                $currentTipo = $tipos[$i % count($tipos)];
                            @endphp

                            <tr>
                                {{-- Nome --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    Item Encontrado {{ $i + 1 }}
                                </td>
                                
                                {{-- Tipo --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                    {{ $currentTipo }}
                                </td>
                                
                                {{-- Status (Com Badge para destaque) --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses }}">
                                        {{ $currentStatus }}
                                    </span>
                                </td>

                                {{-- Data de Cadastro --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ now()->subDays($i)->format('d/m/Y') }}
                                </td>
                                
                                {{-- Ações --}}
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-[#5b88a5] hover:text-[#497187] mr-3">Editar</a>
                                    <a href="#" class="text-red-600 hover:text-red-900">Excluir</a>
                                </td>
                            </tr>
                        @endfor

                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{-- Exemplo de Paginação --}}
                <p class="text-sm text-gray-600">
                    Mostrando 1 a 10 de 50 resultados.
                </p>
            </div>
        </div>
    </div>

</x-admin-layout>