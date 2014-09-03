<?php

class BlogTableSeeder extends Seeder
{

    public function run()
    {
    	DB::table('blogs')->delete();
    	
    	$blog = new Blog;
		$blog->title = "Ejemplo 1";
		$blog->description = "Primer blog de laboratorio";
		$blog->id_users = "1";
		$blog->save();
		
       	$blog = new Blog;
		$blog->title = "Ejemplo 2";
		$blog->description = "Segundo blog de laboratorio";
		$blog->id_users = "1";
		$blog->save();
    }

}
