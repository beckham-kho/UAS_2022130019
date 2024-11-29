<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('accessories')->insert(
            [
                ['nama_acc' => 'Casing Choice Realme C25', 'kategori' => 'Casing', 'harga_jual' => 20000, 'modal' => 10000, 'jumlah' => 4, 'foto' => 'acc1.jpg'],
                ['nama_acc' => 'Oppo Charger 67W Type C Super VOOC Original', 'kategori' => 'Charger', 'harga_jual' => 100000, 'modal' => 80000, 'jumlah' => 1, 'foto' => 'acc2.jpg'],
                ['nama_acc' => 'Kabel Data Type C Vivan', 'kategori' => 'Kabel Data', 'harga_jual' => 20000, 'modal' => 15000, 'jumlah' => 10, 'foto' => 'acc3.jpg'],
            ]
        );
    }
}
