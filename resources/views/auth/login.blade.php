<x-guest-layout>
    <x-slot name="logo">
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current text-indigo-600" />
        </a>
    </x-slot>

    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-800">Bienvenido de nuevo</h2>
        <p class="text-sm text-gray-600">StockMaster Pro - Control de Inventario</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" class="block mt-1 w-full shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-indigo-600 transition-colors" href="{{ route('password.request') }}">
                    {{ __('¿Olvidaste tu clave?') }}
                </a>
            @endif
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-3 text-sm font-bold tracking-widest uppercase transition duration-150">
                {{ __('Entrar al Sistema') }}
            </x-primary-button>
        </div>

        <div class="mt-6 text-center border-t border-gray-100 pt-4">
            <p class="text-xs text-gray-500 uppercase tracking-widest">Acceso Restringido</p>
        </div>
    </form>
</x-guest-layout>
