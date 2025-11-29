<x-admin-layout>
    
    <h1 class="text-3xl font-bold text-[#243A69] mb-8 border-b pb-4 flex justify-between items-center">
        Gerenciar Usuários do Sistema
        {{-- Botão para criar novo usuário --}}
        <a href="#" class="px-4 py-2 bg-[#243A69] text-white text-sm font-semibold rounded-md hover:bg-[#1a2c52] transition duration-150">
            + Novo Usuário
        </a>
    </h1>

    {{-- Seção da Tabela de Usuários --}}
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="p-4">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Usuários Cadastrados</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            {{-- Nome --}}
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nome
                            </th>
                            {{-- Email (Adicionado, pois é essencial para usuários) --}}
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            {{-- Nº de Lugares Associados --}}
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                N° de Lugares Associados
                            </th>
                            {{-- Ações --}}
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Ações</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        
                        {{-- Exemplo de Loop (Substitua por seu loop real, e.g., @foreach ($usuarios as $usuario)) --}}
                        @php
                            $nomes = ['João Silva', 'Maria Santos', 'Carlos Souza', 'Ana Oliveira', 'Pedro Costa'];
                        @endphp

                        @foreach ($nomes as $index => $nome)
                            <tr>
                                {{-- Nome --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $nome }}
                                </td>
                                
                                {{-- Email --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ strtolower(str_replace(' ', '.', $nome)) }}@empresa.com
                                </td>

                                {{-- Nº de Lugares Associados (Número aleatório para o exemplo) --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-700">
                                    {{ ($index % 3) + 1 }}
                                </td>
                                
                                {{-- Ações --}}
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-[#5b88a5] hover:text-[#497187] mr-3">Editar</a>
                                    <a href="#" class="text-red-600 hover:text-red-900">Excluir</a>
                                    {{-- Exemplo de botão de Desativar --}}
                                    <a href="#" class="text-yellow-600 hover:text-yellow-800 ml-3">Desativar</a>
                                </td>
                            </tr>
                        @endforeach
                        {{-- Fim do Exemplo de Loop --}}

                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{-- Exemplo de Paginação (se necessário) --}}
                <p class="text-sm text-gray-600">
                    Mostrando 1 a 5 de 15 resultados.
                </p>
            </div>
        </div>
    </div>

</x-admin-layout>