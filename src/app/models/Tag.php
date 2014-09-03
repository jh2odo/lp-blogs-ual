<?php

class Tag extends Eloquent
{

    protected $fillable = ['name'];

    protected $table = 'tags';
    protected $primaryKey = 'id_tags';
    
    //////////////////////////
    
    /*
    public function delete()
    {
    	foreach ($this->getPosts as $post) {
    		$post->delete();
    	}
    	return parent::delete();
    }*/
    
    public function getPosts(){
    	return $this->belongsToMany('Post', 'posts_tags', 'id_tags', 'id_posts');
    }

}
