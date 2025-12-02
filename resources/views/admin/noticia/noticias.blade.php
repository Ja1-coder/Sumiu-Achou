<x-admin-layout>

    <h1 class="text-3xl font-bold text-[#243A69] mb-8 border-b pb-4">
        Gerenciar Notícias e Avisos
    </h1>

    {{-- FORMULÁRIO DE NOVA NOTÍCIA --}}
    <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-3">
            Criar Nova Notícia
        </h2>

        <form method="POST" action="{{ route('admin.criar-noticia') }}">
            @csrf

            {{-- Título --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" name="titulo" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5">
            </div>

            {{-- Descrição --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Descrição</label>
                <textarea name="descricao" rows="5" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5"></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-[#243A69] text-white font-semibold rounded-md hover:bg-[#1a2c52]">
                    Postar Notícia
                </button>
            </div>
        </form>
    </div>

    {{-- LISTAGEM DAS NOTÍCIAS --}}
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="p-4">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Notícias Publicadas</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Título</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Resumo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Criada em</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">

                        @forelse ($noticias as $noticia)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $noticia->title }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-500 max-w-sm truncate">
                                    {{ Str::limit($noticia->description, 60) }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ $noticia->created_at->format('d/m/Y') }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button
                                        onclick="excluirNoticia({{ $noticia->id }})"
                                        class="text-red-600 hover:text-red-900">
                                        Excluir
                                    </button>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    Nenhuma notícia cadastrada.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function excluirNoticia(id) {
            Swal.fire({
                title: "Tem certeza?",
                text: "Essa ação não poderá ser desfeita!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                scrollbarPadding: false,
                heightAuto: false,
                reverseButtons: true,
                confirmButtonText: "Sim, excluir!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/excluir-noticia/${id}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json"
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: "Excluída!",
                                text: data.message,
                                icon: "success",
                                scrollbarPadding: false,
                                heightAuto: false
                            }).then(() => location.reload());
                        }
                    })
                }
            });
        }
    </script>
    @endpush

</x-admin-layout>
