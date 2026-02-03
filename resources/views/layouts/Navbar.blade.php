@auth
<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white border-b border-slate-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex">
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
                    <button @click="open = !open" class="inline-flex items-center px-4 py-2 border rounded-lg text-sm">
                        {{ auth()->user()->name }}
                        <svg class="ms-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5.293 7.293L10 12l4.707-4.707"/>
                        </svg>
                    </button>

                    <div x-show="open" x-cloak class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow">
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
                <button @click="open = !open" class="p-2 rounded-md">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-cloak class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Beranda') }}
            </x-responsive-nav-link>

            @if(auth()->user()->is_admin)
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('dashboard')">
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
                <x-responsive-nav-link 
                    :href="route('borrows.index')" 
                    :active="request()->routeIs('borrows.*')">
                    {{ __('Peminjaman Saya') }}
                </x-responsive-nav-link>
            @endif
        </div>
    </div>
</nav>
@endauth
