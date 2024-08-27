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
        Schema::create('umkm', function (Blueprint $table) {
            $table->id();
            $table->string('nama_umkm');
            $table->string('nama_pemilik');
            $table->string('alamat_umkm');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('foto_umkm')->nullable();
            $table->longText('deskripsi_umkm');
            $table->string('kontak');
            $table->string('whatsapp');
            $table->string('email');
            $table->string('instagram');
            $table->foreignId('desa_potensi_id')->constrained('desa_potensis')->onDelete('cascade');
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
        Schema::dropIfExists('umkm');
    }
};
