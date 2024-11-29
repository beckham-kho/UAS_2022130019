<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('catatan_keuangans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_keuangan');
            $table->date('tanggal_keuangan');
            $table->integer('nominal');
            $table->string('kategori');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_keuangans');
    }
};
