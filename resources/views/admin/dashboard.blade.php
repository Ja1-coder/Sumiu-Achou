<x-admin-layout>
    
    <h1 class="text-3xl font-bold text-[#243A69] mb-8 border-b pb-4">
        Dashboard do Sistema de Itens
    </h1>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    {{-- =======================
         MÉTRICAS PRINCIPAIS
    ========================== --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

        {{-- Total --}}
        <div class="bg-white p-5 rounded-lg shadow-lg border-l-4 border-l-[#243A69]">
            <p class="text-sm font-medium text-gray-500">Total de Itens</p>
            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalItems }}</p>
            <p class="text-xs text-gray-400 mt-2">Total dos Lugares Permitidos</p>
        </div>

        {{-- Armazenados --}}
        <div class="bg-white p-5 rounded-lg shadow-lg border-l-4 border-l-yellow-500">
            <p class="text-sm font-medium text-gray-500">Itens Armazenados</p>
            <p class="text-3xl font-bold text-yellow-600 mt-1">{{ $storedItems }}</p>
            <p class="text-xs text-gray-400 mt-2">Aguardando Devolução</p>
        </div>

        {{-- Devolvidos --}}
        <div class="bg-white p-5 rounded-lg shadow-lg border-l-4 border-l-green-500">
            <p class="text-sm font-medium text-gray-500">Itens Devolvidos</p>
            <p class="text-3xl font-bold text-green-600 mt-1">{{ $returnedItems }}</p>
            <p class="text-xs text-gray-400 mt-2">Processo Concluído</p>
        </div>

        {{-- Reportados --}}
        <div class="bg-white p-5 rounded-lg shadow-lg border-l-4 border-l-red-500">
            <p class="text-sm font-medium text-gray-500">Itens Reportados</p>
            <p class="text-3xl font-bold text-red-600 mt-1">{{ $reportedItems }}</p>
            <p class="text-xs text-gray-400 mt-2">Processo em Andamento</p>
        </div>

        {{-- Novos no mês --}}
        <div class="bg-white p-5 rounded-lg shadow-lg border-l-4 border-l-blue-500">
            <p class="text-sm font-medium text-gray-500">Recebidos (30 dias)</p>
            <p class="text-3xl font-bold text-blue-600 mt-1">{{ $newThisMonth }}</p>
            <p class="text-xs text-gray-400 mt-2">Novos itens no período</p>
        </div>
    </div>



    {{-- =======================
            GRÁFICOS
    ========================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- STATUS --}}
        <div class="lg:col-span-1 bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Itens por Status</h3>
            <div class="h-64 flex items-center justify-center">
                <canvas id="statusChart"></canvas>
            </div>
        </div>

        {{-- TIPOS --}}
        <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Itens por Tipo</h3>
            <div class="h-80">
                <canvas id="typeChart"></canvas>
            </div>
        </div>

    </div>



    {{-- =======================
            SCRIPTS
    ========================== --}}
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                // =============================
                //       DADOS DINÂMICOS
                // =============================

                const statusLabels = ['Armazenados', 'Devolvidos', 'Reportados'];
                const statusData = [
                    {{ $storedItems }},
                    {{ $returnedItems }},
                    {{ $reportedItems }},
                ];

                const typeLabels = {!! json_encode($itemsByType->keys()->map(function($id){
                    return \App\Models\ItemType::find($id)->name ?? 'Tipo desconhecido';
                })) !!};

                const typeData = {!! json_encode(array_values($itemsByType->toArray())) !!};



                // =============================
                //       GRÁFICO DE STATUS
                // =============================
                const statusCtx = document.getElementById('statusChart').getContext('2d');

                new Chart(statusCtx, {
                    type: 'doughnut',
                    data: {
                        labels: statusLabels,
                        datasets: [{
                            data: statusData,
                            backgroundColor: ['#F6AD55', '#48BB78', '#4299E1'],
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'bottom' }
                        }
                    }
                });



                // =============================
                //       GRÁFICO DE TIPOS
                // =============================
                const typeCtx = document.getElementById('typeChart').getContext('2d');

                new Chart(typeCtx, {
                    type: 'bar',
                    data: {
                        labels: typeLabels,
                        datasets: [{
                            label: 'Quantidade',
                            data: typeData,
                            backgroundColor: '#243A69',
                            borderRadius: 5
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

            });
        </script>
    @endpush

</x-admin-layout>
