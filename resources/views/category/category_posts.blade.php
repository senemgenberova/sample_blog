@extends('layout.master')

@section('css')

    .btn_load{
        text-align:center;
        margin: 50px 0;
    }

    .thumbnail{
        border: 1px solid #6C757D;
        padding: 10px;
        margin-bottom: 20px;
    }

@endsection


@section('content')



<div class="jumbotron">
    <div class="container">
        <h1 class="display-3">Category results for '{{$category->category}}'</h1>
    </div>
</div>

<div class="container">

    <div class="row" >
        <div class="col-md-10">
			<div class="row">
					@foreach($posts as $post)
	                    @include('post.single_post')
	                @endforeach               

                <div class="col-md-12">
                    {{ $posts->links()}}
                </div>
			</div>     

      	</div>  
            
        <div class="col-md-2">
            <div class="list-group">
                @foreach($categories as $category)
                    <a href="{{  route('category',$category) }}" class="list-group-item">{{ $category->category}} </a>             
                @endforeach
            </div>
        </div>
    </div>



</div>

@endsection