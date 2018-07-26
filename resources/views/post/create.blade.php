@extends('layout.master')

@section('css')
    #post_cat{
        width: 250px;
    }

@endsection

@section('content')

    <div class="jumbotron">
        <div class="container">
            <form method="post" action = "/post" enctype="multipart/form-data">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="post_title">Post title</label>
                    <input type="text" class="form-control" id="post_title" name = "title" value="{!! old('title') !!}">
                </div>

                <div class="form-group">
                    <label for="post_cat">Post category</label>
                    <br>
                    <select id="post_cat" name="category" class="custom-select" >
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->category}}</option>
                        @endforeach
                    </select>
                </div>

                 <div class="form-group">
                    <label for="post_descr">Post description</label>
                    <textarea rows="3" class="form-control" id="post_descr" name = "description" ></textarea>
                </div>

                <div class="form-group">
                    <label for="post_img">Post image</label>
                    <input type="file" name="image" id="post_img" accept="image/*" >
                </div>

                <button type="submit" class="btn btn-primary">Create</button>

            </form>

            <br>

            @include('layout.errors')
   
        </div>
    </div>

@endsection
