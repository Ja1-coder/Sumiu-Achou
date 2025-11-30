<x-admin-layout>
    
    <h1 class="text-3xl font-bold text-[#243A69] mb-8 border-b pb-4 flex justify-between items-center">
        Gerenciar Lugares
        <a href="{{ route('admin.cadastrar-lugar') }}"
           class="px-4 py-2 bg-[#243A69] text-white text-sm font-semibold rounded-md hover:bg-[#1a2c52] transition">
            + Novo Lugar
        </a>
    </h1>

    {{-- Grid de Lugares --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        @forelse ($places as $place)
            <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-blue-600 hover:shadow-xl transition duration-200 flex flex-col justify-between">

                {{-- Conteúdo do Card --}}
                <div class="mb-4">
                    <h3 class="text-xl font-bold text-gray-800 mb-2 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-gray-500" fill="none" stroke="currentColor" 
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $place->full_address }}
                    </h3>

                    {{-- Quantidade de Itens --}}
                    <p class="text-sm text-gray-600 font-medium">Itens cadastrados:</p>
                    <span class="text-3xl font-extrabold text-blue-700">
                        {{ $place->items->count() }}
                    </span>

                    {{-- Responsáveis --}}
                    <div class="mt-4">
                        <p class="text-sm font-medium text-gray-700 mb-1">Responsáveis:</p>

                        @if ($place->users->isEmpty())
                            <p class="text-gray-500 text-sm italic">Nenhum responsável cadastrado.</p>
                        @else
                            <ul class="text-gray-700 text-sm list-none ml-2">
                                @foreach ($place->users as $user)
                                    <li>{{ $user->name }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                {{-- Ações --}}
                <div class="flex justify-between items-center mt-4 pt-3 border-t border-gray-100">
                    <div>
                        <a href="{{ route('admin.editar-lugar', $place->id) }}"
                           class="text-sm text-gray-500 hover:text-gray-700 mr-4">
                            Editar
                        </a>

                        {{-- Só mostra excluir se não tiver itens --}}
                        @if ($place->items->count() == 0)
                            <a href="#"
                                class="text-sm text-red-500 hover:text-red-700"
                                onclick="confirmDelete('{{ route('admin.excluir-lugar', $place->id) }}')">
                                Excluir
                            </a>
                        @endif
                    </div>
                </div>

            </div>

        @empty
            <p class="text-gray-600">Nenhum lugar cadastrado.</p>
        @endforelse

    </div>

@push('scripts')
<script>
    function confirmDelete(url) {
        Swal.fire({
            title: 'Tem certeza?',
            text: "Esta ação não poderá ser desfeita!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, excluir',
            cancelButtonText: 'Cancelar',
            scrollbarPadding: false,
            heightAuto: false,
            reverseButtons: true
            
        }).then((result) => {
            if (result.isConfirmed) {

                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;

                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;

                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@endpush

</x-admin-layout>
