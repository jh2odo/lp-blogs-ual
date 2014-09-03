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
    
    /////////////////////////////////
    
    
    /* get functions */
    
    // Revisado
    public function listBlog()
    {
    	$user = User::find(Auth::user()->id_users);
    	$blogs = $user->getBlogs()->orderBy('id_blogs', 'desc')->paginate(10);
    	$this->layout->title = 'Blogs listings';
    	$this->layout->subtitle = Auth::user()->username;
    	$this->layout->main = View::make('dash')->nest('content', 'blogs.list', compact('blogs'));
    }
    
    
    // Revisado
    public function showBlog(Blog $blog)
    {
    	$posts = $blog->getPosts()->orderBy('id_posts', 'desc')->paginate(10);
    
    	$posts->getFactory()->setViewName('pagination::simple');
    	$this->layout->title = $blog->title . ' of ' . $blog->getUser->username;
    	$this->layout->subtitle = $blog->description;
    	$this->layout->main = View::make('home')->nest('content', 'blogs.single', compact('posts'));
    }
    
    // Revisado
    public function newBlog()
    {
    	$this->layout->title = 'New Blog';
    	$this->layout->subtitle = Auth::user()->username;
    	$this->layout->main = View::make('dash')->nest('content', 'blogs.new');
    }
    
    // Revisado
    public function editBlog(Blog $blog)
    {
    	$this->layout->title = 'Edit Blog';
    	$this->layout->subtitle = Auth::user()->username;
    	$this->layout->main = View::make('dash')->nest('content', 'blogs.edit', compact('blog'));
    }
    
    // Revisado
    public function deleteBlog(Blog $blog)
    {
    	$blog->delete();
    	return Redirect::route('blog.list')->with('success', 'Blog is deleted!');
    }
    
    /* post functions */
    // Revisado
    public function saveBlog()
    {
    	$blog = [
    	'title' => Input::get('title'),
    	'description' => Input::get('description'),
    	];
    	$rules = [
    	'title' => 'required',
    	'description' => 'required',
    	];
    	$valid = Validator::make($blog, $rules);
    	if ($valid->passes()) {
    		$user = User::find(Auth::user()->id_users);
    		$blog = new Blog($blog);
    		$blog->id_users = $user->id_users;
    		$blog->save();
    		return Redirect::to('admin/dash-board')->with('success', 'Blog is saved!');
    	} else
    		return Redirect::back()->withErrors($valid)->withInput();
    }
    
    // Revisado
    public function updateBlog(Blog $blog)
    {
    	$data = [
    	'title' => Input::get('title'),
    	'description' => Input::get('description'),
    	];
    	$rules = [
    	'title' => 'required',
    	'description' => 'required',
    	];
    	$valid = Validator::make($data, $rules);
    	if ($valid->passes()) {
    		$blog->title = $data['title'];
    		$blog->description = $data['description'];
    		if (count($blog->getDirty()) > 0) /* avoiding resubmission of same content */ {
    			$blog->save();
    			return Redirect::back()->with('success', 'Blog is updated!');
    		} else
    			return Redirect::back()->with('success', 'Nothing to update!');
    	} else
    		return Redirect::back()->withErrors($valid)->withInput();
    }
    

}
