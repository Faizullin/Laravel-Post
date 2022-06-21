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
        Schema::create('posts', function (Blueprint $table) {
          $table->id();
          $table->string('title')->unique();
          $table->text('body');
          $table->text('description');

          $table->unsignedBigInteger('user_id')->nullable();
          $table->unsignedBigInteger('category_id')->nullable();
          $table->index('category_id','post_category_idx');

          $table->foreign('category_id','post_category_fk')->on('categories')->references('id')->onDelete('set null');
          $table->foreign('user_id')->on('users')->references('id')->onDelete('set null');
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
        Schema::dropIfExists('posts');
    }
};
