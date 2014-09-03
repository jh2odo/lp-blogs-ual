<?php

class Post extends Eloquent
{

    protected $fillable = ['title', 'summary', 'content'];

    protected $table = 'posts';
    protected $primaryKey = 'id_posts';

    public function delete()
    {
        foreach ($this->getComments as $comment) {
            $comment->delete();
        }
        
        /*
        foreach ($this->getTag as $tag) {
        	$tag->delete();
        }*/
        
        return parent::delete();
    }
    
    
    //////////////////////////
    
    public function getBlog(){
    	return $this->belongsTo('Blog','id_blogs');
    }
    
    public function getComments()
    {
    	return $this->hasMany('Comment','id_posts');
    }
    
    public function getTags(){
    	return $this->belongsToMany('Tag', 'posts_tags', 'id_posts', 'id_tags');
    }

}
