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
        'harga_beli',
        'jumlah',
        'foto'
    ];
}
