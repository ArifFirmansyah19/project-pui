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
        Schema::create('sejarahs', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 50);
            $table->string('foto_konten_sejarah', 100)->nullable();
            $table->mediumText('isi_sejarah');
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
        Schema::dropIfExists('sejarahs');
    }
};
