
    <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10">
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-blue-400/20 rounded-full filter blur-3xl animate-blob"></div>
        <div class="absolute -bottom-40 left-20 w-96 h-96 bg-blue-600/10 rounded-full filter blur-3xl animate-blob"></div>
    </div>

    <header class="sticky top-0 z-50 bg-white/70 backdrop-blur-xl border-b border-white/50 px-6 py-4 shadow-sm animate-slide-down">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg transform hover:rotate-12 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
                    </svg>
                </div>
                <span class="text-2xl font-bold tracking-tight text-slate-800">Perpus<span class="text-blue-600">Digi</span></span>
            </div>
            
            <nav class="hidden md:flex items-center gap-8 font-medium">
                <a href="{{ Route::is('home') ? url('/') . '#home' : url('/') }}" class="hover:text-blue-600 transition-colors">Beranda</a>                
                {{-- <a href="{{ url('/') }}#tentang" class="hover:text-blue-600 transition-colors">Tentang Kami</a>
                <a href="{{ url('/') }}#koleksi" class="hover:text-blue-600 transition-colors">Koleksi</a> --}}
                <a href="{{ route('books') }}" class="hover:text-blue-600 transition-colors">Lihat Buku</a>
                
                @if (Route::has('login'))
                    <div class="flex items-center gap-4 border-l pl-8 border-slate-200">
                        @auth
                            <div x-data="{ open: false }" class="relative" @click.away="open = false">
                                <button @click="open = !open" class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2.5 rounded-xl hover:bg-blue-700 transition-all shadow-md group font-bold">
                                    <span>{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <div x-show="open" x-cloak x-transition class="absolute right-0 mt-3 w-52 bg-white rounded-2xl shadow-2xl border border-slate-100 py-2 z-[60]">
                                    <a href="{{ url('/dashboard') }}" class="flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-blue-50 font-semibold">Dashboard</a>
                                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-blue-50 font-semibold">Update Profile</a>
                                    <hr class="my-2 border-slate-100">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 font-bold hover:bg-red-50">Keluar</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-slate-600 hover:text-blue-600 font-semibold">Login</a>
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-2.5 rounded-xl hover:bg-blue-700 shadow-lg font-bold">Daftar</a>
                        @endauth
                    </div>
                @endif
            </nav>

            <div class="md:hidden flex items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-xl bg-slate-100 text-slate-600 focus:outline-none">
                    <svg class="w-6 h-6" x-show="!mobileMenuOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    <svg class="w-6 h-6" x-show="mobileMenuOpen" x-cloak fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>

        <div x-show="mobileMenuOpen" x-cloak x-transition class="md:hidden mt-4 pb-4 space-y-4">
            <a href="/" class="block text-slate-600 font-bold py-2 border-b border-slate-50">Beranda</a>
            <a href="#tentang" class="block text-slate-600 font-bold py-2 border-b border-slate-50">Tentang Kami</a>
            <a href="#koleksi" class="block text-slate-600 font-bold py-2 border-b border-slate-50">Koleksi</a>
            <a href="{{ route('books') }}" class="block text-slate-600 font-bold py-2 border-b b/order-slate-50">Lihat Buku</a>
            
            @auth
                <div class="bg-blue-50 p-4 rounded-2xl space-y-3">
                    <a href="{{ url('/dashboard') }}" class="block text-blue-600 font-bold">Dashboard</a>
                    <a href="{{ route('profile.edit') }}" class="block text-blue-600 font-bold">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">@csrf
                        <button type="submit" class="text-red-600 font-bold">Kelua  r</button>
                    </form> 
                </div>
            @else
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('login') }}" class="text-center py-3 rounded-xl font-bold text-slate-600 bg-slate-100">Login</a>
                    <a href="{{ route('register') }}" class="text-center py-3 rounded-xl font-bold text-white bg-blue-600 shadow-md">Daftar</a>
                </div>
            @endauth
        </div>
    </header>