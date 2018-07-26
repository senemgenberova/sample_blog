<!doctype html>
<html lang={{ app()->getLocale() }}>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="_token" content="{{csrf_token()}}" />
    <title>Jumbotron Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <style>
        body {
            padding-top: 3.5rem;
            overflow-x:hidden;
        }

        p{
          margin-bottom: 0;
        }

        .copyright{
          margin-bottom: 10px;
        }

        #edit{
          float: left;
          margin-right: 10px;
          clear: both;
        }
        
       /* .bg-dark{
          background: {{Cookie::get('navbar_color')}} !important;
        }*/

        @yield('css')
    </style>
  </head>

  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      @if(Auth::check())
          <h1 class="navbar-brand" >Welcome, {{ Auth::user()->name}}</h1>
      @endif

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav">
          <li class="nav-item {{Request::is('/') ? 'active' : ''}}">
            <a class="nav-link" href="/">Posts <span class="sr-only">(current)</span></a>
          </li>
          @guest
            <li><a class="nav-link @include('layout.active',[ 'route_name' => 'login'])" href="{{ route('login') }}">{{ __('Login') }}</a></li>

            <li><a class="nav-link @include('layout.active', ['route_name' => 'register' ])" href="{{ route('register') }}">{{ __('Register') }}</a></li>
          @else
            <li class="nav-item @include('layout.active',[ 'route_name' => 'create_post'])">
                <a class="nav-link" href="{{ route('create_post') }}">New post </a>
            </li>
            <li class="nav-item @include('layout.active',[ 'route_name' => 'user_posts'])">
              <a class="nav-link" href="{{ route('user_posts', Auth::user())}}">My posts</a>
            </li>

            <li class="nav-item">

              <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
              </form>
            </li>
          @endguest
        </ul>

        <div class="dropdown color_selection">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton color_name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Select color
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{ route('home')}}" style="color: #DD5044">Red</a>
            <a class="dropdown-item" href="{{ route('home')}}" style="color: #17A05D">Green</a>
            <a class="dropdown-item" href="{{ route('home')}}" style="color: #1C79A2">Blue</a>
            <a class="dropdown-item" href="{{ route('home')}}" style="color: #FFCE43">Yellow</a>
          </div>
        </div>


        <form method="get" action="{{route('search_results')}}" class="navbar-form ml-auto" role="search">
          <!--@csrf-->
          <div class="input-group">
              <input type="search" class="form-control" placeholder="Search" name="search_str" id="search_str">
              <div class="input-group-btn">
                  <button class="btn btn-default" type="submit"><i class="fas fa-search"></i></button>
              </div>
          </div>
        </form>
      </div>
    </nav>

    <main role="main">
        @yield('content')
    </main>

        <hr>

    <footer class="container">
      <p class="copyright">&copy; Company {{now()->year}}</p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <!--<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>-->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

    <script>

      $(document).ready(function(){

        $('.color_selection .dropdown-menu a').each(function(){

            // console.log($(this).css('color') == Cookies.get('navbar_color'))

          if(Cookies.get('navbar_color') != null){
            if($(this).css('color') == Cookies.get('navbar_color')){
              $('.color_selection #color_name').text($(this).text());
            }
          }

          $(this).click(function(){
  
            Cookies.set('navbar_color',$(this).css('color'));

          })
        });


        $('nav.navbar').css('cssText','background:'+ Cookies.get("navbar_color")+' !important');

      });

    </script>

    @yield('js')
  </body>
</html>