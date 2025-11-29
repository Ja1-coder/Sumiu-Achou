<x-admin-layout>
    
    <h1 class="text-3xl font-bold text-[#243A69] mb-8 border-b pb-4">
        Dashboard do Sistema de Itens
    </h1>
    
    {{-- Inclusão do Chart.js (IMPORTANTE: Mova para a tag <head> ou use CDN) --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Seção 1: Cards de Resumo (Métricas Principais) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        
        {{-- Card 1: Total de Itens Cadastrados --}}
        <div class="bg-white p-5 rounded-lg shadow-lg border-l-4 border-l-[#243A69]">
            <p class="text-sm font-medium text-gray-500">Total de Itens</p>
            <p class="text-3xl font-bold text-gray-900 mt-1">125</p>
            <p class="text-xs text-gray-400 mt-2">Geral no Sistema</p>
        </div>

        {{-- Card 2: Itens em Aberto --}}
        <div class="bg-white p-5 rounded-lg shadow-lg border-l-4 border-l-yellow-500">
            <p class="text-sm font-medium text-gray-500">Itens em Aberto</p>
            <p class="text-3xl font-bold text-yellow-600 mt-1">45</p>
            <p class="text-xs text-gray-400 mt-2">Aguardando Devolução</p>
        </div>

        {{-- Card 3: Itens Devolvidos --}}
        <div class="bg-white p-5 rounded-lg shadow-lg border-l-4 border-l-green-500">
            <p class="text-sm font-medium text-gray-500">Itens Devolvidos</p>
            <p class="text-3xl font-bold text-green-600 mt-1">80</p>
            <p class="text-xs text-gray-400 mt-2">Processo Concluído</p>
        </div>

        {{-- Card 4: Novos Itens no Mês --}}
        <div class="bg-white p-5 rounded-lg shadow-lg border-l-4 border-l-blue-500">
            <p class="text-sm font-medium text-gray-500">Recebidos (30 dias)</p>
            <p class="text-3xl font-bold text-blue-600 mt-1">15</p>
            <p class="text-xs text-gray-400 mt-2">Novos itens neste mês</p>
        </div>
    </div>

    {{-- Seção 2: Gráficos (Chart.js) --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Gráfico 1: Itens por Status (Doughnut) --}}
        <div class="lg:col-span-1 bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Itens por Status</h3>
            <div class="h-64 flex items-center justify-center">
                <canvas id="statusChart"></canvas>
            </div>
        </div>

        {{-- Gráfico 2: Itens por Tipo (Barra) --}}
        <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Contagem por Tipo de Item</h3>
            <div class="h-80">
                <canvas id="typeChart"></canvas>
            </div>
        </div>
        
    </div>

    ---
    
    {{-- Script JavaScript para Inicializar o Chart.js --}}
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                
                // Dados simulados (Substitua por dados vindos do seu Controller/Blade)
                const mockData = {
                    status: {
                        labels: ['Recebido', 'Aguardando Devolução', 'Devolvido'],
                        data: [25, 45, 80],
                        colors: ['#243A69', '#F6AD55', '#48BB78'] // Azul, Amarelo, Verde
                    },
                    types: {
                        labels: ['Eletrônico', 'Documento', 'Vestimenta', 'Outro'],
                        data: [40, 30, 15, 40],
                        colors: ['#4299E1', '#F56565', '#9F7AEA', '#4FD1C5'] // Cores diversas
                    }
                };

                // 1. Gráfico de Status (Doughnut Chart)
                const statusCtx = document.getElementById('statusChart').getContext('2d');
                new Chart(statusCtx, {
                    type: 'doughnut',
                    data: {
                        labels: mockData.status.labels,
                        datasets: [{
                            data: mockData.status.data,
                            backgroundColor: mockData.status.colors,
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                            },
                            title: {
                                display: false
                            }
                        }
                    }
                });

                // 2. Gráfico de Tipos (Bar Chart)
                const typeCtx = document.getElementById('typeChart').getContext('2d');
                new Chart(typeCtx, {
                    type: 'bar',
                    data: {
                        labels: mockData.types.labels,
                        datasets: [{
                            label: 'Contagem de Itens',
                            data: mockData.types.data,
                            backgroundColor: mockData.types.colors,
                            borderRadius: 5,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
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