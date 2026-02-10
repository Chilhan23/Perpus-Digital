<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Books;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BorrowController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $borrows = $user->borrows()
            ->with('book.category')
            ->latest()
            ->paginate(10);

        $stats = [
            'total' => $user->borrows()->count(), 
            'active' => $user->borrows()->where('status', 'dipinjam')->count(),
            'returned' => $user->borrows()->where('status', 'dikembalikan')->count(),
            'overdue' => $user->borrows()
                ->where('status', 'dipinjam')
                ->where('tanggal_kembali', '<', now())
                ->count(),
        ];

        return view('user.borrows.index', compact('borrows', 'stats'));
    }

    public function store(Request $request, Books $book)
    {
        $user = Auth::user();

        if ($user->hasBorrowed($book->id)) {
            return back()->with('error', 'Kamu sudah meminjam buku ini!');
        }

        if ($book->isBorrowed()) {
            return back()->with('error', 'Buku sedang dipinjam orang lain!');
        }

        if ($user->activeBorrows()->count() >= 3) {
            return back()->with('error', 'Maksimal 3 buku dipinjam!');
        }

        Borrow::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'tanggal_pinjam' => now(),
            'tanggal_kembali' => now()->addDays(7),
            'status' => 'dipinjam',
        ]);

        return back()->with('success', 'Buku berhasil dipinjam!');
    }

    public function cancel(Borrow $borrow)
    {
        abort_if($borrow->user_id !== Auth::id(), 403);

        if ($borrow->created_at->diffInHours(now()) > 1) {
            return back()->with('error', 'Tidak bisa dibatalkan (lebih dari 1 jam)');
        }

        $borrow->delete();
        return back()->with('success', 'Peminjaman dibatalkan');
    }

    

    public function adminIndex(Request $request)
    {
        abort_unless(Auth::user()->is_admin, 403);

        $query = Borrow::with(['user', 'book.category'])->latest();

        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('user', fn ($u) =>
                    $u->where('name', 'like', "%{$request->search}%")
                )->orWhereHas('book', fn ($b) =>
                    $b->where('judul', 'like', "%{$request->search}%")
                );
            });
        }

        $borrows = $query->paginate(15);

        $stats = [
            'total' => Borrow::count(),
            'active' => Borrow::where('status', 'dipinjam')->count(),
            'returned' => Borrow::where('status', 'dikembalikan')->count(),
            'overdue' => Borrow::where('status', 'dipinjam')
                ->where('tanggal_kembali', '<', now())
                ->count(),
        ];

        return view('admin.borrows.index', compact('borrows', 'stats'));
    }

    public function returnBook(Borrow $borrow)
    {
        abort_unless(Auth::user()->is_admin, 403);

        if ($borrow->status !== 'dipinjam') {
            return back()->with('error', 'Buku sudah dikembalikan');
        }

        $borrow->returnBook();

        return back()->with(
            'success',
            $borrow->status === 'terlambat'
                ? 'Buku dikembalikan (kena denda)'
                : 'Buku berhasil dikembalikan'
        );
    }

    public function destroy(Borrow $borrow)
    {
        abort_unless(Auth::user()->is_admin, 403);

        $borrow->delete();
        return back()->with('success', 'Data peminjaman dihapus');
    }

   public function DownloadInvoice($id)
    {
    $borrow = Borrow::with(['user', 'book'])->findOrFail($id);
    //user checker if acces other invoice
    $user = Auth::user();
    if (!$user->is_admin && $user->id !== $borrow->user_id) {
        abort(403, 'Akses ilegal! Aktivitas ini telah dicatat.'); 
    }
    
    $view = $user->is_admin ? 'admin.borrows.invoice' : 'user.borrows.invoice';
    $pdf = Pdf::loadView($view, compact('borrow'));
    $fileName = 'Invoice-' . \Illuminate\Support\Str::slug($borrow->user->name) . '.pdf';
    return $pdf->download($fileName);
    }

    public function BorrowData(){
        $borrow = Borrow::with(['user','book'])->get();
        $user = Auth::user();
        if (!$user->is_admin) {
            abort(403, 'Akses ilegal! Aktivitas ini telah dicatat.'); 
        }

        $pdf = Pdf::loadView('admin.borrows.laporan',compact('borrow'));
        $fileName = 'Data Peminjaman'  . '.pdf';
        return $pdf->download($fileName);
    }
}


