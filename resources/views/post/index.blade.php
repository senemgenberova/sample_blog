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

    .order{
        margin-bottom: 10px;

    }

    .sort{
        float: right;
        font-size: 20px;
        margin-right: 20px;
    }

@endsection


@section('content')

<div class="jumbotron">
    <div class="container">
        <h1 class="display-3">All Posts</h1>
    </div>
</div>

<div class="container">

    <div class="row" >
        <div class="col-md-10">
            @include('post.data')   
            
            <div id="load_more"></div>

        </div>


        <div class="col-md-2">
            @if($count != 0)
            <div class="dropdown order">
                <button class="btn btn-primary dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Order by</button>

                <div id="menu" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{route('home',['orderBy' => 'created_at','order' => 'asc'])}}">Oldest</a>
                    <a class="dropdown-item" href="{{route('home',['orderBy' => 'created_at','order' => 'desc'])}}">Newest</a>
                    <a class="dropdown-item" href="{{route('home',['orderBy' => 'title','order' => 'asc'])}}">A-Z</a>
                    <a class="dropdown-item" href="{{route('home',['orderBy' => 'title','order' => 'desc'])}}">Z-A</a>
                    <a class="dropdown-item" href="{{route('home',['orderBy' => 'like','order' => 'desc'])}}">Most Popular</a>
                    <a class="dropdown-item" href="{{route('home',['orderBy' => 'like','order' => 'asc'])}}">Less Popular</a>
                </div>
            </div>
            @endif
            
            <div class="list-group">
                @foreach($categories as $category)
                    <a href="{{  route('category',$category) }}" class="list-group-item">{{ $category->category}} </a>             
                @endforeach
            </div>
        </div>
    </div>

</div>


@if($count > 3)
    <div class="row">
        <div class="container">
            <div class = "btn_load">
                <button type="button" class="btn btn-primary" id="load_data">Load more</button>       
            </div>
        </div>    
    </div> 
@endif

@endsection

@section('js')

    <script>
        $(document).ready(function(){

            $('#delete_button').click(function(e){
                if(confirm('Are you sure to delete this post?')){
                    $('#delete_post').submit();
                    console.log('post deleted');
                }
                else{
                    //cancel deleting
                    e.preventDefault();
                    console.log('delete cancelled');
                }   
            });


            var url = new URL(window.location.href);

            var orderBy = url.searchParams.get('orderBy') , order = url.searchParams.get('order');

            var page = 2, count = 3;

            if(url.search != ""){
                $('#menu a').each(function(){
                    if($(this).attr('href').includes(url.search) ){
                        $('#dropdownMenuButton').text($(this).text());
                    }
                });
            }

            $('#load_data').click(function(){
                $.ajax({
                    type: 'GET',
                    url: '?page=' + page + '&orderBy=' + orderBy + '&order=' + order,
                    datatype: 'json'

                }).done(function(data){

                    page++; 
                    
                    if(data.html.length != 0){
                        $('#load_more').append(data.html);  
                        count += data.count;

                        
                        if(count == {{$count}}){
                            $('#load_data').hide();
                        }
                    }

                }).fail(function(){
                    alert('Server failed to response');
                });
            });
        });
    </script>

@endsection