<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

use App\Comment;


class CommentController extends Controller
{
    public function store(Post $post){

        $this->validate(request(),[
            'comment' => 'required'
        ]);
        
        Comment::create([
            'body' => request('comment'),
            'post_id' => $post->id,
            'user_id' => auth()->user()->id
        ]);

        // return $post->id;
        return back();
    }
}
