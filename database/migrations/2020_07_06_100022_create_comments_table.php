<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('user_comment');
            $table->string('name');
            $table->unsignedBigInteger('posts_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('categories_id');
            $table->timestamps();

            $table->foreign('posts_id')
                  ->references('id')
                  ->on('posts')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('categories_id')
                  ->references('id')
                  ->on('categories')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
