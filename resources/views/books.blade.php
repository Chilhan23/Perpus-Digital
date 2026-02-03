<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PerpusDigi - Koleksi Buku</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Animasi untuk navbar */
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

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
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

        .animate-fade-in-down {
            animation: fadeInDown 0.8s ease-out;
        }

        /* Animasi fade in dari bawah untuk books */
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

        /* Class untuk artikel yang akan dianimasi */
        .book-item {
            opacity: 0;
            animation: fadeInUp 0.6s ease-out forwards;
        }

        /* Delay bertahap untuk setiap item */
        .book-item:nth-child(1) { animation-delay: 0.1s; }
        .book-item:nth-child(2) { animation-delay: 0.2s; }
        .book-item:nth-child(3) { animation-delay: 0.3s; }
        .book-item:nth-child(4) { animation-delay: 0.4s; }
        .book-item:nth-child(5) { animation-delay: 0.5s; }
        .book-item:nth-child(6) { animation-delay: 0.6s; }
        .book-item:nth-child(7) { animation-delay: 0.7s; }
        .book-item:nth-child(8) { animation-delay: 0.8s; }
        .book-item:nth-child(9) { animation-delay: 0.9s; }

        /* Hover effect untuk card */
        .book-item {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .book-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        /* Alpine.js cloak */
        [x-cloak] { 
            display: none !important; 
        }

        /* Custom Modal Animations */
        @keyframes modalFadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(-20px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .modal-overlay {
            animation: modalFadeIn 0.3s ease-out;
        }

        .modal-content {
            animation: modalSlideIn 0.3s ease-out;
        }

        /* Prevent body scroll when modal is open */
        body.modal-open {
            overflow: hidden;
        }
    </style>
    <script>
        // Auto scroll ke books list saat ada parameter page
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('page')) {
                setTimeout(function() {
                    const booksList = document.getElementById('books-list');
                    if (booksList) {
                        booksList.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }, 100);
            }
        });
    </script>
</head>
<body class="bg-slate-50 font-sans text-slate-900 overflow-x-hidden" x-data="{ 
    mobileMenuOpen: false,
    showBorrowModal: false,
    selectedBook: null,
    borrowForm: null,
    openBorrowModal(bookTitle, form) {
        this.selectedBook = bookTitle;
        this.borrowForm = form;
        this.showBorrowModal = true;
        document.body.classList.add('modal-open');
    },
    closeBorrowModal() {
        this.showBorrowModal = false;
        document.body.classList.remove('modal-open');
    },
    confirmBorrow() {
        if (this.borrowForm) {
            this.borrowForm.submit();
        }
        this.closeBorrowModal();
    }
}">

@include('home.header')    

<!-- Custom Borrow Confirmation Modal -->
<div x-show="showBorrowModal" 
     x-cloak
     @keydown.escape.window="closeBorrowModal()"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none;">
    
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm transition-opacity modal-overlay"
         @click="closeBorrowModal()"></div>
    
    <!-- Modal Content -->
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 modal-content"
             @click.away="closeBorrowModal()">
            
            <!-- Icon -->
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mb-6">
                <svg class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            
            <!-- Title -->
            <h3 class="text-2xl font-bold text-gray-900 text-center mb-3">
                Konfirmasi Peminjaman
            </h3>
            
            <!-- Message -->
            <p class="text-gray-600 text-center mb-2">
                Apakah Anda yakin ingin meminjam buku:
            </p>
            <p class="text-blue-600 font-bold text-center text-lg mb-6" x-text="selectedBook"></p>
            
            <!-- Info Box -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <div class="flex items-start">
                    <svg class="h-5 w-5 text-blue-600 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    <div class="text-sm text-blue-800">
                        <p class="font-semibold mb-1">Perhatian:</p>
                        <ul class="list-disc list-inside space-y-1 text-blue-700">
                            <li>Batas peminjaman 7 Hari</li>
                            <li>Denda keterlambatan berlaku</li>
                            <li>Jaga kondisi buku dengan baik</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Buttons -->
            <div class="flex gap-3">
                <button type="button"
                        @click="closeBorrowModal()"
                        class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Batal
                </button>
                <button type="button"
                        @click="confirmBorrow()"
                        class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-lg hover:shadow-xl transform hover:scale-105">
                    Ya, Pinjam
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Hero Header Section -->
<section class="relative bg-white py-20 overflow-hidden border-b border-gray-200">
    <!-- Background Blobs -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-blue-400/10 rounded-full filter blur-3xl animate-blob"></div>
        <div class="absolute -bottom-40 right-20 w-96 h-96 bg-blue-600/10 rounded-full filter blur-3xl animate-blob" style="animation-delay: 2s;"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 lg:px-6 text-center animate-fade-in-down">
        <!-- Icon -->
        <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-600 rounded-2xl mb-6 shadow-xl">
            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
            </svg>
        </div>

        <!-- Title -->
        <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-4 tracking-tight">
            Jelajahi Koleksi Buku
        </h1>
        
        <!-- Divider -->
        <div class="w-24 h-1 bg-blue-600 mx-auto mb-6 rounded-full"></div>
        
        <!-- Description -->
        <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto mb-8 font-light">
            Ribuan buku menanti untuk ditemukan. Temukan pengetahuan baru, jelajahi cerita inspiratif, dan perluas wawasan Anda.
        </p>

        <!-- Search Form -->
        <div class="max-w-2xl mx-auto mt-12">
            <form>   
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                        <svg class="w-5 h-5 text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input 
                        type="search" 
                        id="search" 
                        class="block w-full p-4 ps-12 bg-white border-2 border-gray-200 text-gray-900 text-base rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-lg placeholder-gray-400 transition-all" 
                        placeholder="Cari berdasarkan judul buku..." 
                        autocomplete="off" 
                        name="keyword" 
                        value="{{ request('keyword') }}" />
                    
                    <button type="submit" class="absolute end-2.5 bottom-2.5 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-bold rounded-xl text-sm px-6 py-2 transition-all hover:scale-105 active:scale-95 shadow-md">
                        Cari Buku
                    </button>
                </div>
            </form>
        </div>
        
        <div class="grid grid-cols-3 gap-6 max-w-2xl mx-auto mt-8">
            <div class="bg-blue-50 rounded-2xl p-6 border border-blue-100 hover:shadow-lg transition-shadow">
                @if ($books->total() > 40)
                    <div class="text-3xl font-bold text-blue-600 mb-2">40++</div>
                    <div class="text-gray-600 text-sm font-medium">Total Buku</div>
                @else
                    <div class="text-3xl font-bold text-blue-600 mb-2">{{ $books->total() }}</div>
                    <div class="text-gray-600 text-sm font-medium">Total Buku</div>
                @endif
            </div>
            <div class="bg-blue-50 rounded-2xl p-6 border border-blue-100 hover:shadow-lg transition-shadow">
                <div class="text-3xl font-bold text-blue-600 mb-2">{{ \App\Models\Category::count() }}</div>
                <div class="text-gray-600 text-sm font-medium">Kategori</div>
            </div>
            <div class="bg-blue-50 rounded-2xl p-6 border border-blue-100 hover:shadow-lg transition-shadow">
                <div class="text-3xl font-bold text-blue-600 mb-2">24/7</div>
                <div class="text-gray-600 text-sm font-medium">Akses Bebas</div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<div class="py-12 px-4 mx-auto max-w-7xl lg:px-6">

    <!-- Pagination Top -->
    <div class="mb-6">
        {{ $books->links() }}
    </div>

    <!-- Books Title - ID untuk scroll target -->
    <div id="books-list">
        @if(request('keyword'))
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                Hasil pencarian untuk: <span class="text-blue-600">"{{ request('keyword') }}"</span>
            </h2>
        @elseif(request('category'))
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                Kategori: <span class="text-blue-600">{{ request('category') }}</span>
            </h2>
        @else
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                Semua Koleksi Buku
            </h2>
        @endif
    </div>
    
    <!-- Books Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($books as $book)
        @php
            // Map warna kategori ke gradient dan warna teks
            $colorMap = [
                'bg-red-100' => [
                    'gradient' => 'from-red-400 to-red-500', 
                    'badge' => 'bg-white/90 text-red-700',
                    'button' => 'bg-red-600 hover:bg-red-700'
                ],
                'bg-green-100' => [
                    'gradient' => 'from-green-400 to-green-500', 
                    'badge' => 'bg-white/90 text-green-700',
                    'button' => 'bg-green-600 hover:bg-green-700'
                ],
                'bg-blue-100' => [
                    'gradient' => 'from-blue-400 to-blue-500', 
                    'badge' => 'bg-white/90 text-blue-700',
                    'button' => 'bg-blue-600 hover:bg-blue-700'
                ],
                'bg-purple-100' => [
                    'gradient' => 'from-purple-400 to-purple-500', 
                    'badge' => 'bg-white/90 text-purple-700',
                    'button' => 'bg-purple-600 hover:bg-purple-700'
                ],
                'bg-yellow-100' => [
                    'gradient' => 'from-yellow-400 to-yellow-500', 
                    'badge' => 'bg-white/90 text-yellow-700',
                    'button' => 'bg-yellow-600 hover:bg-yellow-700'
                ],
            ];
            $categoryColor = $colorMap[$book->category->color] ?? $colorMap['bg-blue-100'];
        @endphp
        
        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-200 group book-item">
            
            <!-- Book Header with Category Badge - Warna Gradient Dinamis -->
            <div class="relative bg-gradient-to-br {{ $categoryColor['gradient'] }} p-6 h-48 flex items-center justify-center">
                <div class="absolute top-4 right-4">
                    <a href="/books?category={{ $book->category->slug }}" class="hover:scale-105 transition-transform inline-block">
                        <span class="px-3 py-1 {{ $categoryColor['badge'] }} text-xs font-bold rounded-full shadow-md">
                            {{ $book->category->name }}
                        </span>
                    </a>
                </div>
                
                <!-- Status Badge jika sedang dipinjam -->
                @auth
                    @if(Auth::user()->hasBorrowed($book->id))
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-yellow-400 text-yellow-900 text-xs font-bold rounded-full">
                            📖 Sedang Dipinjam
                        </span>
                    </div>
                    @elseif($book->isBorrowed())
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-red-400 text-red-900 text-xs font-bold rounded-full">
                            ⚠️ Tidak Tersedia
                        </span>
                    </div>
                    @endif
                @endauth
                
                <!-- Icon Buku Putih -->
                <svg class="w-20 h-20 text-white opacity-90 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
                </svg>
            </div>
            
            <!-- Book Info -->
            <div class="p-6">
                <h3 class="font-bold text-xl text-slate-800 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
                    {{ $book->judul }}
                </h3>
                <p class="text-slate-600 text-sm mb-1">
                    <span class="font-semibold">Penulis:</span> {{ $book->penulis }}
                </p>
                <p class="text-slate-500 text-sm mb-4">
                    <span class="font-semibold">Tahun:</span> {{ $book->tahun_terbit }}
                </p>
                
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-xs bg-slate-100 text-slate-600 px-3 py-1 rounded-full font-medium">
                        Kode: {{ $book->code }}
                    </span>
                </div>

                <!-- Deskripsi -->
                @if($book->body)
                <p class="text-slate-600 text-sm mb-4 line-clamp-3">
                    {{ Str::limit(strip_tags($book->body), 100) }}
                </p>
                @endif
                
                <!-- Action Buttons -->
                <div class="flex gap-2">
                    <!-- Tombol Detail -->
                    <a href="/books/{{ $book['code'] }}" class="flex-1 px-4 py-2 bg-slate-100 text-slate-700 text-center rounded-lg hover:bg-slate-200 transition-colors font-semibold text-sm">
                        Detail
                    </a>
                    
                    @auth
                        @if(Auth::user()->hasBorrowed($book->id))
                            <button disabled class="flex-1 px-4 py-2 bg-yellow-100 text-yellow-700 text-center rounded-lg font-semibold text-sm cursor-not-allowed">
                                Sedang Dipinjam
                            </button>
                        @elseif($book->isBorrowed())
                            <button disabled class="flex-1 px-4 py-2 bg-red-100 text-red-700 text-center rounded-lg font-semibold text-sm cursor-not-allowed">
                                Tidak Tersedia
                            </button>
                        @elseif(auth()->user()->is_admin)
                            <button disabled class="flex-1 px-4 py-2 bg-gray-300 text-gray-600 text-center rounded-lg cursor-not-allowed text-sm font-semibold">
                                Admin tidak bisa meminjam
                            </button>
                        @else
                            <form action="{{ route('borrows.store', $book) }}" method="POST" class="flex-1" id="borrow-form-{{ $book->id }}">
                                @csrf
                                <button type="button"
                                        @click="openBorrowModal('{{ addslashes($book->judul) }}', document.getElementById('borrow-form-{{ $book->id }}'))"
                                        class="w-full px-4 py-2 {{ $categoryColor['button'] }} text-white rounded-lg transition-colors font-semibold text-sm">
                                    Pinjam
                                </button>
                            </form>
                        @endif
                    @else
                        <!-- Belum login -->
                        <a href="{{ route('login') }}" class="flex-1 px-4 py-2 {{ $categoryColor['button'] }} text-white text-center rounded-lg transition-colors font-semibold text-sm">
                            Login untuk Pinjam
                        </a>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
     
</body>
</html>