<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// - posts_tags: id_posts, id_tags
		Schema::create('posts_tags', function (Blueprint $table) {
			$table->unsignedInteger('id_posts');
			$table->unsignedInteger('id_tags');
			$table->timestamps(); // date : created_at y updated_at
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts_tags');
	}

}
