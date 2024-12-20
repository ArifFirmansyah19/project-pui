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
            $table->string('nama', 50);
            $table->string('foto_keragaman', 100)->nullable();
            $table->mediumText('deskripsi');
            $table->string('lokasi', 255);
            $table->string('umur', 20);
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
