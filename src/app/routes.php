<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/* Model Bindings */
Route::model('post', 'Post');
Route::model('comment', 'Comment');
Route::model('blog', 'Blog');
Route::model('user', 'User');

/* User routes */
Route::get('/blog/{blog}/show', ['as' => 'blog.show', 'uses' => 'BlogController@showBlog']);
Route::get('/blog/post/{post}/show', ['as' => 'post.show', 'uses' => 'PostController@showPost']);

Route::get('/user/{user}/show', ['as' => 'user.show', 'uses' => 'UserController@showUser']);

Route::post('/blog/post/{post}/comment', ['as' => 'comment.new', 'uses' => 'CommentController@newComment']);

/* Admin routes */
Route::group(['prefix' => 'admin', 'before' => 'auth'], function () {
    /*get routes*/
    Route::get('/dash-board', ['as' => 'dashboard.show', 'uses' => 'UserController@showDashBoard']);
    
    Route::get('/blog/list', ['as' => 'blog.list', 'uses' => 'BlogController@listBlog']);
    Route::get('/blog/new', ['as' => 'blog.new', 'uses' => 'BlogController@newBlog']);
    Route::get('/blog/{blog}/edit', ['as' => 'blog.edit', 'uses' => 'BlogController@editBlog']);
    Route::get('/blog/{blog}/delete', ['as' => 'blog.delete', 'uses' => 'BlogController@deleteBlog']);

    Route::get('/post/list', ['as' => 'post.list', 'uses' => 'PostController@listPost']);
    Route::get('/post/new', ['as' => 'post.new', 'uses' => 'PostController@newPost']);
    Route::get('/post/{post}/edit', ['as' => 'post.edit', 'uses' => 'PostController@editPost']);
    Route::get('/post/{post}/delete', ['as' => 'post.delete', 'uses' => 'PostController@deletePost']);
    
    Route::get('/comment/list', ['as' => 'comment.list', 'uses' => 'CommentController@listComment']);
    Route::get('/comment/{comment}/show', ['as' => 'comment.show', 'uses' => 'CommentController@showComment']);
    Route::get('/comment/{comment}/delete', ['as' => 'comment.delete', 'uses' => 'CommentController@deleteComment']);
    
    Route::get('/user/edit', ['as' => 'user.edit', 'uses' => 'UserController@editUser']);
    Route::get('/user/delete', ['as' => 'user.delete', 'uses' => 'UserController@deleteUser']);
    
    /*post routes*/
    Route::post('/blog/save', ['as' => 'blog.save', 'uses' => 'BlogController@saveBlog']);
    Route::post('/blog/{blog}/update', ['as' => 'blog.update', 'uses' => 'BlogController@updateBlog']);
    
    Route::post('/post/save', ['as' => 'post.save', 'uses' => 'PostController@savePost']);
    Route::post('/post/{post}/update', ['as' => 'post.update', 'uses' => 'PostController@updatePost']);
    
    Route::post('/comment/{comment}/update', ['as' => 'comment.update', 'uses' => 'CommentController@updateComment']);
    
    Route::post('/user/update', ['as' => 'user.update', 'uses' => 'UserController@updateUser']);
    
    
});

/* Home and Blogs routes */
Route::controller('/', 'BlogController');

