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
        Schema::create('detail_faktur_kuotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_faktur')->constrained('fakturs', 'id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_kuota')->constrained('kuotas', 'id')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_provider');
            $table->string('nominal_paket');
            $table->string('masa_aktif');
            $table->integer('qty');
            $table->integer('diskon')->default(0);
            $table->integer('harga_kuota');
            $table->integer('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_faktur_kuotas');
    }
};
