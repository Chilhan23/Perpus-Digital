<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Books extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'code',
        'penulis',
        'category_id',
        'body',
        'tahun_terbit'
    ];

    protected $with = ['category'];

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke Borrow (Peminjaman)
    public function borrows()
    {
        return $this->hasMany(Borrow::class, 'book_id');
    }

    // Method untuk cek apakah buku sedang dipinjam
    public function isBorrowed()
    {
        return $this->borrows()->where('status', 'dipinjam')->exists();
    }

    // Method untuk cek ketersediaan buku
    public function isAvailable()
    {
        return !$this->isBorrowed();
    }

    // Method untuk get jumlah peminjaman
    public function totalBorrows()
    {
        return $this->borrows()->count();
    }

    // Scope untuk filter
    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when(
            $filters['keyword'] ?? false,
            fn ($query, $search) =>
            $query->where('judul', 'like', '%' . $search . '%')
                ->orWhere('penulis', 'like', '%' . $search . '%')
        );

        $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) =>
            $query->whereHas('category', fn ($query) => $query->where('slug', $category))
        );

        $query->when(
            $filters['author'] ?? false,
            fn ($query, $author) =>
            $query->where('penulis', 'like', '%' . $author . '%')
        );
    }
}