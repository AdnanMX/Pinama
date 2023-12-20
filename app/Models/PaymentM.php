<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class PaymentM extends Model
{
    use HasFactory, Searchable;
    protected $table = "payment";
    protected $fillable = ["id","id_payment","nomor_payment", "title", "uang_bayar","bayaran"];
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function searchableAs()
    {
        return 'payment';
    }

    public function toSearchableArray()
    {
        return [
            'title'     => $this->title,
            'created_at'     => $this->created_at,
        ];
    }
}
