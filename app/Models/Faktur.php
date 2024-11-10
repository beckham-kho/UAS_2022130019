<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;

class Faktur extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'kode_trx',
        'tanggal_trx',
        'id_pelanggan',
        'id_kurir',
        'total_qty',
        'total_harga'
    ];

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function kurir(): BelongsTo
    {
        return $this->belongsTo(Kurir::class, 'id_kurir');
    }

    public function detailKuota(): HasMany
    {
        return $this->hasMany(DetailFakturKuota::class, 'id_faktur');
    }
}
