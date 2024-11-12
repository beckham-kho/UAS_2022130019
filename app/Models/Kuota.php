<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kuota extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama_provider',
        'nominal_paket',
        'masa_aktif',
        'harga_jual',
        'modal',
        'jumlah'
    ];

    public function detailKuota(): BelongsToMany
    {
        return $this->belongsToMany(DetailFakturKuota::class);
    }
}
