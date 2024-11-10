<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kurir extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama_kurir',
        'no_telp',
        'status',
        'foto',
    ];

    public function faktur(): HasMany
    {
        return $this->hasMany(Faktur::class, 'id');
    }
}
