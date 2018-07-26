<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

use App\Post;

class SearchController extends Controller
{
    public function results(Request $request){

        $message = "";
        $count = 0;
        $posts = [];
        $all_posts = [];

        if(!empty($request->search_str)){

            // $posts = $this->getResult($request->search_str);

            $all_posts = Post::search($request->search_str);

            $count = count($all_posts->get());

            // return $count;

            Session::put('search_str',$request->search_str);

            if($count == 0){
                $message = "No data found";
            }
            else{
                $posts = $all_posts->paginate(3);
            }          
        }
        else{
            $message = "No input entered";
        }

        return view('search.results',compact('posts','message','count')); 
    }

    public function resultsAjax(Request $request){

        $posts = Post::search(Session::get('search_str'))->paginate(3);

        // return $posts->get();
        
        if($request->ajax()){
            $view = view('post.data',compact('posts'))->render();

            return response()->json([
                'html' => $view,
                'count' => count($posts),
                'search_str' => Session::get('search_str')
            ]);
        }
    }

}
