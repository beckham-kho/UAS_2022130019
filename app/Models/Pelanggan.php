<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama_konter',
        'alamat_konter',
        'nama_pemilik',
        'no_telp',
        'email',
    ];

    public function faktur(): HasMany
    {
        return $this->hasMany(Faktur::class, 'id');
    }
}
