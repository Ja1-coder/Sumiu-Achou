<x-admin-layout>
    
    <h1 class="text-3xl font-bold text-[#243A69] mb-8 border-b pb-4 flex justify-between items-center">
        Gerenciar Usuários do Sistema
        {{-- Botão para criar novo usuário --}}
        <a href="{{route('admin.cadastrar-usuario')}}" class="px-4 py-2 bg-[#243A69] text-white text-sm font-semibold rounded-md hover:bg-[#1a2c52] transition duration-150">
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
                        @forelse ($users as $user)
                            <tr>
                                {{-- Nome --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $user->name }}
                                </td>
                                
                                {{-- Email --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->email }}
                                </td>

                                {{-- Nº de Lugares Associados --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-700">
                                    {{ $user->places->count() }} 
                                </td>
                                
                                {{-- Ações --}}
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    {{-- Lembre-se de substituir o '#' pelas rotas reais de edição/exclusão, passando o ID do usuário --}}
                                    <a href="#" class="text-[#5b88a5] hover:text-[#497187] mr-3">Editar</a>
                                    <a href="#" onclick="confirmDelete({{ $user->id }})" class="text-red-600 hover:text-red-900">Excluir</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    Nenhum usuário encontrado (além do seu próprio).
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $users->links() }}
            </div>
        </div>
    </div>

</x-admin-layout>