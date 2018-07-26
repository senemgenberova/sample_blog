<div class="col-sm-6 col-md-4">
    <div class="thumbnail" >

        <img src="{{ asset('img/upload/' . $post->image)}}" alt="{{$post->title}}" width="100%" height="250px">

        <div class="caption">
            <h4>{{str_limit($post->title,20)}}</h4>

            <h6>
                <span style = "color:#007ACC; text-transform: capitalize;">{{$post->user->name}}</span>&nbsp;,on&nbsp; 
                {{ $post->created_at->toFormattedDateString() }}
            </h6>

            <h6>
                Category: <a href="{{  route('category',$post->category) }}"> {{$post->category->category}} </a>
            </h6>

            <p style = "text-align:justify"> {{str_limit($post->description,50)}} 
                <a href="{{route('showPost', $post)}}" >Read more &raquo;</a>
            </p>

            @if(Auth::check())
                @if($post->user == Auth::user())
                    <hr>
                    <a id="edit" class="btn btn-primary" href="{{route('edit',['user' => Auth::user(), 'post' => $post])}}">Edit</a>

                    <form id="delete_post" action="{{route('delete_post',$post)}}" method="post">
                        @csrf
                        <button id="delete_button" type="submit" class="btn btn-primary">Delete</button>
                    </form>
                @endif
            @endif
        </div>
    </div>
</div>