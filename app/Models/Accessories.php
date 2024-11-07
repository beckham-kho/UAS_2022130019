<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accessories extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama_acc',
        'kategori',
        'harga_jual',
        'harga_beli',
        'jumlah',
        'foto'
    ];
}
