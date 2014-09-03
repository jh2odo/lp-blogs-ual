<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // posts: id, title, summary, content, date, id_blogs.
    	Schema::create('posts', function (Blueprint $table) {
            $table->increments('id_posts');
            $table->string('title');
            $table->string('summary');
            $table->text('content');
            $table->timestamps();
            $table->unsignedInteger('id_blogs');
            //$table->engine = 'MyISAM';
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      	Schema::drop('posts');
    }

}
