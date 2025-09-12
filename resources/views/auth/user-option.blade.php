<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="flex flex-col items-center">
        <!-- Logo no topo -->
        <div class="flex justify-center mt-6">
            <img src="{{ asset('images/Logo_dark.png') }}" 
                alt="Logo" 
                class="md:hidden w-60 mb-10"> 
        </div>

        <h2 class="text-[#2C3E50] font-bold text-2xl family-poppins mt-24 mb-12 text-center md:text-4xl">
            Escolha seu perfil de acesso
        </h2>
        <div class="flex items-center flex-col w-full py-10 gap-6">
            <x-link-button href="{{ route('home') }}" class="ms-3">
                Visitante
            </x-link-button>
            <x-link-button href="{{ route('login') }}" class="ms-3">
                Administrador
            </x-link-button>
        </div>
    </div>
</x-guest-layout>
