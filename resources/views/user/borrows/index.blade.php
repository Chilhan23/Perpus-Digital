<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-800 mb-2">Dashboard Saya</h1>
            <p class="text-slate-600">Halo, {{ Auth::user()->name }}! 👋</p>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            @php
                $cards = [
                    ['Total', $stats['total'], 'blue'],
                    ['Dipinjam', $stats['active'], 'yellow'],
                    ['Dikembalikan', $stats['returned'], 'green'],
                    ['Terlambat', $stats['overdue'], 'red'],
                ];
            @endphp

            @foreach($cards as [$label, $value, $color])
                <div class="bg-white p-6 rounded-lg shadow border">
                    <p class="text-sm text-slate-600">{{ $label }}</p>
                    <h3 class="text-3xl font-bold text-{{ $color }}-600">
                        {{ $value }}
                    </h3>
                </div>
            @endforeach
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-lg shadow border overflow-hidden">
            <table class="w-full">
                <thead class="bg-slate-100">
                    <tr>
                        <th class="px-6 py-3 text-left">Buku</th>
                        <th class="px-6 py-3 text-left">Pinjam</th>
                        <th class="px-6 py-3 text-left">Kembali</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($borrows as $borrow)
                    <tr class="border-t">
                        <td class="px-6 py-4">
                            <p class="font-semibold">{{ $borrow->book->judul }}</p>
                            <p class="text-xs text-gray-500">{{ $borrow->book->penulis }}</p>
                        </td>

                        <td class="px-6 py-4">
                            {{ $borrow->tanggal_pinjam->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $borrow->tanggal_kembali->format('d M Y') }}
                            @if($borrow->status === 'dipinjam' && $borrow->tanggal_kembali->isPast())
                                <span class="text-red-600 text-xs font-semibold">(Terlambat)</span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            @switch($borrow->status)
                                @case('dipinjam')
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-xs">Dipinjam</span>
                                    @break
                                @case('dikembalikan')
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">Dikembalikan</span>
                                    @break
                                @default
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs">Terlambat</span>
                            @endswitch
                        </td>

                        <td class="px-6 py-4">
                            @if($borrow->status === 'dipinjam')
                                <form method="POST" action="{{ route('borrows.cancel', $borrow) }}"
                                      onsubmit="return confirm('Batalkan peminjaman?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 text-sm font-semibold">
                                        Batalkan
                                    </button>
                                </form>
                            @endif
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

            <div class="p-4">
                {{ $borrows->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
