<x-admin-layout>

    <h1 class="text-3xl font-bold text-[#243A69] mb-8 border-b pb-4">
        Editar Ponto de Coleta
    </h1>

    <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto">

        <form method="POST"
            action="{{route('admin.atualizar-lugar', $place->id)}}">
            @csrf
            @method('PUT')


            {{-- Endereço --}}
            <div class="mb-4">
                <label for="full_address" class="block text-sm font-medium text-gray-700">
                    Endereço Completo
                </label>
                <input type="text" id="full_address" name="full_address"
                       value="{{ old('full_address', $place->full_address ?? '') }}"
                       required
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5
                       focus:ring-[#5b88a5] focus:border-[#5b88a5]">
            </div>

            {{-- Telefone --}}
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">
                    Telefone
                </label>
                <input type="text" id="phone" name="phone"
                       value="{{ old('phone', $place->phone ?? '') }}"
                       required
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5
                       focus:ring-[#5b88a5] focus:border-[#5b88a5]">
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email', $place->email ?? '') }}"
                       required
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5
                       focus:ring-[#5b88a5] focus:border-[#5b88a5]">
            </div>

            {{-- Horário --}}
            <div class="mb-6">
                <label for="operating_hours" class="block text-sm font-medium text-gray-700">
                    Horário de Funcionamento
                </label>
                <textarea id="operating_hours" name="operating_hours" rows="3"
                          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5
                          focus:ring-[#5b88a5] focus:border-[#5b88a5]">{{ old('operating_hours', $place->operating_hours ?? '') }}</textarea>
            </div>

            {{-- Supervisores --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Supervisores responsáveis
                </label>

                {{-- Dropdown --}}
                <select id="userDropdown"
                        class="block w-full border border-gray-300 rounded-md shadow-sm p-2.5 bg-white
                        focus:ring-[#5b88a5] focus:border-[#5b88a5]">
                    <option value="">Selecione um supervisor...</option>

                    @foreach($supervisores as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }} — {{ $user->email }}
                        </option>
                    @endforeach
                </select>

                {{-- Badges --}}
                <div id="selectedUsersContainer" class="mt-3 flex flex-wrap gap-2"></div>
            </div>

            {{-- Inputs hidden users[] --}}
            <div id="hiddenInputsContainer"></div>

            {{-- Botão --}}
            <div class="mt-8 pt-4 border-t flex justify-end">
                <button type="submit"
                        class="px-6 py-2 bg-[#243A69] text-white font-semibold rounded-md
                        hover:bg-[#1a2c52] transition duration-150">
                    Salvar Alterações
                </button>
            </div>

        </form>
    </div>

    {{-- Script --}}
    <script>
        const dropdown = document.getElementById('userDropdown');
        const badgesContainer = document.getElementById('selectedUsersContainer');
        const hiddenInputs = document.getElementById('hiddenInputsContainer');

        // Se estiver editando, já inicia com os supervisores do lugar
        let selectedUsers = @json($place->users->pluck('id'));


        dropdown.addEventListener('change', function () {
            let id = this.value;
            if (!id) return;

            // impedir duplicação
            if (selectedUsers.includes(id)) {
                this.value = "";
                return;
            }

            selectedUsers.push(id);
            renderUsers();
            this.value = "";
        });

        function removeUser(id) {
            selectedUsers = selectedUsers.filter(u => u != id);
            renderUsers();
        }

        function renderUsers() {
            badgesContainer.innerHTML = "";
            hiddenInputs.innerHTML = "";

            selectedUsers.forEach(id => {
                const option = dropdown.querySelector(`option[value="${id}"]`);
                const text = option ? option.textContent : "Usuário";

                const badge = document.createElement("div");
                badge.className =
                    "flex items-center bg-[#243A69] text-white px-3 py-1 rounded-full text-sm shadow";

                badge.innerHTML =
                    `<span>${text}</span>
                     <button onclick="removeUser('${id}')"
                     class="ml-2 text-white font-bold hover:text-red-300">&times;</button>`;

                badgesContainer.appendChild(badge);

                // input hidden users[]
                const hidden = document.createElement("input");
                hidden.type = "hidden";
                hidden.name = "users[]";
                hidden.value = id;

                hiddenInputs.appendChild(hidden);
            });
        }

        // Renderizar ao carregar (edição)
        renderUsers();
    </script>

</x-admin-layout>
