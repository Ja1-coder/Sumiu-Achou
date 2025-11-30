<x-admin-layout>

<h1 class="text-3xl font-bold text-[#243A69] mb-8 border-b pb-4 flex justify-between items-center">
    Lista de Itens Cadastrados
    <a href="{{ route('admin.cadastrar-item') }}" 
        class="px-4 py-2 bg-[#243A69] text-white text-sm font-semibold rounded-md hover:bg-[#1a2c52] transition">
        + Novo Item
    </a>
</h1>

<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="p-4">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Itens Encontrados</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lugar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data Devolução</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data Armazenamento</th>
                        <th class="relative px-6 py-3"><span class="sr-only">Ações</span></th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($items as $item)
                        <tr>
                            {{-- Nome --}}
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                {{ $item->name }}
                            </td>

                            {{-- Tipo --}}
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $item->type->name }}
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                    {{ $item->status === 0 ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $item->status === 1 ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $item->status === 2 ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ $item->statusLabel }}
                                </span>
                            </td>

                            {{-- Prédio armazenado --}}
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $item->place->full_address ?? '—' }}
                            </td>

                            {{-- Data de devolução --}}
                            <td class="px-6 py-4 text-sm text-gray-700">
                                @if ($item->delivery_date)
                                    {{ \Carbon\Carbon::parse($item->delivery_date)->format('d/m/Y H:i') }}
                                @else
                                    <span class="text-gray-400 italic">Não devolvido</span>
                                @endif
                            </td>

                            {{-- Data criação --}}
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $item->created_at->format('d/m/Y') }}
                            </td>

                            {{-- Ações --}}
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                                @if ($item->status === \App\Models\Item::STATUS_STORED 
                                    || $item->status === \App\Models\Item::STATUS_REPORTED)

                                    <button onclick="returnItem('{{ route('admin.devolver-item', $item->id) }}')"
                                            class="text-green-600 hover:text-green-800 mr-4">
                                        Devolver
                                    </button>

                                @elseif ($item->status === \App\Models\Item::STATUS_RETURNED)

                                    <button onclick="reportItem('{{ route('admin.reportar-item', $item->id) }}')"
                                            class="text-yellow-600 hover:text-yellow-800 mr-4">
                                        Reportar
                                    </button>

                                @endif

                                <button onclick='viewItem({!! json_encode($item) !!})'
                                        class="text-gray-600 hover:text-gray-900 mr-4">
                                    Visualizar
                                </button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div class="mt-4">
            {{ $items->links() }}
        </div>
    </div>
</div>

@push('scripts')
<script>
    function viewItem(item) {
        Swal.fire({
            title: `<strong>Detalhes do Item</strong>`,
            scrollbarPadding: false,
            heightAuto: false,
            html: `
                <div style="text-align: left;">
                    <p><strong>Nome:</strong> ${item.name}</p>
                    <p><strong>Tipo:</strong> ${item.type?.name ?? '—'}</p>
                    <p><strong>Status:</strong> ${item.status_text}</p>

                    <p><strong>Data de Criação:</strong> 
                        ${new Date(item.created_at).toLocaleDateString('pt-BR')}
                    </p>

                    <p><strong>Data de Devolução:</strong> 
                        ${item.delivery_date 
                            ? new Date(item.delivery_date).toLocaleDateString('pt-BR') 
                            : '<span style="color:red">Não devolvido</span>'
                        }
                    </p>

                    <p><strong>Matrícula do Aluno:</strong> 
                        ${item.enrollment ?? '—'}
                    </p>

                    <p><strong>Prédio Armazenado:</strong> 
                        ${item.place?.full_address ?? '—'}
                    </p>

                    <p><strong>Email de Contato:</strong> 
                        ${item.report_contact_email ?? '—'}
                    </p>
                </div>
            `,
            icon: "info",
            confirmButtonText: "Fechar",
            confirmButtonColor: "#3085d6",
            width: 500,
        });
    }
    function returnItem(url) {
        Swal.fire({
            title: 'Devolver item',
            html: `
                <input id="swal-matricula" 
                    class="swal2-input" 
                    placeholder="Matrícula do aluno">
            `,
            showCancelButton: true,
            confirmButtonText: 'Confirmar Devolução',
            cancelButtonText: 'Cancelar',
            scrollbarPadding: false,
            heightAuto: false,
            preConfirm: () => {
                const matricula = document.getElementById('swal-matricula').value;
                if (!matricula.trim()) {
                    Swal.showValidationMessage('A matrícula é obrigatória');
                    return false;
                }
                return { matricula };
            }
        }).then((result) => {
            if (result.isConfirmed) {

                // Enviar via POST (método PUT) para Laravel
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;

                form.innerHTML = `
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="registration" value="${result.value.matricula}">
                `;

                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    function reportItem(url) {
        Swal.fire({
            title: 'Reportar item',
            html: `
                <input id="swal-email" 
                    class="swal2-input" 
                    placeholder="Email para contato">
            `,
            inputAttributes: {
                autocomplete: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Enviar Reporte',
            cancelButtonText: 'Cancelar',
            scrollbarPadding: false,
            heightAuto: false,
            preConfirm: () => {
                const email = document.getElementById('swal-email').value;
                if (!email.trim()) {
                    Swal.showValidationMessage('O email é obrigatório');
                    return false;
                }
                return { email };
            }
        }).then((result) => {
            if (result.isConfirmed) {

                // Enviar via POST (PUT)
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;

                form.innerHTML = `
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="email" value="${result.value.email}">
                `;

                document.body.appendChild(form);
                form.submit();
            }
        });
    }


</script>
@endpush
</x-admin-layout>