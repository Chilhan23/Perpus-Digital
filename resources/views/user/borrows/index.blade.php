<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-6 md:py-8">

        <div class="mb-6 md:mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-slate-800 mb-2">Halo, {{ Auth::user()->name }}! 👋</h1>
            <p class="text-sm md:text-base text-slate-600">Inii adalah daftar Peminjaman Buku Anda</p>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-6 mb-6 md:mb-8">
            @php
                $cards = [
                    ['Total', $stats['total'], 'blue'],
                    ['Dipinjam', $stats['active'], 'yellow'],
                    ['Dikembalikan', $stats['returned'], 'green'],
                    ['Terlambat', $stats['overdue'], 'red'],
                ];
            @endphp

            @foreach($cards as [$label, $value, $color])
                <div class="bg-white p-4 md:p-6 rounded-lg shadow border">
                    <p class="text-xs md:text-sm text-slate-600 mb-1">{{ $label }}</p>
                    <h3 class="text-2xl md:text-3xl font-bold text-{{ $color }}-600">
                        {{ $value }}
                    </h3>
                </div>
            @endforeach
        </div>

        {{-- Desktop Table --}}
        <div class="hidden md:block bg-white rounded-lg shadow border overflow-hidden">
            <table class="w-full">
                <thead class="bg-slate-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Buku</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Pinjam</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Kembali</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($borrows as $borrow)
                    <tr class="border-t hover:bg-slate-50">
                        <td class="px-6 py-4">
                            <p class="font-semibold text-sm">{{ $borrow->book->judul }}</p>
                            <p class="text-xs text-gray-500">{{ $borrow->book->penulis }}</p>
                        </td>

                        <td class="px-6 py-4 text-sm">
                            {{ $borrow->tanggal_pinjam->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4 text-sm">
                            {{ $borrow->tanggal_kembali->format('d M Y') }}
                            @if($borrow->status === 'dipinjam' && $borrow->tanggal_kembali->isPast())
                                <span class="text-red-600 text-xs font-semibold block">(Terlambat)</span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            @switch($borrow->status)
                                @case('dipinjam')
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-xs font-medium">Dipinjam</span>
                                    @break
                                @case('dikembalikan')
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-medium">Dikembalikan</span>
                                    @break
                                @default
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs font-medium">Terlambat</span>
                            @endswitch
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                {{-- Tombol Download Invoice --}}
                            {{-- <a href="{{ route('loan.invoice', $borrow->id) }}" 
                            class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-800 font-semibold text-sm transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                                </svg>
                                Invoice
                            </a> --}}
                            @if($borrow->status === 'dipinjam' && $borrow->created_at->diffInMinutes(now()) <= 10)
                                <form method="POST" action="{{ route('borrows.cancel', $borrow) }}"
                                    onsubmit="return confirm('Batalkan peminjaman?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 text-sm font-semibold hover:text-red-800">
                                        Batalkan
                                    </button>
                                </form>
                            @elseif($borrow->status === 'dipinjam')
                                <span class="text-gray-400 text-xs">Tidak dapat dibatalkan</span>

                                  <a href="{{ route('loan.invoice', $borrow->id) }}" 
                            class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-800 font-semibold text-sm transition-colors">
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
                        <td colspan="5" class="text-center py-10 text-gray-500">
                            Belum ada peminjaman
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="p-4 border-t">
                {{ $borrows->links() }}
            </div>
        </div>

        {{-- Mobile Cards --}}
        <div class="md:hidden space-y-4">
            @forelse($borrows as $borrow)
            <div class="bg-white rounded-lg shadow border p-4">
                <!-- Book Info -->
                <div class="flex items-start justify-between mb-3 pb-3 border-b">
                    <div class="flex-1">
                        <p class="font-bold text-sm text-slate-800 mb-1">{{ $borrow->book->judul }}</p>
                        <p class="text-xs text-gray-500">{{ $borrow->book->penulis }}</p>
                    </div>
                    @switch($borrow->status)
                        @case('dipinjam')
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-xs font-medium flex-shrink-0 ml-2">Dipinjam</span>
                            @break
                        @case('dikembalikan')
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-medium flex-shrink-0 ml-2">Dikembalikan</span>
                            @break
                        @default
                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs font-medium flex-shrink-0 ml-2">Terlambat</span>
                    @endswitch
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
                        @if($borrow->status === 'dipinjam' && $borrow->tanggal_kembali->isPast())
                            <p class="text-red-600 font-semibold mt-1">(Terlambat)</p>
                        @endif
                    </div>
                </div>

                <!-- Action -->
                @if($borrow->status === 'dipinjam' && $borrow->created_at->diffInMinutes(now()) <= 10)
                    <form method="POST" action="{{ route('borrows.cancel', $borrow) }}" class="pt-3 border-t"
                        onsubmit="return confirm('Batalkan peminjaman?')">
                        @csrf
                        @method('DELETE')
                        <button class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-semibold">
                            Batalkan Peminjaman
                        </button>
                    </form>
                @elseif($borrow->status === 'dipinjam')
                    <div class="pt-3 border-t">
                        <p class="text-gray-400 text-xs text-center">Tidak dapat dibatalkan (lewat dari 10 menit)</p>
                    </div>
                @endif
            </div>
            @empty
            <div class="bg-white rounded-lg shadow border p-8 text-center">
                <p class="text-gray-500">Belum ada peminjaman</p>
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
</x-app-layout>