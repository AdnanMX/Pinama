<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class BorrowM extends Model
{
    use HasFactory, Searchable;
    protected $table = "borrow";
    protected $fillable = ["id","nama_peminjam", "nomor_borrow", "foto", "jumlah_pinjam", "bunga", "lama_pinjam", "total_pinjam","sisa_bayar", "status","alamat","no_hp"];
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function searchableAs()
    {
        return 'borrow';
    }

    public function toSearchableArray()
    {
        return [
            'nama_peminjam'     => $this->nama_peminjam,
            'created_at'     => $this->created_at,
        ];
    }
}
