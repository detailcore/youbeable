<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslatedPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translated_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            // $table->integer('owner_user_id')->nullable();
            // $table->integer('post_type_id');
            // $table->integer('accepted_answer_id')->nullable();
            // $table->integer('score')->default(0);
            // $table->integer('parent_id');
            $table->string('title', 512)->nullable();
            $table->mediumText('body');
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
        Schema::dropIfExists('translated_posts');
    }
}
