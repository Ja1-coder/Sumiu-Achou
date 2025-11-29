<x-admin-layout>
    
    <h1 class="text-3xl font-bold text-[#243A69] mb-8 border-b pb-4">
        Editar Usuário
    </h1>

    <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto">
        
        <form method="POST" action="{{ route('admin.atualizar-usuario', $user->id) }}">
            @csrf
            @method('PUT')

            {{-- Nome --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nome Completo</label>
                <input type="text" name="name" value="{{ $user->name }}" required
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5">
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" required
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5">
            </div>

            {{-- Tipo --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Tipo de Usuário</label>
                <select name="tipo" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5">
                    <option value="">Selecione o Tipo</option>
                    <option value="administrador" {{ $user->tipo === 'administrador' ? 'selected' : '' }}>Administrador</option>
                    <option value="supervisor" {{ $user->tipo === 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                </select>
            </div>

            <div class="mt-8 pt-4 border-t flex justify-end">
                <button type="submit"
                        class="px-6 py-2 bg-[#243A69] text-white font-semibold rounded-md hover:bg-[#1a2c52] transition duration-150">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>

</x-admin-layout>
