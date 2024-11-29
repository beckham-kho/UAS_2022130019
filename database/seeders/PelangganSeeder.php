<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pelanggans')->insert(
            [
                ['nama_konter' => 'MegaKom', 'alamat_konter' => 'Jl. Sama Kamu', 'nama_pemilik' => 'Asep', 'no_telp' => '08123456789', 'email' => 'asep236@gmail.com'],
                ['nama_konter' => 'Alwa Cell', 'alamat_konter' => 'Jl. Sama Dia', 'nama_pemilik' => 'Alwa', 'no_telp' => '08123456789', 'email' => 'alwaganteng123@gmail.com'],
            ]
        );
    }
}
