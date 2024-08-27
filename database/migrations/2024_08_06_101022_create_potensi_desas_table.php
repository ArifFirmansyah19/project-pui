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
        Schema::create('potensi_desas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_potensi');
            $table->string('foto_potensi')->nullable();
            $table->longText('deskripsi_potensi');
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
        Schema::dropIfExists('potensi_desas');
    }
};