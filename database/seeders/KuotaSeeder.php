<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KuotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kuotas')->insert(
            [
                ['nama_provider' => 'Axis', 'nominal_paket' => '1', 'masa_aktif' => '5', 'harga_jual' => 11000, 'modal' => 10000, 'jumlah' => 100],
                ['nama_provider' => 'Indosat/IM3', 'nominal_paket' => '2,5', 'masa_aktif' => '5', 'harga_jual' => 14000, 'modal' => 12400, 'jumlah' => 68],
                ['nama_provider' => 'Smartfren', 'nominal_paket' => '4', 'masa_aktif' => '7', 'harga_jual' => 14000, 'modal' => 12600, 'jumlah' => 31],
                ['nama_provider' => 'Telkomsel', 'nominal_paket' => '4', 'masa_aktif' => '30', 'harga_jual' => 30000, 'modal' => 26000, 'jumlah' => 4],
                ['nama_provider' => 'Tri', 'nominal_paket' => '2,5', 'masa_aktif' => '30', 'harga_jual' => 25000, 'modal' => 23800, 'jumlah' => 20],
            ]
        );
    }
}

