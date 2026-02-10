<?php
namespace App\Exports;

use App\Models\Books;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping; // Tambahkan ini
use Maatwebsite\Excel\Concerns\WithHeadings; // Tambahkan ini

class BookExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        // Gunakan 'with' supaya query-nya cepat (Eager Loading)
        return Books::with('category')->get();
    }

    /**
    * Mengatur judul kolom di bagian paling atas Excel
    */
    public function headings(): array
    {
        return [
            'ID',
            'Judul Buku',
            'Kode',
            'Penulis',
            'Kategori', // Ini kolom relasinya
            'Tahun Terbit',
        ];
    }

    /**
    * Memetakan data mana saja yang mau ditampilkan per kolom
    * @var Books $book
    */
    public function map($book): array
    {
        return [
            $book->id,
            $book->judul,
            $book->code,
            $book->penulis,
            $book->category->name ?? 'Tanpa Kategori', // Mengambil nama kategori
            $book->tahun_terbit,
        ];
    }
}