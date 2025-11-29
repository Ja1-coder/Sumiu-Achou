<x-admin-layout>
    
    <h1 class="text-3xl font-bold text-[#243A69] mb-8 border-b pb-4">
        Cadastrar Novo Usuário
    </h1>

    <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto">
        
        <form method="POST" action="{{ route('admin.criar-usuario') }}">
            @csrf

            {{-- 1. Nome do Usuário --}}
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nome Completo</label>
                <input type="text" id="name" name="name" required 
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 focus:ring-[#5b88a5] focus:border-[#5b88a5]">
            </div>

            {{-- 2. Email --}}
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required 
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 focus:ring-[#5b88a5] focus:border-[#5b88a5]">
            </div>

            {{-- 3. Tipo (Administrador ou Supervisor) --}}
            <div class="mb-6">
                <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo de Usuário</label>
                <select id="tipo" name="tipo" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 focus:ring-[#5b88a5] focus:border-[#5b88a5] appearance-none">
                    <option value="">Selecione o Tipo</option>
                    <option value="administrador">Administrador</option>
                    <option value="supervisor">Supervisor</option>
                </select>
            </div>
            
            {{-- Linha para Senhas (Organização em duas colunas) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                {{-- 4. Senha --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                    <input type="password" id="password" name="password" required 
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 focus:ring-[#5b88a5] focus:border-[#5b88a5]">
                </div>

                {{-- 5. Confirmar Senha --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required 
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 focus:ring-[#5b88a5] focus:border-[#5b88a5]">
                </div>
            </div>

            {{-- Botão de Cadastrar --}}
            <div class="mt-8 pt-4 border-t flex justify-end">
                <button type="submit" 
                        class="px-6 py-2 bg-[#243A69] text-white font-semibold rounded-md hover:bg-[#1a2c52] transition duration-150">
                    Cadastrar Usuário
                </button>
            </div>
        </form>
    </div>

</x-admin-layout>