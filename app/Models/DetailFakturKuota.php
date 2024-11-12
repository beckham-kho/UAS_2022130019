<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetailFakturKuota extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_faktur',
        'id_kuota',
        'nama_provider',
        'nominal_paket',
        'masa_aktif',
        'qty',
        'harga_kuota',
        'harga_modal', //hidden
        'subtotal_modal', //hidden
        'diskon',
        'subtotal'
    ];

    public function kuota(): HasMany
    {
        return $this->hasMany(Kuota::class, 'id');
    }
}
