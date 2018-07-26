<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

use App\Like;

use App\Category;

use App\User;

use Cookie;

use DB;

use File;

class PostsController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->except(['index','show']);
    }

    public function index(){

        // Cookie::queue('navbar_color','');

        $orders = ['created_at','title'];

        $categories = Category::all()->filter(function($c){
            return count($c->posts) != 0;
        });

        $count = count(Post::all());

        $posts = Post::latest();

        if(request()->has('orderBy')){
            foreach ($orders as $order) {
                if(request('orderBy') == $order){
                    if(request()->has('order')){
                        $posts = Post::orderBy($order,request('order'));
                    }
                    else{
                        $posts = Post::orderBy($order,'desc');
                    }
                }
            }

            if(request('orderBy') == 'like'){
                if(request()->has('order')){
                    $posts = Post::withCount('likes')->orderBy('likes_count', request('order'));
                }
                else{
                    $posts = Post::withCount('likes')->orderBy('likes_count','desc');
                }
            }
        }

        $posts = $posts->paginate(3);


        if(request()->ajax()){
            $view = view('post.data',compact('posts'))->render(); 

            return response()->json([
                'html' => $view,
                'count' => count($posts)
                ]);
        }

        return view('post.index', compact('posts','count','categories'));
    }

    public function show(Post $post){

        $user_like = Like::where([
            ['user_id' , auth()->id()],
            ['post_id' , $post->id],
            ['isLiked', 1]
        ])->first();

        // var_dump(is_null($existing_like));

        return view('post.show', compact('post','user_like'));
    }

    public function create(){
        $categories = Category::all();

        return view('post.create', compact('categories'));
    }

    public function store(){

        $this->validate(request(),[
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:png,jpeg,jpg',
            'category' => 'required'
        ]);
        
        if(request()->hasFile('image')){

            $folder_path = public_path() . '\img\upload\\';
            $image = now()->toDateString() . '_' . request('image')->getClientOriginalName();

            request('image')->move($folder_path,$image);

        }   


        Post::create([
            'title' => request('title'),
            'description' => request('description'),
            'user_id' => auth()->user()->id,
            'image' => $image,
            'title_slug' => str_slug(request('title'),'-'),
            'category_id' => request('category') 
        ]);

        return redirect('/');

    }

    public function likePost(Request $request){

        //if post has like update like else create new like
        $message = '';

        $existing_like = Like::where([
            ['user_id' , $request->user_id],
            ['post_id' , $request->post_id]
        ])->first();

        if(is_null($existing_like)){
            //like post

            Like::create([
                'user_id' => $request->user_id,
                'post_id' => $request->post_id,
                'isLiked' => $request->isLiked
            ]);

            $message = 'new Like';
        }
        else{
            //update like of post

            // $existing_like->isLiked = $request->isLiked;

            $existing_like->delete();

            $message = 'deleted Like';
        }


        if(request()->ajax()){

            return response()->json([
                'message' => $message
            ]);
        }
    }

    public function edit(User $user, Post $post){

        $message = "";
        $categories = Category::all();

        $user = auth()->user();

        if($post->user != $user){
            $message = "Such post not found";
        }

        return view('post.edit',compact('post','user','categories','message'));
    }

    public function editPost(Post $post){

        $this->validate(request(),[
            'title' => 'required',
            'description' => 'required',
            'category' => 'required'
        ]);

        $post->title = request('title');

        $post->category_id = request('category');

        $post->description = request('description');

        $post->title_slug = str_slug(request('title'));


        if(request()->hasFile('image')){
            $folder_path = public_path() . '\img\upload\\';
            $image = now()->toDateString() . '_' . request('image')->getClientOriginalName();

            File::delete($folder_path . $post->image);

            request('image')->move($folder_path,$image);

            $post->image = $image;
        }

        $post->save();

        return redirect('');

    }

    public function deletePost(Post $post){

        $folder_path = public_path() . '\img\upload\\';

        $post->delete();

        File::delete($folder_path . $post->image);

        return back();
    }

    
}
