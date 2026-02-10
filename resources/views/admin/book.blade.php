<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Buku - PerpusDigi</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50 font-sans" x-data="{
    showModal: false,
    editMode: false,
    editId: null,
    formData: {
        judul: '',
        code: '',
        penulis: '',
        category_id: '',
        tahun_terbit: '',
        body: ''
    },
    
    openAddModal() {
        this.editMode = false;
        this.editId = null;
        this.formData = {
            judul: '',
            code: '',
            penulis: '',
            category_id: '',
            tahun_terbit: '',
            body: ''
        };
        this.showModal = true;
    },
    
    openEditModal(book) {
        this.editMode = true;
        this.editId = book.id;
        this.formData = {
            judul: book.judul,
            code: book.code,
            penulis: book.penulis,
            category_id: book.category_id,
            tahun_terbit: book.tahun_terbit,
            body: book.body
        };
        this.showModal = true;
    }
}">

    @include('layouts.Navbar')
    
    <!-- Spacer buat navbar - INI PENTING! -->
    <div class="pt-20"></div>

    <!-- Success Notification -->
    @if(session('success'))
    <div x-data="{ show: true }" 
         x-show="show" 
         x-init="setTimeout(() => show = false, 5000)"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed top-24 right-4 z-50 max-w-sm">
        <div class="bg-green-50 border-l-4 border-green-500 rounded-lg shadow-lg p-4 flex items-start gap-3">
            <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-sm font-bold text-green-800">Berhasil!</h3>
                <p class="text-sm text-green-700 mt-1">{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="flex-shrink-0 text-green-500 hover:text-green-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
    @endif

    <!-- Error Notification -->
  @if($errors->any())
<div x-data="{ show: true }" 
     x-show="show" 
     x-init="setTimeout(() => show = false, 7000)"
     class="fixed top-24 right-4 z-50 max-w-sm">
    <div class="bg-red-50 border-l-4 border-red-500 rounded-lg shadow-lg p-4 flex items-start gap-3">
        <div class="flex-shrink-0">
            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div class="flex-1">
            <h3 class="text-sm font-bold text-red-800">Ups! Ada Kesalahan:</h3>
            <ul class="mt-1 ml-4 list-disc list-inside text-sm text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button @click="show = false" class="text-red-500 hover:text-red-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>
@endif

    <!-- Page Header -->
    <div class="bg-gradient-to-r from-white-600 to-white-700 py-8 md:py-12">
    <div class="max-w-7xl mx-auto px-4 lg:px-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-blue mb-2">Kelola Buku</h1>
                <p class="text-sm md:text-base text-blue mb-3 md:mb-0">Manage dan update koleksi buku perpustakaan</p>
                <a href="{{ route('buku.laporan') }}" class="inline-flex items-center gap-2 text-blue-500 hover:text-blue-100 transition-colors text-sm font-medium mt-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Download Laporan Semua Buku
                </a>
            </div>
            <button @click="openAddModal()" class="bg-white text-blue-600 px-6 py-3 rounded-xl font-bold hover:bg-blue-50 transition-all shadow-lg hover:shadow-xl flex items-center gap-2 group">
                <svg class="w-5 h-5 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Buku
            </button>
        </div>
    </div>
</div>


    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 lg:px-6 py-8">
        
       @include('admin.books.stats')
       @include('admin.books.search')
       @include('admin.books.table')
    </div>
    @include('admin.books.modal')
    

</body>
</html>