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
            $table->string('nama_potensi', 100);
            $table->decimal('latitude', 9, 6);
            $table->decimal('longitude', 9, 6);
            $table->mediumText('deskripsi_potensi');
            $table->string('alamat', 100);
            // $table->string('foto_potensi', 100)->nullable();
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
        Schema::dropIfExists('potensi_desas');
    }
};
