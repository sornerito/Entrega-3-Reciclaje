<x-guest-layout>
    <x-auth-card>
        <!-- Logo -->
        <x-slot name="logo">
            <img src="{{ asset('img/logo.png') }}" 
                 alt="Logo" 
                 class="mx-auto h-20 w-20 rounded-full border border-gray-200">
        </x-slot>

        <!-- Estado de sesión -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <h2 class="text-center text-2xl font-bold mb-6 text-gray-800">Recuperar contraseña</h2>

        <p class="mb-4 text-sm text-gray-600 text-center">
            ¿Olvidaste tu contraseña? No hay problema. Ingresa tu correo electrónico y te enviaremos un enlace para restablecerla.
        </p>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Correo electrónico -->
            <div>
                <x-input-label for="email" :value="__('Correo electrónico')" />
                <x-text-input id="email" 
                              class="block mt-1 w-full" 
                              type="email" 
                              name="email" 
                              :value="old('email')" 
                              required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Botón -->
            <div class="flex flex-col items-center mt-6 space-y-3">
                <x-primary-button class="w-full justify-center bg-green-700 hover:bg-green-800 focus:ring-green-600">
                    {{ __('Enviar enlace de recuperación') }}
                </x-primary-button>

                <p class="text-sm text-gray-600">
                    ¿Ya recuerdas tu contraseña? 
                    <a href="{{ route('login') }}" class="text-green-700 hover:text-green-900 font-semibold">
                        Inicia sesión
                    </a>
                </p>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
