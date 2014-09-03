<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//  - blogs: id, title, description, date, id_users
		Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id_blogs');
            $table->string('title');
            $table->string('description');
            $table->timestamps(); // date : created_at y updated_at
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
		Schema::drop('blogs');
	}

}
