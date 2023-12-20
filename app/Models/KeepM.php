<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class KeepM extends Model
{
    use HasFactory, Searchable;
    protected $table = "keep";
    protected $fillable = ["id","nama_penyimpan", "nomor_keep", "jumlah_simpan","pajak", "total_simpan","sisa_simpan"];
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function searchableAs()
    {
        return 'keep';
    }

    public function toSearchableArray()
    {
        return [
            'nama_penyimpan'     => $this->nama_penyimpan,
            'created_at'     => $this->created_at,
        ];
    }
}
