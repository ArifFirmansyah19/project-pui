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
        Schema::create('data_keragamans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('foto_keragaman')->nullable();
            $table->longText('deskripsi');
            $table->string('lokasi');
            $table->string('umur');
            $table->foreignId('jenis_keragaman_id')->constrained('jenis_keragamans')->onDelete('cascade');
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
        Schema::dropIfExists('data_keragamans');
    }
};
