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
        Schema::create('tims', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('foto', 100)->nullable();
            $table->foreignId('divisi_id')->constrained('divisis')->onDelete('cascade');
            $table->string('jabatan', 100);
            // $table->foreignId('jabatan_id')->constrained('jabatans')->onDelete('cascade');
            $table->string('bidang_keahlian', 100);
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
        Schema::dropIfExists('tims');
    }
};
