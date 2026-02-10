<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Books;

use App\Http\Controllers\{
    BukuController,
    ProfileController,
    Dashboard,
    BorrowController
};

/*Public Routes*/

Route::view('/', 'welcome')->name('home');

/* Authenticated Routes*/

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('admin.dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'check'])->name('dashboard');
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('my-borrows')->name('borrows.')->group(function () {
        Route::get('/', [BorrowController::class, 'index'])->name('index');
        Route::post('/{book}', [BorrowController::class, 'store'])->name('store');
        Route::delete('/{borrow}/cancel', [BorrowController::class, 'cancel'])->name('cancel');
    });

    Route::get('/loan/{id}/invoice',[BorrowController::class,'DownloadInvoice'])->name('loan.invoice');
    


});

/*
| Admin Routes
*/

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::prefix('borrows')->name('borrows.')->group(function () {
        Route::get('/', [BorrowController::class, 'adminIndex'])->name('index');
        Route::patch('/{borrow}/return', [BorrowController::class, 'returnBook'])->name('return');
        Route::delete('/{borrow}', [BorrowController::class, 'destroy'])->name('destroy');
        Route::get('/loan/{id}/invoice',[BorrowController::class,'DownloadInvoice'])->name('loan.invoice');
        Route::get('/laporan',[BorrowController::class,'BorrowData'])->name('laporan');
    });

});

/*
| Books (Public)
*/

Route::get('/books', function () {
    $books = Books::filter(request(['keyword','category','author']))
        ->paginate(Books::count() > 40 ? 9 : 5)
        ->withQueryString();

    return view('books', compact('books'));
})->name('books');

Route::get('/books/{book:code}', fn (Books $book) =>
    view('book', compact('book'))
);

/*
| Buku CRUD (Admin / Operator)
*/

Route::prefix('buku')->name('buku.')->group(function () {
    Route::get('/', [BukuController::class,'index'])->name('index');
    Route::post('/', [BukuController::class,'store'])->name('store');
    Route::put('/{id}', [BukuController::class,'update'])->name('update');
    Route::delete('/{id}', [BukuController::class,'destroy'])->name('destroy');
    Route::get('/laporan',[BukuController::class,'export_excel'])->name('laporan');
});


require __DIR__.'/auth.php';
