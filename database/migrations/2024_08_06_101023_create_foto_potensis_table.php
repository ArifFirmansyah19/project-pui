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
        Schema::create('foto_potensis', function (Blueprint $table) {
            $table->id();
            $table->string('foto_potensi', 100)->nullable();
            $table->string('deskripsi_foto', 255);
            $table->foreignId('potensi_desas_id')->constrained('potensi_desas')->onDelete('cascade');
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
        Schema::dropIfExists('foto_potensis');
    }
};
