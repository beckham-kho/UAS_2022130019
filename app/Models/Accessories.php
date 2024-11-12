<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Accessories extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama_acc',
        'kategori',
        'harga_jual',
        'modal',
        'jumlah',
        'foto'
    ];

    public function detailAccessories(): BelongsToMany
    {
        return $this->belongsToMany(DetailFakturKuota::class);
    }
}
