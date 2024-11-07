<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama_konter',
        'alamat_konter',
        'nama_pemilik',
        'no_telp',
        'email',
    ];
}
