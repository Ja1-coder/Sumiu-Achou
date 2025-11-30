<x-admin-layout>
    
    <h1 class="text-3xl font-bold text-[#243A69] mb-8 border-b pb-4">
        Cadastro de Novo Item
    </h1>

    <form method="POST" 
          action="{{ route('admin.salvar-item') }}" 
          class="p-8 rounded-lg" 
          enctype="multipart/form-data">
        @csrf

        <div class="flex flex-col lg:flex-row gap-8">

            <div class="w-full lg:w-2/3 space-y-6">
                
                {{-- Nome --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nome do Item</label>
                    <input type="text" name="name" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5">
                </div>

                {{-- Tipo --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tipo</label>
                    <select name="type_id" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5">
                        <option value="">Selecione o Tipo</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Lugar --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Local Armazenado</label>
                    <select name="place_id" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5">
                        <option value="">Selecione o Local</option>
                        @foreach ($places as $place)
                            <option value="{{ $place->id }}">
                                {{ $place->full_address }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Descrição --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Descrição</label>
                    <textarea name="description" rows="4" required
                              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5"></textarea>
                </div>

                {{-- Foto --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Foto do Item</label>
                    <input type="file" name="picture"
                           accept="image/*"
                           id="imagem_input"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5">
                </div>

            </div>
            
            {{-- Preview --}}
            <div class="w-full lg:w-1/3 p-4 border border-gray-200 rounded-md bg-gray-50 flex flex-col items-center justify-center space-y-3">
                <p class="text-sm font-semibold text-gray-600">Pré-visualização da Imagem:</p>

                <div class="w-full h-48 overflow-hidden rounded-md shadow-md bg-gray-300 flex items-center justify-center">
                    <img id="image_preview" class="hidden w-full h-full object-contain">
                    <span id="placeholder_text" class="text-gray-500 text-center text-sm">
                        A imagem aparecerá aqui após selecionar o arquivo.
                    </span>
                </div>
            </div>

        </div>
        
        <div class="mt-8 pt-4 border-t flex justify-end">
            <button type="submit"
                    class="px-6 py-2 bg-[#243A69] text-white font-semibold rounded-md hover:bg-[#1a2c52]">
                Cadastrar Item
            </button>
        </div>
    </form>

    @push('scripts')
        <script>
            const input = document.getElementById('imagem_input');
            const img = document.getElementById('image_preview');
            const txt = document.getElementById('placeholder_text');

            input.addEventListener('change', e => {
                const file = e.target.files[0];

                if (file) {
                    const reader = new FileReader();
                    reader.onload = ev => {
                        img.src = ev.target.result;
                        img.classList.remove('hidden');
                        txt.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                } else {
                    img.src = '';
                    img.classList.add('hidden');
                    txt.classList.remove('hidden');
                }
            });
        </script>
    @endpush

</x-admin-layout>
