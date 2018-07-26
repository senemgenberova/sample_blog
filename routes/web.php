<?php


Route::get('/','PostsController@index')->name('home');

Route::prefix('/post')->group(function(){
	Route::get('create','PostsController@create')->name('create_post');

	Route::get('{post}','PostsController@show')->name("showPost");

	Route::post('{post}/comment','CommentController@store')->name('add_comment');

	Route::post('','PostsController@store');

});

// Route::get('/post/create','PostsController@create')->name('create_post');

// Route::post('/post','PostsController@store');

// Route::get('/post/{post}','PostsController@show')->name("showPost");

// Route::post('/post/{post}/comment','CommentController@store')->name('add_comment');

Route::get('/{user}/posts','UserController@allPosts')->name('user_posts');

Route::get('/category/{category}','CategoryController@category_posts')->name('category');

Route::get('/{user}/{post}/edit','PostsController@edit')->name('edit');

Route::post('/{post}/edit','PostsController@editPost')->name('edit_post');

Route::post('/{post}/delete','PostsController@deletePost')->name('delete_post');

Route::get('/results','SearchController@results')->name("search_results");

Route::get('/resultsAjax','SearchController@resultsAjax')->name("resultsAjax");

Route::post('/like','PostsController@likePost')->name('like');

Route::get('/verify/{token}','UserVerificationController@verifyUser')->name('verify_user');

Auth::routes();

