<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md border-b border-gray-200 sticky top-0 z-50 shadow-sm">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20"> <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('add-product') }}" class="transition-transform duration-300 hover:scale-105">
                        <x-application-logo class="block h-10 w-auto fill-current text-indigo-600" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('add-product')" :active="request()->routeIs('add-product')"
                        class="text-sm font-semibold tracking-wide transition-all duration-200 hover:text-indigo-600 border-b-2">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            {{ __('Panel de Productos') }}
                        </span>
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="56"> <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 border border-gray-200 text-sm leading-4 font-bold rounded-full text-gray-600 bg-gray-50 hover:bg-indigo-50 hover:text-indigo-700 hover:border-indigo-200 focus:outline-none transition-all duration-200 shadow-sm">
                                <div class="h-6 w-6 rounded-full bg-indigo-600 text-white flex items-center justify-center text-[10px] me-2">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>

                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-2">
                                    <svg class="fill-current h-4 w-4 transition-transform duration-200" :class="{'rotate-180': open}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-400 font-bold uppercase tracking-widest border-b border-gray-100 mb-1">
                                Mi Cuenta
                            </div>

                            <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2 hover:bg-indigo-50">
                                👤 {{ __('Perfil') }}
                            </x-dropdown-link>

                            <div class="border-t border-gray-100 my-1"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        class="text-red-600 hover:bg-red-50 flex items-center gap-2"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-500 bg-gray-100 hover:text-indigo-600 hover:bg-indigo-50 focus:outline-none transition duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('add-product')" :active="request()->routeIs('add-product')"
                class="rounded-xl font-bold">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 bg-gray-50">
            <div class="px-6 flex items-center gap-3">
                <div class="h-10 w-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-bold text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-4 pb-4">
                <x-responsive-nav-link :href="route('profile.edit')" class="rounded-xl">
                    {{ __('Configuración Perfil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            class="text-red-600 font-bold rounded-xl"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Cerrar Sesión') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
