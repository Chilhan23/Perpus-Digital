@if (Route::has('login'))
    @auth
    <nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo & Menu -->
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-md group-hover:shadow-lg transition-all">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V4a2 2 0 00-2-2z"/>
                                </svg>
                            </div>
                            <span class="text-2xl font-bold text-slate-800">
                                Perpus<span class="text-blue-600">Digi</span>
                            </span>
                        </a>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                            {{ __('Beranda') }}
                        </x-nav-link>

                        @if(auth()->user()->is_admin)
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                Dashboard
                            </x-nav-link>

                            <x-nav-link :href="route('buku.index')" :active="request()->routeIs('buku.*')">
                                {{ __('Kelola Buku') }}
                            </x-nav-link>

                            <x-nav-link 
                                :href="route('admin.borrows.index')" 
                                :active="request()->routeIs('admin.borrows.*')">
                                {{ __('Kelola Peminjaman') }}
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('books')" :active="request()->routeIs('books')">
                                {{ __('Lihat Buku') }}
                            </x-nav-link>

                            <x-nav-link 
                                :href="route('borrows.index')" 
                                :active="request()->routeIs('borrows.*')">
                                {{ __('Peminjaman Saya') }}
                            </x-nav-link>
                        @endif
                    </div>
                </div>

                <!-- User Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none transition-all">
                            {{ auth()->user()->name }}
                            <svg class="ms-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>

                        <div x-show="open" x-cloak class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Logout') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Mobile Button -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = !open" class="p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-cloak class="sm:hidden border-t border-gray-200">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    {{ __('Beranda') }}
                </x-responsive-nav-link>

                @if(auth()->user()->is_admin)
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('buku.index')" :active="request()->routeIs('buku.*')">
                        {{ __('Kelola Buku') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link 
                        :href="route('admin.borrows.index')" 
                        :active="request()->routeIs('admin.borrows.*')">
                        {{ __('Kelola Peminjaman') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('books')" :active="request()->routeIs('books')">
                        {{ __('Lihat Buku') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link 
                        :href="route('borrows.index')" 
                        :active="request()->routeIs('borrows.*')">
                        {{ __('Peminjaman Saya') }}
                    </x-responsive-nav-link>
                @endif
            </div>

            <!-- Mobile User Menu -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ auth()->user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Logout') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    @else
        <!-- Navigation untuk Guest (belum login) - KONSISTEN DENGAN YANG SUDAH LOGIN -->
        <nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white border-b border-slate-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo & Menu - SAMA SEPERTI YANG SUDAH LOGIN -->
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-md group-hover:shadow-lg transition-all">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V4a2 2 0 00-2-2z"/>
                                    </svg>
                                </div>
                                <span class="text-2xl font-bold text-slate-800">
                                    Perpus<span class="text-blue-600">Digi</span>
                                </span>
                            </a>
                        </div>

                        <!-- Desktop Navigation - DI SEBELAH LOGO -->
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <a href="{{ route('home') }}" 
                               class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors
                                      {{ request()->routeIs('home') 
                                          ? 'border-blue-600 text-gray-900' 
                                          : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                Beranda
                            </a>
                            <a href="{{ route('books') }}" 
                               class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors
                                      {{ request()->routeIs('books') 
                                          ? 'border-blue-600 text-gray-900' 
                                          : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                Lihat Buku
                            </a>
                        </div>
                    </div>

                    <!-- Login & Register - DI KANAN -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                        <a href="{{ route('login') }}" 
                           class="text-gray-500 hover:text-gray-700 font-medium text-sm transition-colors">
                            Login
                        </a>
                        <a href="{{ route('register') }}" 
                           class="bg-blue-600 text-white px-6 py-2.5 rounded-xl hover:bg-blue-700 shadow-md hover:shadow-lg font-bold text-sm transition-all">
                            Daftar
                        </a>
                    </div>

                    <!-- Mobile Button -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="open = !open" class="p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div x-show="open" x-cloak class="sm:hidden border-t border-gray-200">
                    <div class="pt-2 pb-3 space-y-1">
                        <a href="{{ route('home') }}" 
                           class="block ps-3 pe-4 py-2 border-l-4 text-base font-medium transition-colors
                                  {{ request()->routeIs('home') 
                                      ? 'border-blue-600 text-blue-700 bg-blue-50' 
                                      : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }}">
                            Beranda
                        </a>
                        <a href="{{ route('books') }}" 
                           class="block ps-3 pe-4 py-2 border-l-4 text-base font-medium transition-colors
                                  {{ request()->routeIs('books') 
                                      ? 'border-blue-600 text-blue-700 bg-blue-50' 
                                      : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }}">
                            Lihat Buku
                        </a>
                    </div>
                    <div class="pt-4 pb-3 border-t border-gray-200 space-y-2 px-4">
                        <a href="{{ route('login') }}" 
                           class="block w-full text-center px-4 py-2 text-gray-600 hover:text-gray-800 font-medium border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            Login
                        </a>
                        <a href="{{ route('register') }}" 
                           class="block w-full text-center bg-blue-600 text-white px-4 py-2.5 rounded-xl hover:bg-blue-700 font-bold shadow-md transition-all">
                            Daftar
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    @endauth
@endif