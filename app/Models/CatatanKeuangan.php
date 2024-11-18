<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CatatanKeuangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'kode_keuangan',
        'tanggal_keuangan',
        'nominal',
        'kategori',
        'keterangan'
    ];
}
