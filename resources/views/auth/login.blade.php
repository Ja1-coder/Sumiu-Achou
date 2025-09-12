<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form class="w-full md:w-1/2" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="flex justify-center mt-6">
            <img src="{{ asset('images/Logo_dark.png') }}" 
                alt="Logo" 
                class="md:hidden w-60 mb-10"> 
        </div>

        <div class="flex flex-col w-full gap-6">
            <a href="{{ route('user-option') }}">
                <svg class="text-[#F4F4F2] hover:bg-[#F4F4F2] hover:text-[#2C3E50] border border-[#5B88A5] h-8 w-8 rounded-full" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-big-left-icon lucide-arrow-big-left"><path d="M13 9a1 1 0 0 1-1-1V5.061a1 1 0 0 0-1.811-.75l-6.835 6.836a1.207 1.207 0 0 0 0 1.707l6.835 6.835a1 1 0 0 0 1.811-.75V16a1 1 0 0 1 1-1h6a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1z"/></svg>
            </a>
        </div>
        
        <div class="flex flex-col items-center justify-center mb-6 mt-6">
            <h1 class="text-3xl font-bold text-[#F4F4F2]">Entrar</h1>
        </div>
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Lembre-me e Esqueci minha senha -->
        <div class="block flex flex-row gap-4 mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-[#F4F4F2]">{{ __('Lembre-me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-[#F4F4F2] hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Esqueceu sua senha?') }}
                </a>
            @endif
        </div>

        <div class="flex flex-col items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Entrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
