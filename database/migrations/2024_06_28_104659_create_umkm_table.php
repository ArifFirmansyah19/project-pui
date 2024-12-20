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
            $table->string('nama_umkm', 50);
            $table->string('nama_pemilik', 50);
            $table->string('alamat_umkm', 255);
            $table->decimal('latitude', 9, 6);
            $table->decimal('longitude', 9, 6);
            // $table->string('foto_umkm', 100)->nullable();
            $table->mediumText('deskripsi_umkm');
            $table->string('kontak', 100);
            $table->string('whatsapp', 100);
            $table->string('email', 100);
            $table->string('instagram', 100);
            $table->foreignId('kecamatan_id')->constrained('kecamatans')->onDelete('cascade');
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
