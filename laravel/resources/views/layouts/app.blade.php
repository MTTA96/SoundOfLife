<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Sound Of Life</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          Sound Of Life
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent" >
          <!-- Left Side Of Navbar -->
          <!--<ul class="navbar-nav mr-auto">
          <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
        </ul>-->

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          <!-- Authentication Links -->

          <!-- If user is havent log on -->
          @guest
          <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
          <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
          <!-- If user is log on -->
          @else
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position:relative; padding-left:50px" v-pre>
              <img src="/storage/Avatar/{{ Auth::user()->avatar_img }}" style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%">
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <!-- Still dont fully understand this part -->
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('info',[Auth::user()->name]) }}"
                onclick="event.preventDefault();
                document.getElementById('info-form').submit();">
                {{ __('Acount Info') }}
              </a>
              <form id="info-form" action="{{ route('info',[Auth::user()->name]) }}" style="display: none;">
                @csrf
              </form>
              <a class="dropdown-item" href = "{{ route('songlist',[Auth::user()->id]) }}">Manage Songs</a>
              <a class="dropdown-item"href="{{ route('insert') }}"> Add New Song</a>
              <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>

          </div>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

<main class="py-4">
  @yield('content')
</main>
</div>
</body>
</html>
