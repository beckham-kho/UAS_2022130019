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
        Schema::create('detail_faktur_accessories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_faktur')->constrained('fakturs', 'id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_accessories')->constrained('accessories', 'id')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_acc');
            $table->string('kategori');
            $table->integer('qty');
            $table->integer('diskon')->default(0);
            $table->integer('harga_accessories');
            $table->integer('harga_modal'); //hidden
            $table->integer('subtotal_modal'); //hidden
            $table->integer('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_faktur_accessories');
    }
};
