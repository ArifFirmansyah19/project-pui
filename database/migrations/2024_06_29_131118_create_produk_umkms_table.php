<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_umkms', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('foto_produk')->nullable();
            $table->string('deskripsi_produk');
            $table->decimal('harga_terendah', 10, 2);
            $table->decimal('harga_tertinggi', 10, 2);
            $table->foreignId('umkm_id')->constrained('umkm')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk_umkms');
    }
};