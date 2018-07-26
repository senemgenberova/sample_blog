@extends('layout.master')

@section('content')

	<div class="jumbotron">
        <div class="container">

        	@if($message == "")

        	    <form method="post" action = "{{route('edit_post',$post)}}" enctype="multipart/form-data">

	                {{ csrf_field() }}

	                <div class="form-group">
	                    <label for="post_title">Post title</label>
	                    <input type="text" class="form-control" id="post_title" name = "title" value="{{$post->title}}">
	                </div>

	                <div class="form-group">
	                    <label for="post_cat">Post category</label>
	                    <br>
	                    <select id="post_cat" name="category" class="custom-select" >
	                        @foreach($categories as $category)
	                            <option value="{{$category->id}}" 
	                            {{
	                            	$category == $post->category ? 'selected' : ''
	                            }}
	                            >{{$category->category}}</option>
	                        @endforeach
	                    </select>
	                </div>

	                <div class="form-group">
	                    <label for="post_descr">Post description</label>
	                    <textarea rows="3" class="form-control" id="post_descr" name = "description">{{$post->description}}</textarea>
	                </div>

	                <div class="form-group">
	                	<img src="{{asset('img/upload/' . $post->image)}}" alt="{{$post->image}}" width="200">
	                	<br>
	                	<br>
	                    <label for="post_img">Post image</label>
	                    <input type="file" name="image" id="post_img" accept="image/*" >
	                </div>

	                <button type="submit" class="btn btn-primary">Edit</button>

	            </form>

            	<br>

            	@include('layout.errors')

        	@else
        		<h1>{{$message}}</h1>

        	@endif
   
        </div>
    </div>
@endsection