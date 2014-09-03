<?php

class PostController extends BaseController
{

    /* get functions */
	// Revisado
    public function listPost()
    {  
        $user = User::find(Auth::user()->id_users);
        $blogs = $user->getBlogs()->orderBy('created_at', 'desc')->paginate(10);
        $this->layout->title = 'Post listings';
        $this->layout->subtitle = Auth::user()->username;
        $this->layout->main = View::make('dash')->nest('content', 'posts.list', compact('blogs'));
    }

    // Revisado
    public function showPost(Post $post)
    {
        $comments = $post->getComments()->where('approved', '=', 1)->get();
        $this->layout->title = $post->getBlog->title;
        $this->layout->subtitle = $post->getBlog->description;
        $this->layout->main = View::make('home')->nest('content', 'posts.single', compact('post', 'comments'));
    }

    // Revisado
    public function newPost()
    {
    	$user = User::find(Auth::user()->id_users);
    	$blogs = $user->getBlogs;
    	$blogsTmp = array();
    	foreach ($blogs as $blog){
    		$blogsTmp[$blog->id_blogs] = $blog->title;
    	}
    	$blogs = $blogsTmp;
    	$tags = Tag::all();
    	$tagsTmp = array();
    	foreach ($tags as $tag){
    		$tagsTmp[$tag->id_tags] = $tag->name;
    	}
    	$tags = $tagsTmp;
    	$this->layout->title = 'New Post';
    	$this->layout->subtitle = Auth::user()->username;
        $this->layout->main = View::make('dash')->nest('content', 'posts.new', compact('blogs','tags'));
    }

    // Revisado
    public function editPost(Post $post)
    {
        $this->layout->title = 'Edit Post';
        $this->layout->subtitle = Auth::user()->username;
        $this->layout->main = View::make('dash')->nest('content', 'posts.edit', compact('post'));
    }

    // Revisado
    public function deletePost(Post $post)
    {
        $post->delete();
        return Redirect::route('post.list')->with('success', 'Post is deleted!');
    }

    /* post functions */
    // Revisado
    public function savePost()
    {
        $post = [
            'title' => Input::get('title'),
            'blog' => Input::get('blog'),
            'summary' => Input::get('summary'),
            'content' => Input::get('content'),
            'tag' => Input::get('tag'),
        ];
        $rules = [
            'title' => 'required',
            'blog' => 'required',
            'summary' => 'required',
            'content' => 'required',
            'tag' => 'required',
        ];
        $valid = Validator::make($post, $rules);
        if ($valid->passes()) {
            $post = new Post(array('title' => $post['title'],'summary' => $post['summary'], 'content' => $post['content']));
            $post->id_blogs =  Input::get('blog');
            $post->save();
            $tag = Tag::find(Input::get('tag'));
            $post->getTags()->save($tag);
            return Redirect::to('admin/dash-board')->with('success', 'Post is saved!');
        } else
            return Redirect::back()->withErrors($valid)->withInput();
    }

    // Revisado
    public function updatePost(Post $post)
    {
        $data = [
            'title' => Input::get('title'),
            'summary' => Input::get('summary'),
            'content' => Input::get('content'),
        ];
        $rules = [
            'title' => 'required',
            'summary' => 'required',
            'content' => 'required',
        ];
        $valid = Validator::make($data, $rules);
        if ($valid->passes()) {
            $post->title = $data['title'];
            $post->summary = $data['summary'];
            $post->content = $data['content'];
            if (count($post->getDirty()) > 0) /* avoiding resubmission of same content */ {
                $post->save();
                return Redirect::back()->with('success', 'Post is updated!');
            } else
                return Redirect::back()->with('success', 'Nothing to update!');
        } else
            return Redirect::back()->withErrors($valid)->withInput();
    }

}
