<?php

class Blog extends Eloquent
{

    protected $fillable = ['title', 'description'];

    protected $table = 'blogs';
    protected $primaryKey = 'id_blogs';

    ///////////////////////////////////
    
    public function delete()
    {
        foreach ($this->getPosts as $post) {
            $post->delete();
        }
        return parent::delete();
    }
    
    public function getUser(){
    	return $this->belongsTo('User','id_users');
    }
    
    public function getPosts(){
    	return $this->hasMany('Post','id_blogs');
    }

}
