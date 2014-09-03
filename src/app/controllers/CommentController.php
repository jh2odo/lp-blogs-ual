<?php

use Illuminate\Support\Facades\Auth;
class CommentController extends BaseController
{

    /* get functions */
	// Revisado
    public function listComment()
    {
    	// Fallo en Comments, mal solucionado
    	$user = User::find(Auth::user()->id_users);
    	$blogs = $user->getBlogs()->orderBy('created_at', 'desc')->paginate(10);
    	$comments;
    	foreach($blogs as $blog){
    		foreach($blog->getPosts as $post){
    				$comments[] = $post->getComments;
    		}
    	}
    	
    	//$comments = Comment::orderBy('id_comments', 'desc')->paginate(20);
        $this->layout->title = 'Comment Listings';
        $this->layout->subtitle = Auth::user()->username;
        $this->layout->main = View::make('dash')->nest('content', 'comments.list', compact('comments'));
    }

    // Revisado
    public function newComment(Post $post)
    {
        $comment = [
            'content' => Input::get('content')
        ];
        $rules = [
            'content' => 'required',
        ];
        $valid = Validator::make($comment, $rules);
        if ($valid->passes()) {
            $comment = new Comment($comment);
            $comment->approved = 'no';
            $comment->id_users = Auth::user()->id_users;
            $post->getComments()->save($comment);
            /* redirect back to the form portion of the page */
            return Redirect::to(URL::previous() . '#reply')
                ->with('success', 'Comment has been submitted and waiting for approval!');
        } else {
            return Redirect::to(URL::previous() . '#reply')->withErrors($valid)->withInput();
        }
    }

    // Revisado
    public function showComment(Comment $comment)
    {
        if (Request::ajax())
            return View::make('comments.show', compact('comment'));
        // handle non-ajax calls here
        //else{}
    }

    // Revisado
    public function deleteComment(Comment $comment)
    {
        $post = $comment->post;
        $comment->delete();
        return Redirect::back()->with('success', 'Comment deleted!');
    }

    /* post functions */
    // Revisado
    public function updateComment(Comment $comment)
    {
        $comment->approved = Input::get('status');
        $comment->save();
        return Redirect::back()->with('success', 'Comment ' . (($comment->approved === 'yes') ? 'Approved' : 'Disapproved'));
    }

}