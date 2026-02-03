<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verifikasi Email - {{ config('app.name', 'Laravel') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased overflow-x-hidden overflow-y-auto">

    <div class="fixed inset-0 bg-gradient-to-br from-blue-400 via-blue-500 to-blue-600 -z-10"></div>

    <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10">
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-white/10 rounded-full mix-blend-overlay filter blur-3xl animate-blob"></div>
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-white/10 rounded-full mix-blend-overlay filter blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-40 left-20 w-96 h-96 bg-white/10 rounded-full mix-blend-overlay filter blur-3xl animate-blob animation-delay-4000"></div>
    </div>

    <div class="min-h-screen w-full flex flex-col items-center justify-center p-6 relative z-10">
        
        <div class="w-full max-w-md">
            
            <div class="flex flex-col items-center text-center mb-8 animate-fade-in-down">
                <div class="w-20 h-20 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center shadow-2xl border-4 border-white/20 mb-4 transition-transform duration-500 hover:scale-110">
                    <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-extrabold text-white tracking-tight">Verifikasi Email</h2>
                <p class="text-white/70 font-medium">Perpus<span class="text-blue-200">Digi</span></p>
            </div>

            <div class="bg-white/95 backdrop-blur-xl rounded-[2.5rem] shadow-2xl p-8 lg:p-10 animate-fade-in-up border border-white/50 relative overflow-hidden">
                
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-500/5 rounded-full"></div>

                <div class="flex justify-center mb-8">
                    <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center relative">
                        <div class="absolute inset-0 bg-blue-400/20 blur-xl rounded-full animate-pulse"></div>
                        <svg class="w-10 h-10 text-blue-600 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>

                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-slate-800 mb-3">
                        Cek Email Kamu!
                    </h3>
                    <p class="text-slate-500 text-sm leading-relaxed px-2">
                        Klik link verifikasi yang baru saja kami kirim ke emailmu untuk mulai menjelajahi ribuan koleksi buku digital.
                    </p>
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-8 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-2xl animate-fade-in">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-emerald-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-xs font-bold text-emerald-800">
                                Link baru sudah terkirim!
                            </p>
                        </div>
                    </div>
                @endif

                <div class="flex flex-col gap-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button 
                            type="submit" 
                            class="w-full bg-blue-600 text-white font-bold py-4 px-6 rounded-2xl hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/50 transform transition-all duration-300 hover:scale-[1.02] shadow-lg active:scale-[0.98]">
                            <span class="flex items-center justify-center text-sm">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Kirim Ulang Email
                            </span>
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button 
                            type="submit" 
                            class="w-full py-4 text-sm font-bold text-slate-500 hover:text-red-600 transition-colors duration-300 flex items-center justify-center gap-2 border-2 border-slate-100 rounded-2xl hover:bg-red-50 hover:border-red-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Keluar Sementara
                        </button>
                    </form>
                </div>
            </div>

            <p class="text-center text-white/60 text-[10px] font-bold tracking-widest uppercase mt-8">
                © {{ date('Y') }} PerpusDigi Banda Aceh
            </p>
        </div>
    </div>

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
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-blob { animation: blob 8s infinite ease-in-out; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
        .animate-fade-in-down { animation: fadeInDown 1s ease-out forwards; }
        .animate-fade-in-up { animation: fadeInUp 1s ease-out forwards; }
        .animate-fade-in { animation: fadeIn 0.5s ease-out; }
    </style>
</body>
</html>