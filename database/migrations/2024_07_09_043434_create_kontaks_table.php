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
        Schema::create('kontaks', function (Blueprint $table) {
            $table->id();
            $table->string('alamat', 100);
            $table->string('email', 50);
            $table->string('telepon', 20);
            $table->string('facebook', 100);
            $table->string('twitter', 100);
            $table->string('instagram', 100);
            $table->string('youtube', 100);
            $table->string('tiktok', 100);
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
        Schema::dropIfExists('kontaks');
    }
};