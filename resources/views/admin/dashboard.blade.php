<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PerpusDigi</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50">

    @include('layouts.Navbar')

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 lg:px-6 py-8">
        
        <!-- Welcome Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-800 mb-2">Dashboard</h1>
            <p class="text-slate-600">Selamat datang, {{ Auth::user()->name }}!</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            
            <!-- Total Buku -->
            <div class="bg-white rounded-lg shadow-md p-6 border border-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-600 text-sm font-medium mb-1">Total Buku</p>
                        <h3 class="text-3xl font-bold text-slate-800">{{ \App\Models\Books::distinct()->count('judul') }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Kategori -->
            <div class="bg-white rounded-lg shadow-md p-6 border border-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-600 text-sm font-medium mb-1">Total Kategori</p>
                        <h3 class="text-3xl font-bold text-slate-800">{{ \App\Models\Category::distinct()->count('name') }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z"/>
                        </svg>
                    </div>
                </div>
            </div>
            

            <!-- Total Peminjaman -->
            <div class="bg-white rounded-lg shadow-md p-6 border border-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-600 text-sm font-medium mb-1">Total Peminjaman</p>
                        <h3 class="text-3xl font-bold text-slate-800">{{ \App\Models\Borrow::count()}}</h3>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        
       
        

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-md p-6 border border-slate-200">
            <h2 class="text-xl font-bold text-slate-800 mb-4">Menu Cepat</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                
                <a href="{{ route('buku.index') }}" class="flex items-center gap-4 p-4 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors group">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-800">Kelola Buku</h3>
                        <p class="text-sm text-slate-600">Tambah & edit buku</p>
                    </div>
                </a>

                <a href="{{ route('home') }}" class="flex items-center gap-4 p-4 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors group">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors">
                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-800">Beranda</h3>
                        <p class="text-sm text-slate-600">Lihat koleksi buku</p>
                    </div>
                </a>

                <a href="{{ route('profile.edit') }}" class="flex items-center gap-4 p-4 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors group">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                        <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-800">Profile</h3>
                        <p class="text-sm text-slate-600">Edit profile Anda</p>
                    </div>
                </a>
                 <a href="/admin/borrows"class="flex items-center gap-4 p-4 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors group">
                    
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                        <svg class="w-5 h-5 text-orange-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7 18c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2h10v2H7v10h10v2H7z"/>
                            <path d="M17 10l4-4-4-4v3h-6v2h6v3z"/>
                        </svg>
                    </div>

                    <div>
                        <h3 class="font-semibold text-slate-800">Peminjaman</h3>
                        <p class="text-sm text-slate-600">Kelola data pinjam</p>
                    </div>
                </a>

            </div>
        </div>

    </div>

</body>
</html>