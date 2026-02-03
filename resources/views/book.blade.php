<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $book->judul }} - PerpusDigi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @keyframes slide-down {
            from {
                opacity: 0;
                transform: translateY(-100%);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes blob {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-down {
            animation: slide-down 0.6s ease-out;
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }

        [x-cloak] { 
            display: none !important; 
        }

        /* Content styling */
        .book-content {
            line-height: 1.8;
            font-size: 1.125rem;
        }

        .book-content p {
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body class="bg-slate-50 font-sans text-slate-900 overflow-x-hidden" x-data="{ mobileMenuOpen: false }">

@include('home.header')

<div class="bg-white border-b border-gray-100/80">
    <div class="max-w-7xl mx-auto px-4 lg:px-6 py-4">
        <nav class="flex items-center" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-3 text-sm font-medium">
                <li class="flex items-center">
                    <a href="/" class="flex items-center text-gray-500 hover:text-blue-600 transition-all duration-200 group">
                        <div class="p-1.5 bg-slate-50 rounded-lg group-hover:bg-blue-50 transition-colors mr-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                        </div>
                        <span class="pt-0.5">Beranda</span>
                    </a>
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="/books" class="ml-2 pt-0.5 text-gray-500 hover:text-blue-600 transition-all">Koleksi Buku</a>
                </li>

                <li class="flex items-center" aria-current="page">
                    <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-2 pt-0.5 text-blue-600 font-bold truncate max-w-[200px] md:max-w-xs">
                        {{ $book->judul }}
                    </span>
                </li>
            </ol>
        </nav>
    </div>
</div>
<main class="py-12 bg-slate-50">
    <div class="max-w-4xl mx-auto px-4 lg:px-6">
        
        <!-- Article Card -->
        <article class="bg-white rounded-3xl shadow-xl overflow-hidden animate-fade-in-up border border-gray-100">
            
            <!-- Header Section -->
            <header class="p-8 lg:p-12 border-b border-gray-100 bg-gradient-to-br from-blue-50 to-white">
                
                <!-- Category & Date -->
                <div class="flex items-center justify-between mb-6">
                    <a href="/books?category={{ $book->Category->slug }}" class="inline-flex items-center">
                        <span class="{{ $book->Category->color }} text-sm font-semibold px-4 py-2 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                            {{ $book->Category->name }}
                        </span>
                    </a>
                    <div class="flex items-center text-gray-500 text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <time datetime="{{ $book->created_at->format('Y-m-d') }}">
                            {{ $book->created_at->format('d F Y') }}
                        </time>
                    </div>
                </div>

                <!-- Title -->
                <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                    {{ $book->judul }}
                </h1>

                <!-- Author Info -->
                <div class="flex items-center">
                    <img class="w-14 h-14 rounded-full border-2 border-white shadow-lg" 
                         src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" 
                         alt="{{ $book->penulis }}">
                    <div class="ml-4">
                        <p class="text-lg font-semibold text-gray-900">{{ $book->penulis }}</p>
                        <p class="text-sm text-gray-600">
                            <span class="font-medium">Penulis</span> • 
                            <time class="text-gray-500">{{ $book->created_at->diffForHumans() }}</time>
                        </p>
                    </div>
                </div>
            </header>

            <!-- Book Content -->
            <div class="p-8 lg:p-12">
                <div class="book-content text-gray-700 leading-relaxed">
                    {!! nl2br(e($book->body)) !!}
                </div>
            </div>

            <!-- Footer Section -->
            <footer class="p-8 lg:p-12 border-t border-gray-100 bg-gray-50">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <!-- Back Button -->
                    <a href="/books" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors group">
                        <svg class="w-5 h-5 mr-2 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Koleksi Buku
                    </a>

                    <!-- Share Section -->
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-gray-600 font-medium">Bagikan:</span>
                        <div class="flex gap-2">
                            <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full bg-sky-100 text-sky-600 hover:bg-sky-600 hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full bg-green-100 text-green-600 hover:bg-green-600 hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </article>

        <!-- Related Books Section (Optional) -->
        <section class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Buku Lainnya</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @php
                    $relatedBooks = \App\Models\Books::where('category_id', $book->category_id)
                        ->where('id', '!=', $book->id)
                        ->limit(5)
                        ->get();
                @endphp

                @foreach($relatedBooks as $related)
                <a href="/books/{{ $related->code }}" class="group">
                    <article class="bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100 hover:-translate-y-1">
                        <div class="flex items-center justify-between mb-3">
                            <span class="{{ $related->Category->color }} text-xs font-medium px-3 py-1 rounded-lg">
                                {{ $related->Category->name }}
                            </span>
                            <span class="text-xs text-gray-500">{{ $related->created_at->diffForHumans() }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors line-clamp-2">
                            {{ $related->judul }}
                        </h3>
                        <p class="text-sm text-gray-600 line-clamp-2 mb-3">
                            {{ Str::limit($related->body, 80) }}
                        </p>
                        <div class="flex items-center text-sm">
                            <img class="w-6 h-6 rounded-full mr-2" 
                                 src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" 
                                 alt="{{ $related->penulis }}">
                            <span class="text-gray-700 font-medium">{{ $related->penulis }}</span>
                        </div>
                    </article>
                </a>
                @endforeach
            </div>
        </section>
    </div>
</main>

</body>
</html>