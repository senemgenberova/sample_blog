@extends('layout.master')

@section('css')
    article{
        text-align:justify;
    }


    .likes{
        margin-top:15px;
        font-size: 25px;
    }

    .btn-like{
        cursor: pointer;
    }

    .add_color{
        color: #007BFF;
    }
@endsection

@section('content')


    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">{{ $post->title }}</h1>
            <h3>{{ $post->created_at->toFormattedDateString() }} </h3>
        </div>
    </div>

    <div class="row">
        <div class="container">

            <div class="row">
                <div class="col-md-4">
                    <div class="image">
                        <img src="{{asset('img/upload/' . $post->image)}}" alt="{{$post->title}}" width="100%">
                    </div>
                </div>

                <div class="col-md-8">
                    <article>
                        <b>By {{$post->user->name}} :</b> 
                        {{$post->description}} 
                    </article>
                </div>
            </div>

             <div class="likes">
                 <p>
                    <span class="like_count">{{count($post->likes)}}</span> Likes 
                    @if(Auth::check())
                        <i class="{{ is_null($user_like) ? '' : 'add_color' }} far fa-thumbs-up btn-like"></i>
                    @endif
                 </p>
             </div>

            <hr>

            <div class="comments">
                <h4>Comments</h4>
                <ul class="list-group">
                    @foreach($post->comments as $comment)
                        <li class="list-group-item">
                            <b>
                                
                                {{$comment->user->name}} :
                            </b>
                            {{ $comment->body }}
                        </li>
                    @endforeach

                </ul>
            </div>

            <br>

            @if(Auth::check())
                <div class="add_comment">
                    <form action="{{route('add_comment', $post )}}" method="post">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <textarea rows="3" class="form-control" id="post_comment" name = "comment" placeholder="Add new comment"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Comment</button>
                    </form>

                    @include('layout.errors')
                </div>
            @endif

        </div>
    </div>


@endsection

@section('js')
    <script>
        $(document).ready(function(){
            var isLiked = 0;

            if($(".btn-like").hasClass('add_color')){
                isLiked = 1;
            }
            else{
                isLiked = 0;
            }

            var user = {!! json_encode(Auth::user()) !!}, post = {!! json_encode($post) !!};

            $(".btn-like").click(function(e){;

                e.preventDefault();               

                if(isLiked == 1){
                    isLiked = 0;                  
                }
                else{
                    isLiked = 1; 
                }     

                $(this).toggleClass('add_color');  

                likePost(user,post,isLiked);
            
            });

            function likePost(user,post,isLiked){

                // console.log(user.id + ' ' + post.id + ' ' + isLiked);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    method: 'post',
                    url: '{{  route('like') }}',
                    datatype: 'json',
                    data: {
                        isLiked: isLiked,
                        post_id: post.id,
                        user_id: user.id,
                    }
                }).done(function(data){

                    console.log(data.message);

                    var count = $('.like_count').text();

                    if(isLiked == 1){
                        count++;
                    }
                    else{
                        count--;

                    }

                    console.log(count);

                    $('.like_count').text(count);

                })
            }
        });
    </script>

@endsection