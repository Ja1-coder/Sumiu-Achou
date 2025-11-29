<x-admin-layout>
    
    <h1 class="text-3xl font-bold text-[#243A69] mb-8 border-b pb-4">
        Cadastro de Novo Item
    </h1>

    <form method="POST" action="#" class="p-8 rounded-lg" enctype="multipart/form-data">
        @csrf

        {{-- Layout Principal: Duas Colunas --}}
        <div class="flex flex-col lg:flex-row gap-8">

            <div class="w-full lg:w-2/3 space-y-6">
                
                {{-- 1. Nome do Item --}}
                <div>
                    <label for="nome" class="block text-sm font-medium text-gray-700">Nome do Item</label>
                    <input type="text" id="nome" name="nome" required 
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 focus:ring-[#5b88a5] focus:border-[#5b88a5]">
                </div>

                {{-- 2. Tipo (Select) --}}
                <div>
                    <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo</label>
                    <select id="tipo" name="tipo" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 focus:ring-[#5b88a5] focus:border-[#5b88a5] appearance-none">
                        <option value="">Selecione o Tipo</option>
                        <option value="eletronico">Eletrônico</option>
                        <option value="documento">Documento</option>
                        <option value="vestimenta">Vestimenta</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>

                {{-- 3. Data do Recebimento --}}
                <div>
                    <label for="data_recebimento" class="block text-sm font-medium text-gray-700">Data do Recebimento</label>
                    <input type="date" id="data_recebimento" name="data_recebimento" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 focus:ring-[#5b88a5] focus:border-[#5b88a5]">
                </div>

                {{-- 4. Descrição --}}
                <div>
                    <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                    <textarea id="descricao" name="descricao" rows="4" required
                              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 focus:ring-[#5b88a5] focus:border-[#5b88a5]"></textarea>
                </div>

                {{-- 5. URL da Imagem --}}
                <div>
                    <label for="imagem_url" class="block text-sm font-medium text-gray-700">URL da Imagem do Item</label>
                    <input type="file" id="imagem_url" name="imagem_url" placeholder="http://exemplo.com/imagem.jpg"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 focus:ring-[#5b88a5] focus:border-[#5b88a5]">
                </div>

            </div>
            
            <div class="w-full lg:w-1/3 p-4 border border-gray-200 rounded-md bg-gray-50 flex flex-col items-center justify-center space-y-3 h-full">
                <p class="text-sm font-semibold text-gray-600">Pré-visualização da Imagem:</p>
                <div class="w-full h-48 overflow-hidden rounded-md shadow-md bg-gray-300 flex items-center justify-center">
                    <img id="image_preview" src="" alt="Pré-visualização da Imagem" class="hidden w-full h-full object-contain">
                    <span id="placeholder_text" class="text-gray-500 text-center text-sm">A imagem aparecerá aqui após inserir a URL.</span>
                </div>
            </div>

        </div>
        
        {{-- Botão de Submissão --}}
        <div class="mt-8 pt-4 border-t flex justify-end">
            <button type="submit" 
                    class="px-6 py-2 bg-[#243A69] text-white font-semibold rounded-md hover:bg-[#1a2c52] transition duration-150">
                Cadastrar Item
            </button>
        </div>
    </form>

    {{-- Script JavaScript para a Pré-visualização --}}
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fileInput = document.getElementById('imagem_url');
                const imagePreview = document.getElementById('image_preview');
                const placeholderText = document.getElementById('placeholder_text');

                fileInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.src = e.target.result;
                            imagePreview.classList.remove('hidden');
                            placeholderText.classList.add('hidden');
                        };
                        reader.readAsDataURL(file);
                    } else {
                        imagePreview.src = '';
                        imagePreview.classList.add('hidden');
                        placeholderText.classList.remove('hidden');
                    }
                });
            });
        </script>
    @endpush

</x-admin-layout>