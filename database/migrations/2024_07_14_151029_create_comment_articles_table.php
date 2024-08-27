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
        Schema::create('comment_articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id'); // ID article
            $table->unsignedBigInteger('parent_id')->nullable(); // ID parent untuk balasan Komment 
            $table->string('nama'); // Nama user yang membuat komentar
            $table->text('isi_komentar'); // Isi komentar 
            $table->boolean('is_admin')->default(false); // Menambahkan kolom is_admin untuk memeriksa apakah yang koment user website/admin         
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('comment_articles')->onDelete('cascade');
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
        Schema::dropIfExists('comment_articles');
    }
};
