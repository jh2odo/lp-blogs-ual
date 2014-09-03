<?php

class BlogController extends BaseController
{

	// Revisado
    public function __construct()
    {
        //updated: prevents re-login.
        $this->beforeFilter('guest', ['only' => ['getLogin']]);
        $this->beforeFilter('auth', ['only' => ['getLogout']]);
    }

    // Revisado
    public function getIndex()
    {
        $blogs = Blog::orderBy('id_blogs', 'desc')->paginate(10);
        
        $blogs->getFactory()->setViewName('pagination::simple');
        $this->layout->title = 'Blogs';
        $this->layout->subtitle = 'Directorio de blogs';
        $this->layout->main = View::make('home')->nest('content', 'index', compact('blogs'));
    }
    
    // Revisado
    public function showBlog(Blog $blog)
    {	
    	$posts = $blog->getPosts()->orderBy('id_posts', 'desc')->paginate(10);
    
    	$posts->getFactory()->setViewName('pagination::simple');
    	$this->layout->title = $blog->title . ' of ' . $blog->getUser->username;
    	$this->layout->subtitle = $blog->description;
    	$this->layout->main = View::make('home')->nest('content', 'blog', compact('posts'));
    }
    
    
    // Revisado
    public function getRegister()
    {
    	$this->layout->title = 'register';
    	$this->layout->main = View::make('register');
    }
    
    // Revisado
    public function postRegister()
    {
    	$credentials = [
    	'username' => Input::get('username'),
    	'password' => Input::get('password'),
    	'email' => Input::get('email')
    	];
    	$rules = [
    	'username' => 'required',
    	'password' => 'required',
    	'email' => 'required|email|unique:users',
    			];
    	$validator = Validator::make($credentials, $rules);
    	if ($validator->passes()) {
    		$credentials['password'] =  Hash::make($credentials['password']);
    		$user = new User($credentials);
    		$user->save();
    		return Redirect::to('login')->with('success', 'User is registered!');
    	} else {
    		return Redirect::back()->withErrors($validator)->withInput();
    	}
    }

    
    // Revisado
    public function getLogin()
    {
        $this->layout->title = 'login';
        $this->layout->main = View::make('login');
    }

    // Revisado
    public function postLogin()
    {
        $credentials = [
            'email' => Input::get('email'),
            'password' => Input::get('password')
        ];
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) {
            if (Auth::attempt($credentials))
                return Redirect::to('admin/dash-board');
            return Redirect::back()->withInput()->with('failure', 'email or password is invalid!');
        } else {
            return Redirect::back()->withErrors($validator)->withInput();
        }
    }

    // Revisado
    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('/');
    }

    
    
    
    
    
}
