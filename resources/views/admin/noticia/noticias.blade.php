<x-admin-layout>
    
    <h1 class="text-3xl font-bold text-[#243A69] mb-8 border-b pb-4">
        Gerenciar Notícias e Avisos
    </h1>
    

    {{-- Seção 1: Formulário de Nova Notícia --}}
    <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-3">
            Criar Nova Notícia
        </h2>
        
        <form method="POST" action="#">
            @csrf

            {{-- Título da Notícia --}}
            <div class="mb-4">
                <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" id="titulo" name="titulo" required 
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 focus:ring-[#5b88a5] focus:border-[#5b88a5]">
            </div>

            {{-- Descrição/Conteúdo da Notícia --}}
            <div class="mb-6">
                <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição/Conteúdo</label>
                <textarea id="descricao" name="descricao" rows="5" required
                          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 focus:ring-[#5b88a5] focus:border-[#5b88a5]"></textarea>
            </div>
            
            {{-- Botão de Postar --}}
            <div class="flex justify-end">
                <button type="submit" 
                        class="px-6 py-2 bg-[#243A69] text-white font-semibold rounded-md hover:bg-[#1a2c52] transition duration-150">
                    Postar Notícia
                </button>
            </div>
        </form>
    </div>


    {{-- Seção 2: Listagem das Notícias --}}
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="p-4">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Notícias Publicadas</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Título
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Resumo da Descrição
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Ações</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        
                        {{-- Exemplo de Loop (Substitua por seu loop real, e.g., @foreach ($noticias as $noticia)) --}}
                        @php
                            $noticias = [
                                ['titulo' => 'Mudança no Horário de Verão', 'resumo' => 'Informamos que o novo horário de verão...', 'status' => 'Ativa', 'status_class' => 'bg-green-100 text-green-800'],
                                ['titulo' => 'Manutenção Programada do Sistema', 'resumo' => 'O sistema passará por manutenção no dia...', 'status' => 'Inativa', 'status_class' => 'bg-gray-100 text-gray-800'],
                                ['titulo' => 'Novo Item Encontrado - Chaveiro', 'resumo' => 'Foi encontrado um chaveiro na portaria...', 'status' => 'Rascunho', 'status_class' => 'bg-yellow-100 text-yellow-800'],
                            ];
                        @endphp

                        @foreach ($noticias as $noticia)
                            <tr>
                                {{-- Título --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $noticia['titulo'] }}
                                </td>
                                
                                {{-- Resumo da Descrição (Truncado) --}}
                                <td class="px-6 py-4 text-sm text-gray-500 max-w-sm truncate">
                                    {{ $noticia['resumo'] }}
                                </td>
                                
                                {{-- Status (Com Badge) --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $noticia['status_class'] }}">
                                        {{ $noticia['status'] }}
                                    </span>
                                </td>
                                
                                {{-- Ações --}}
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-[#5b88a5] hover:text-[#497187] mr-3">Editar</a>
                                    <a href="#" class="text-red-600 hover:text-red-900">Excluir</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-admin-layout>