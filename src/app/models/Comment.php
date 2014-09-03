<?php

class Comment extends Eloquent
{

    protected $fillable = ['content'];

    protected $table = 'comments';
    protected $primaryKey = 'id_comments';

    public function getApprovedAttribute($approved)
    {
        return (intval($approved) == 1) ? 'yes' : 'no';
    }

    public function setApprovedAttribute($approved)
    {
        $this->attributes['approved'] = ($approved === 'yes') ? 1 : 0;
    }

    
    //////////////////
    
    public function getPost()
    {
    	return $this->belongsTo('Post','id_posts');
    }
    
    public function getUser()
    {
    	return $this->belongsTo('User','id_users');
    }
    
}
