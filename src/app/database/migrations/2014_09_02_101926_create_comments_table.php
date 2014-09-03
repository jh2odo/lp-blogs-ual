<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	//- comments: id, content, date, approved, id_posts, id_users
    	Schema::create('comments', function (Blueprint $table) {
            $table->increments('id_comments');
            $table->string('content');
            $table->boolean('approved');
            $table->timestamps();
            $table->unsignedInteger('id_posts');
            $table->unsignedInteger('id_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }

}
