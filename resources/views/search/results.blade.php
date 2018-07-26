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
        <h1 class="display-3">Results for '{{trim(request()->search_str)}}'</h1>
    </div>
</div>

<div class="container">

    <div  id = "search_results">

        @if(!empty(request()->search_str))
            @if($count != 0)
                @include('post.data')
            @else
            <div >
                <h2>{{ $message }}</h2>
            </div>               

            @endif             

        @else
            <div >
                <h2>{{ $message }}</h2>
            </div>

        @endif

    </div>

    <div id="load_more"></div>

    @if($count  > 3)
    <div class="row">
        <div class="container">
            <div class = "btn_load">
                <button type="button" class="btn btn-primary" id="load_data">Load more</button>       
            </div>
        </div>    
    </div> 
    @endif


</div>

@endsection

@section('js')

    <script>
        $(document).ready(function(){
            var page = 2, count = 3;

            $('#load_data').click(function(){
                $.ajax({
                    type: 'GET',
                    url: '/resultsAjax?page=' + page,
                    datatype: 'json'

                }).done(function(data){
                    page++;    
                    console.log(data.search_str) 
                    
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