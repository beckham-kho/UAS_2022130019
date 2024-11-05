<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kuota extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama_provider',
        'nominal_paket',
        'masa_aktif',
        'harga_jual',
        'harga_beli',
        'jumlah'
    ];
}
