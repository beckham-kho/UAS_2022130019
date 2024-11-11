<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetailFakturAccessories extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_faktur',
        'id_accessories',
        'nama_acc',
        'kategori',
        'qty',
        'harga_accessories',
        'diskon',
        'subtotal'
    ];

    public function accessories(): HasMany
    {
        return $this->hasMany(Accessories::class, 'id');
    }
}
