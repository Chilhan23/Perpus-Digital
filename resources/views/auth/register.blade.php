<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - {{ config('app.name', 'Laravel') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script>
    tailwind.config = {
        theme: {
            extend: {
                animation: {
                    'slide-down': 'slideDown 0.5s ease-out forwards',
                    'blob': 'blob 8s infinite ease-in-out',
                    'fade-in-down': 'fadeInDown 1s ease-out',
                    'fade-in-up': 'fadeInUp 1s ease-out',
                },
                keyframes: {
                    slideDown: {
                        '0%': { transform: 'translateY(-100%)', opacity: '0' },
                        '100%': { transform: 'translateY(0)', opacity: '1' },
                    },
                    blob: {
                        '0%, 100%': { transform: 'translate(0px, 0px) scale(1)' },
                        '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                        '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                    },
                    fadeInDown: {
                        'from': { opacity: '0', transform: 'translateY(-30px)' },
                        'to': { opacity: '1', transform: 'translateY(0)' },
                    },
                    fadeInUp: {
                        'from': { opacity: '0', transform: 'translateY(30px)' },
                        'to': { opacity: '1', transform: 'translateY(0)' },
                    }
                }
            }
        }
    }
    </script>
    
    <style>
        @keyframes blob {
            0%, 100% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-blob { animation: blob 8s infinite ease-in-out; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
        .animation-delay-1000 { animation-delay: 1s; }
        .animation-delay-3000 { animation-delay: 3s; }
        .animate-fade-in-down { animation: fadeInDown 1s ease-out; }
        .animate-fade-in-up { animation: fadeInUp 1s ease-out; }
        
        [x-cloak] { display: none !important; }
    </style>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50" x-data="{ mobileMenuOpen: false }">
    
    <!-- Background Gradient -->
    <div class="fixed inset-0 bg-gradient-to-br from-blue-400 via-blue-500 to-blue-600 -z-10"></div>
    
    <!-- Blob Animations -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-white/10 rounded-full mix-blend-overlay filter blur-3xl animate-blob"></div>
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-white/10 rounded-full mix-blend-overlay filter blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-40 left-20 w-96 h-96 bg-white/10 rounded-full mix-blend-overlay filter blur-3xl animate-blob animation-delay-4000"></div>
    </div>

    <!-- Include Navbar dari home.header -->
    @include('layouts.Navbar')

    <!-- Main Content -->
    <div class="min-h-[calc(100vh-80px)] flex relative z-10 py-12">
        
        <!-- Left Side - Hero Section -->
        <div class="hidden lg:flex lg:w-1/2 items-center justify-center p-12 relative">
            <div class="max-w-lg text-white text-center">
                <div class="mb-8 animate-fade-in-down flex justify-center">
                    <div class="w-32 h-32 bg-white/10 backdrop-blur-md rounded-full flex items-center justify-center shadow-2xl border-4 border-white/20 transform hover:scale-110 hover:rotate-6 transition-all duration-500">
                        <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
                        </svg>
                    </div>
                </div>
                
                <div class="animate-fade-in-up">
                    <h1 class="text-5xl font-bold mb-4 drop-shadow-2xl tracking-tight">
                        Bergabunglah Dengan Kami
                    </h1>
                    <div class="h-1 w-24 bg-white/50 mx-auto mb-6 rounded-full"></div>
                    <p class="text-2xl mb-4 font-light">
                        Akses Ribuan Koleksi Buku
                    </p>
                    <p class="text-base opacity-90 leading-relaxed max-w-md mx-auto">
                        Daftar sekarang dan nikmati akses penuh ke perpustakaan digital dengan ribuan koleksi buku
                    </p>
                </div>

                <div class="absolute top-20 left-20 w-24 h-24 border-4 border-white/30 rounded-full animate-pulse"></div>
                <div class="absolute bottom-20 right-20 w-32 h-32 border-4 border-white/20 rounded-full animate-pulse animation-delay-1000"></div>
                <div class="absolute top-1/2 right-10 w-16 h-16 border-4 border-white/25 rounded-full animate-pulse animation-delay-3000"></div>
            </div>
        </div>

        <!-- Right Side - Register Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 lg:p-12">
            <div class="w-full max-w-md">
                
                <!-- Mobile Logo & Title -->
                <div class="lg:hidden text-center mb-8 animate-fade-in-down">
                    <div class="flex justify-center mb-6">
                        <div class="w-24 h-24 bg-white/10 backdrop-blur-md rounded-full flex items-center justify-center shadow-2xl border-4 border-white/20">
                            <svg class="w-14 h-14 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-2">Perpustakaan Digital</h2>
                    <p class="text-white/80">Daftar akun baru</p>
                </div>

                <!-- Register Card -->
                <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl p-8 lg:p-10 animate-fade-in-up border border-white/50">
                    
                    <!-- Welcome Text -->
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">
                            Buat Akun Baru
                        </h2>
                        <p class="text-gray-600">
                            Lengkapi data di bawah untuk mendaftar
                        </p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <!-- Name -->
                        <div class="group">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Lengkap
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-blue-500 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input 
                                    id="name" 
                                    type="text" 
                                    name="name" 
                                    value="{{ old('name') }}"
                                    class="block w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-400 group-hover:border-blue-300" 
                                    placeholder="Masukkan nama lengkap"
                                    required 
                                    autofocus 
                                    autocomplete="name">
                            </div>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div class="group">
                            <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">
                                Username
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-blue-500 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                    </svg>
                                </div>
                                <input 
                                    id="username" 
                                    type="text" 
                                    name="username" 
                                    value="{{ old('username') }}"
                                    class="block w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-400 group-hover:border-blue-300" 
                                    placeholder="Pilih username unik"
                                    required 
                                    autocomplete="username">
                            </div>
                            @error('username')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="group">
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-blue-500 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input 
                                    id="email" 
                                    type="email" 
                                    name="email" 
                                    value="{{ old('email') }}"
                                    class="block w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-400 group-hover:border-blue-300" 
                                    placeholder="nama@email.com"
                                    required 
                                    autocomplete="email">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="group">
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-blue-500 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input 
                                    id="password" 
                                    type="password" 
                                    name="password" 
                                    class="block w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-400 group-hover:border-blue-300" 
                                    placeholder="Minimal 8 karakter"
                                    required 
                                    autocomplete="new-password">
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="group">
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                Konfirmasi Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-blue-500 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input 
                                    id="password_confirmation" 
                                    type="password" 
                                    name="password_confirmation" 
                                    class="block w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-400 group-hover:border-blue-300" 
                                    placeholder="Ulangi password"
                                    required 
                                    autocomplete="new-password">
                            </div>
                            @error('password_confirmation')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Register Button -->
                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-4 px-6 rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/50 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-xl active:scale-[0.98] shadow-lg mt-6">
                            <span class="flex items-center justify-center text-base">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                                Daftar Sekarang
                            </span>
                        </button>

                        <!-- Login Link -->
                        <div class="text-center pt-6 border-t border-gray-200">
                            <p class="text-sm text-gray-600">
                                Sudah punya akun?
                                <a class="text-blue-600 hover:text-blue-800 font-semibold transition-colors hover:underline ml-1" href="{{ route('login') }}">
                                    Login sekarang
                                </a>
                            </p>
                        </div>
                    </form>     
                </div>

                <p class="text-center text-white/70 text-xs mt-6">
                    © {{ date('Y') }} Perpustakaan Digital. Akses Pengetahuan Tanpa Batas
                </p>
            </div>
        </div>
    </div>
</body>
</html>