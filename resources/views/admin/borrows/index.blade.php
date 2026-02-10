<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Peminjaman - PerpusDigi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50">

    @include('layouts.Navbar')

    <!-- Success/Error Notification -->
    @if(session('success'))
    <div x-data="{ show: true }" 
         x-show="show" 
         x-init="setTimeout(() => show = false, 5000)"
         class="fixed top-24 right-4 z-50 max-w-sm">
        <div class="bg-green-50 border-l-4 border-green-500 rounded-lg shadow-lg p-4 flex items-start gap-3">
            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-sm text-green-700">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <!-- Page Header -->
    <div class="bg-gradient-to-r from-white-600 to-white-700 py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 lg:px-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-black mb-2">Kelola Peminjaman</h1>
                    <p class="text-sm md:text-base text-black-100">Manage semua peminjaman buku perpustakaan</p>
                </div>
                <div>
                    <a href="{{ route('admin.borrows.laporan') }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-blue-600 text-white hover:bg-blue-700 rounded-lg font-semibold text-sm transition-colors shadow-md hover:shadow-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 lg:px-6 py-6 md:py-8">
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-6 mb-6 md:mb-8">
            <div class="bg-white rounded-lg shadow-md p-4 md:p-6 border border-slate-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="text-slate-600 text-xs md:text-sm font-medium mb-1">Total</p>
                        <h3 class="text-2xl md:text-3xl font-bold text-slate-800">{{ $stats['total'] }}</h3>
                    </div>
                    <div class="hidden md:flex w-12 h-12 bg-blue-100 rounded-lg items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-4 md:p-6 border border-slate-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="text-slate-600 text-xs md:text-sm font-medium mb-1">Dipinjam</p>
                        <h3 class="text-2xl md:text-3xl font-bold text-slate-800">{{ $stats['active'] }}</h3>
                    </div>
                    <div class="hidden md:flex w-12 h-12 bg-yellow-100 rounded-lg items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-4 md:p-6 border border-slate-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="text-slate-600 text-xs md:text-sm font-medium mb-1">Kembali</p>
                        <h3 class="text-2xl md:text-3xl font-bold text-slate-800">{{ $stats['returned'] }}</h3>
                    </div>
                    <div class="hidden md:flex w-12 h-12 bg-green-100 rounded-lg items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-4 md:p-6 border border-slate-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="text-slate-600 text-xs md:text-sm font-medium mb-1">Terlambat</p>
                        <h3 class="text-2xl md:text-3xl font-bold text-slate-800">{{ $stats['overdue'] }}</h3>
                    </div>
                    <div class="hidden md:flex w-12 h-12 bg-red-100 rounded-lg items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters & Search -->
        <div class="bg-white rounded-lg shadow-md p-4 md:p-6 border border-slate-200 mb-6">
            <form method="GET" action="{{ route('admin.borrows.index') }}" class="flex flex-col gap-3 md:gap-4">
                
                <!-- Search -->
                <div class="w-full">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Cari nama user atau judul buku..." 
                           class="w-full px-4 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <!-- Filter Status -->
                    <select name="status" class="flex-1 px-4 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                        <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Sedang Dipinjam</option>
                        <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                        <option value="terlambat" {{ request('status') == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                    </select>

                    <div class="flex gap-3">
                        <!-- Button Search -->
                        <button type="submit" class="flex-1 sm:flex-none px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-semibold text-sm">
                            Filter
                        </button>

                        <!-- Reset -->
                        <a href="{{ route('admin.borrows.index') }}" class="flex-1 sm:flex-none px-6 py-2.5 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300 transition-colors font-semibold text-center text-sm">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Desktop Table -->
        <div class="hidden md:block bg-white rounded-lg shadow-md border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="text-left py-4 px-6 text-sm font-semibold text-slate-700">User</th>
                            <th class="text-left py-4 px-6 text-sm font-semibold text-slate-700">Buku</th>
                            <th class="text-left py-4 px-6 text-sm font-semibold text-slate-700">Tanggal Pinjam</th>
                            <th class="text-left py-4 px-6 text-sm font-semibold text-slate-700">Harus Kembali</th>
                            <th class="text-left py-4 px-6 text-sm font-semibold text-slate-700">Status</th>
                            <th class="text-left py-4 px-6 text-sm font-semibold text-slate-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($borrows as $borrow)
                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-6">
                                <div>
                                    <p class="font-semibold text-slate-800">{{ $borrow->user->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $borrow->user->email }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div>
                                    <p class="font-medium text-slate-800">{{ $borrow->book->judul }}</p>
                                    <p class="text-xs text-slate-500">{{ $borrow->book->penulis }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-sm text-slate-600">
                                {{ $borrow->tanggal_pinjam->format('d M Y') }}
                            </td>
                            <td class="py-4 px-6 text-sm text-slate-600">
                                {{ $borrow->tanggal_kembali->format('d M Y') }}
                                @if($borrow->status == 'dipinjam')
                                    @php
                                        $daysLeft = \Carbon\Carbon::parse($borrow->tanggal_kembali)->diffInDays(now(), false);
                                    @endphp
                                    @if($daysLeft < 0)
                                        <span class="text-red-600 font-semibold">({{ abs($daysLeft) }} hari terlambat)</span>
                                    @elseif($daysLeft <= 3)
                                        <span class="text-orange-600 font-semibold">({{ $daysLeft }} hari lagi)</span>
                                    @endif
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                @if($borrow->status == 'dipinjam')
                                    @if(\Carbon\Carbon::parse($borrow->tanggal_kembali)->isPast())
                                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Terlambat</span>
                                    @else
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">Dipinjam</span>
                                    @endif
                                @elseif($borrow->status == 'dikembalikan')
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Dikembalikan</span>
                                @else
                                    <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Terlambat (Rp {{ number_format($borrow->denda, 0, ',', '.') }})</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex gap-2">
                                    @if($borrow->status == 'dipinjam')
                                        <form action="{{ route('admin.borrows.return', $borrow) }}" method="POST" onsubmit="return confirm('Proses pengembalian buku ini?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm font-semibold">
                                                Kembalikan
                                            </button>
                                        </form>
                                    @endif
                                    @if ($borrow->status == 'dikembalikan')

                                    <form action="{{ route('admin.borrows.destroy', $borrow) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus record ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-semibold">
                                            Hapus
                                        </button>
                                    </form>
                                     <a href="{{ route('admin.borrows.loan.invoice', $borrow->id) }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg font-semibold text-sm transition-colors border border-blue-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                                        </svg>
                                        Invoice
                                    </a>
                                    @endif
                                    @if ($borrow->status == 'terlambat')
                                    <form action="{{ route('admin.borrows.destroy', $borrow) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus record ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-semibold">
                                            Hapus
                                        </button>
                                    </form>
                                         <a href="{{ route('admin.borrows.loan.invoice', $borrow->id) }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg font-semibold text-sm transition-colors border border-blue-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                                        </svg>
                                        Invoice
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-600">
                                Tidak ada data peminjaman
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($borrows->hasPages())
            <div class="p-6 border-t border-slate-200">
                {{ $borrows->links() }}
            </div>
            @endif
        </div>

        <!-- Mobile Cards -->
        <div class="md:hidden space-y-4">
            @forelse($borrows as $borrow)
            <div class="bg-white rounded-lg shadow-md border border-slate-200 p-4">
                <!-- User Info -->
                <div class="flex items-start justify-between mb-3 pb-3 border-b border-slate-100">
                    <div class="flex-1">
                        <p class="font-bold text-slate-800 text-sm">{{ $borrow->user->name }}</p>
                        <p class="text-xs text-slate-500">{{ $borrow->user->email }}</p>
                    </div>
                    @if($borrow->status == 'dipinjam')
                        @if(\Carbon\Carbon::parse($borrow->tanggal_kembali)->isPast())
                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Terlambat</span>
                        @else
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">Dipinjam</span>
                        @endif
                    @elseif($borrow->status == 'dikembalikan')
                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Dikembalikan</span>
                    @else
                        <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Terlambat</span>
                    @endif
                </div>

                <!-- Book Info -->
                <div class="mb-3">
                    <p class="font-semibold text-slate-800 text-sm mb-1">{{ $borrow->book->judul }}</p>
                    <p class="text-xs text-slate-500">oleh {{ $borrow->book->penulis }}</p>
                </div>

                <!-- Dates -->
                <div class="grid grid-cols-2 gap-3 mb-3 text-xs">
                    <div>
                        <p class="text-slate-500 mb-1">Tanggal Pinjam</p>
                        <p class="font-medium text-slate-700">{{ $borrow->tanggal_pinjam->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500 mb-1">Harus Kembali</p>
                        <p class="font-medium text-slate-700">{{ $borrow->tanggal_kembali->format('d M Y') }}</p>
                        @if($borrow->status == 'dipinjam')
                            @php
                                $daysLeft = \Carbon\Carbon::parse($borrow->tanggal_kembali)->diffInDays(now(), false);
                            @endphp
                            @if($daysLeft < 0)
                                <p class="text-red-600 font-semibold mt-1">({{ abs($daysLeft) }} hari terlambat)</p>
                            @elseif($daysLeft <= 3)
                                <p class="text-orange-600 font-semibold mt-1">({{ $daysLeft }} hari lagi)</p>
                            @endif
                        @endif
                    </div>
                </div>

                <!-- Denda if any -->
                @if($borrow->status == 'terlambat' && $borrow->denda > 0)
                <div class="mb-3 p-2 bg-red-50 rounded-lg">
                    <p class="text-xs text-red-700"><strong>Denda:</strong> Rp {{ number_format($borrow->denda, 0, ',', '.') }}</p>
                </div>
                @endif

                <!-- Actions -->
                <div class="flex gap-2 pt-3 border-t border-slate-100">
                    @if($borrow->status == 'dipinjam')
                        <form action="{{ route('admin.borrows.return', $borrow) }}" method="POST" class="flex-1" onsubmit="return confirm('Proses pengembalian buku ini?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm font-semibold">
                                Kembalikan
                            </button>
                        </form>
                    @endif
                    @if ($borrow->status == 'dikembalikan')
                    <div class="flex items-center gap-2 w-full">
                        <form action="{{ route('admin.borrows.destroy', $borrow) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus record ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-semibold">
                                Hapus
                            </button>
                        </form>
                        <a href="{{ route('admin.borrows.loan.invoice', $borrow->id) }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg font-semibold text-sm transition-colors border border-blue-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                            </svg>
                            Invoice
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="bg-white rounded-lg shadow-md border border-slate-200 p-8 text-center">
                <p class="text-slate-600">Tidak ada data peminjaman</p>
            </div>
            @endforelse

            <!-- Mobile Pagination -->
            @if($borrows->hasPages())
            <div class="mt-6">
                {{ $borrows->links() }}
            </div>
            @endif
        </div>

    </div>

</body>
</html>