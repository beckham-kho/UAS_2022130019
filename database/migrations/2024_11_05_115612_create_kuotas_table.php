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
        Schema::create('kuotas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_provider');
            $table->string('nominal_paket');
            $table->string('masa_aktif');
            $table->integer('harga_jual');
            $table->integer('modal');
            $table->integer('jumlah')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuotas');
    }
};
