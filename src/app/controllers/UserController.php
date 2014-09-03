<?php

class UserController extends BaseController
{
  
    // Revisado 
    public function showUser(User $user)
    {
    	$blogs = $user->getBlogs;
    	$this->layout->title = $user->username;
    	$this->layout->subtitle = $user->email;
    	$this->layout->main = View::make('home')->nest('content', 'users.single', compact('blogs'));
    }
    
    // Revisado
    public function showDashBoard(){
    	$this->layout->title = 'DashBoard';
    	$this->layout->subtitle = Auth::user()->username;
    	
    	$this->layout->main = View::make('dash')->nest('content', 'dash.index');
    }
    
    // Revisado
    public function editUser()
    {
    	$this->layout->title = 'Edit User';
    	$this->layout->subtitle = Auth::user()->username;
    	$user = Auth::user();
    	$this->layout->main = View::make('dash')->nest('content', 'users.edit', compact('user'));
    }
    
    // Revisado
    public function deleteUser()
    {
    	$user = Auth::user();
    	$user->delete();
    	return Redirect::to('/');
    }
    
    
    /* post functions */
    
    // Revisado
    public function updateUser()
    {
    	$data = [
    	'email' => Input::get('email')
    	];
    	$rules = [
    	'email' => 'required'
    	];
    	$valid = Validator::make($data, $rules);
    	if ($valid->passes()) {
    		$user = Auth::user();
    		$user->email = $data['email'];
    		
    		if (count($user->getDirty()) > 0) /* avoiding resubmission of same content */ {
    			$user->save();
    			return Redirect::back()->with('success', 'User is updated!');
    		} else
    			return Redirect::back()->with('success', 'Nothing to update!');
    	} else
    		return Redirect::back()->withErrors($valid)->withInput();
    }
    
}
