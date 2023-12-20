<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class TakeM extends Model
{
    use HasFactory, Searchable;
    protected $table = "take";
    protected $fillable = ["id","id_take","nomor_take","nama_pengambil","foto","uang_ambil","lama_ambil","bunga","total_ambil","total_simpan","simpanan"];
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function searchableAs()
    {
        return 'take';
    }

    public function toSearchableArray()
    {
        return [
            
            'nama_pengambil'     => $this->nama_pengambil,
            'created_at'     => $this->created_at,
        ];
    }
}
