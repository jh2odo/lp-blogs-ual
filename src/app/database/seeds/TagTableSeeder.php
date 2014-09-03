<?php

class TagTableSeeder extends Seeder
{

    public function run()
    {
    	DB::table('tags')->delete();
    	
    	$tag = new Tag;
		$tag->name = "general";
		$tag->save();
		
		$tag = new Tag;
		$tag->name = "network";
		$tag->save();
		
		$tag = new Tag;
		$tag->name = "ual";
		$tag->save();
		
		$tag = new Tag;
		$tag->name = "news";
		$tag->save();
    }

}
