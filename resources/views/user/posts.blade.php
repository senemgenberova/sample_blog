@extends('layout.master')

@section('css')

    .thumbnail{
        border: 1px solid #6C757D;
        padding: 10px;
        margin-bottom: 20px;
    }

@endsection


@section('content')

    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">My posts</h1>
        </div>
    </div>

      <div class="container">
        <!-- Example row of columns -->
            <div class="row">

                @foreach($user->posts as $post)
                    @include('post.single_post')
                @endforeach

            </div> <!-- /container -->
      </div>

@endsection