<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    // Relasi ke Borrow (Peminjaman)
    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    // Method untuk cek apakah user sudah pinjam buku tertentu
    public function hasBorrowed($bookId)
    {
        return $this->borrows()
                    ->where('book_id', $bookId)
                    ->where('status', 'dipinjam')
                    ->exists();
    }

    // Method untuk get peminjaman aktif
    public function activeBorrows()
    {
        return $this->borrows()->where('status', 'dipinjam');
    }
}