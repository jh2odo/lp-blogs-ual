<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// - tags: id, name
		Schema::create('tags', function (Blueprint $table) {
            $table->increments('id_tags');
            $table->string('name');
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
		Schema::drop('tags');
	}

}
