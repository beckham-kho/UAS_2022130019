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
        Schema::create('fakturs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_trx');
            $table->string('tanggal_trx');
            $table->foreignId('id_pelanggan')->constrained('pelanggans', 'id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_kurir')->constrained('kurirs', 'id')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('total_qty');
            $table->integer('total_harga');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fakturs');
    }
};
