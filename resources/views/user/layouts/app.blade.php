<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logo.jpg') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

   
    <!-- Sweet Alert 2 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar position-fixed w-100 top-0 navbar-expand-md navbar-dark bg-primary shadow-sm" style="z-index: 5">
            <div class="container">
                <a class="h1 navbar-brand" style="font-size:25px;font-weight:bolder;" href="{{ route('home',['en']) }}">
                    Blog
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        <!-- Authentication Links -->
                        @guest  
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }} {{ Request::is('en') ? 'active' : '' }} {{ Request::is('my') ? 'active' : '' }}">{{ __('nav.home') }}</a>
                            </li>                         
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="{{ route('login') }}">{{ __('nav.login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('register') ? 'active' : '' }}" href="{{ route('register') }}">{{ __('nav.register') }}</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle"  href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('nav.language') }}
                                </a>
                                <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                                    <a href="{{ route('home','en') }}" class="dropdown-item {{ Request::is('en') ? 'active' : '' }}">English</a>
                                    <a href="{{ route('home','my') }}" class="dropdown-item {{ Request::is('my') ? 'active' : '' }}">Myanmar</a>
                                </div> 
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link  {{ Request::is('/') ? 'active' : '' }} {{ Request::is('en') ? 'active' : '' }} {{ Request::is('my') ? 'active' : '' }}">{{ __('nav.home') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('product.create') }}" class="nav-link {{ Request::is('product/create') ? 'active' : '' }}">{{ __('nav.product-create') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('profile.index',Auth::id()) }}" class="nav-link {{ Request::is('user/profile*') ? 'active' : '' }}">{{ __('nav.user-profile') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle {{ Request::is('profile*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if(Auth::user()->images()->exists())
                                    <img width="40px" height="40px" class=" user-profile-img rounded-circle" style="margin-right: 10px" src="{{ asset(Auth::user()->images[0]->path) }}" alt="User Photo">
                                    @else
                                    <img width="40px" height="40px" class="user-profile-img rounded-circle" style="margin-right: 10px" src="{{ asset('img/user.png') }}" alt="User Photo">                                   
                                    @endif
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                                    <a href="{{ route('profile.show', Auth::id()) }}" class="dropdown-item {{ Request::is('profile/show*') ? 'active' : '' }}">{{ __('nav.profile') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('nav.logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>    
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle"  href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Language
                                </a>
                                <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                                    <a href="{{ route('home','en') }}" class="dropdown-item {{ Request::is('en') ? 'active' : '' }} ">English</a>
                                    <a href="{{ route('home','my') }}" class="dropdown-item {{ Request::is('my') ? 'active' : '' }}">Myanmar</a>
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
    @stack('js')
</body>
</html>
