<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

class CategoryController extends Controller
{
    public function category_posts(Category $category){

    	if(count($category->posts) == 0){
    		abort(404);
    	}

    	$categories = Category::all()->filter(function($c){
    		return count($c->posts) != 0;
    	});    	

    	$posts = $category->posts()->paginate(3);

    	return view('category.category_posts', compact('posts','category','categories'));
    }
}
