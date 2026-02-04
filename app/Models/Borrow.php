<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_dikembalikan',
        'status',
        'denda',
        'catatan'
    ];

    protected $casts = [
        'tanggal_pinjam' => 'datetime',
        'tanggal_kembali' => 'datetime',
        'tanggal_dikembalikan' => 'datetime',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Book
    public function book()
    {
        return $this->belongsTo(Books::class, 'book_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'dipinjam');
    }

    public function scopeReturned($query)
    {
        return $query->where('status', 'dikembalikan');
    }

    public function scopeOverdue($query)
    {
        return $query->where('status', 'dipinjam')
                     ->where('tanggal_kembali', '<', now());
    }

    public function getDaysLeftAttribute()
    {
        if ($this->status == 'dikembalikan') {
            return 0;
        }
        
        return Carbon::parse($this->tanggal_kembali)->diffInDays(now(), false);
    }

    public function getIsOverdueAttribute()
    {
        if ($this->status == 'dikembalikan') {
            return false;
        }
        
        return now() > $this->tanggal_kembali;
    }

    // Method untuk hitung denda
    public function calculateDenda()
    {
        if (!$this->is_overdue) {
            return 0;
        }

        $daysLate = abs($this->days_left);
        $dendaPerHari = 1000; // Rp 1.000 per hari
        
        return $daysLate * $dendaPerHari;
    }

    // Method untuk proses pengembalian
    public function returnBook()
    {
        $this->tanggal_dikembalikan = now();
        
        if ($this->is_overdue) {
            $this->status = 'terlambat';
            $this->denda = $this->calculateDenda();
        } else {
            $this->status = 'dikembalikan';
            $this->denda = 0;
        }
        
        $this->save();
        
        return $this;
    }
}