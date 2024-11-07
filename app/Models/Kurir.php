<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama_kurir',
        'no_telp',
        'status',
        'foto',
    ];
}
