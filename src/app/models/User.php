<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	
	protected $fillable = ['username', 'password', 'email'];
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	protected $primaryKey = 'id_users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{

		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	
	/**
	 * Required for laravel 4.1.26+
	 *
	 */
	public function getRememberToken()
	{
	    return $this->remember_token;
	}

	public function setRememberToken($value)
	{
	    $this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
	    return 'remember_token';
	}


	
	///////////////////////////////////////////
	
	public function delete()
	{
		foreach ($this->getBlogs as $blog) {
			$blog->delete();
		}
		
		foreach ($this->getComments as $comment) {
			$comment->delete();
		}
		
		return parent::delete();
	}
	
	public function getBlogs(){
		return $this->hasMany('Blog','id_users');
	}
	
	public function getComments(){
		return $this->hasMany('Comment', 'id_users');
	}


}
