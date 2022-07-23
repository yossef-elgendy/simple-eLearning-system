<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/courses.js') }}" defer></script>
    <script src="{{ asset('js/profile.js') }}" defer></script>
    <script src="{{ asset('js/location_fixer.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
</head>
<body class="background-img">

    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand text-white" href="{{ url('/') }}">
                <i class="fas fa-users"></i> E-Learning
            </a>

            <div class="ml-auto mr-auto d-block d-md-none text-white">
                &copy; Youssef Elgendy
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarScroll">

                <div class="ml-auto mr-auto d-none d-md-block text-white">
                    &copy; Youssef Elgendy
                </div>

                <ul class="navbar-nav ml-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;  ">

                    <li class="nav-item">
                        <a href="{{route('aboutUs')}}" class="nav-link nav-link-hover text-white pl-2"><i class="fas fa-address-card"></i> About Us</a>
                    </li>


                    <li class="nav-item">
                        <a href="{{route('contactUs')}}" class="nav-link nav-link-hover text-white pl-2"><i class="fas fa-bug"></i> Help</a>
                    </li>
                </ul>

            </div>
        </nav>


        <nav class="navbar bg-first navbar-expand-md navbar-light">
            <div class="container">

                <button class="navbar-toggler ml-auto bg-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto ">
                        @guest
                        @else
                            <li class="nav-item">
                                <a class="nav-link nav-link-hover text-white" href="{{route('home')}}"><i class="fas fa-home"></i> Home</a>
                            </li>
                            @if(auth()->user()->role == "Teacher")
                                <li class="nav-item">
                                    <a class="nav-link nav-link-hover text-white" href="{{route('courses.create')}}"><i class="fas fa-plus-square"></i> Create Course</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-link-hover text-white" href="{{route('courses.index')}}"><i class="fas fa-paper-plane"></i> My Courses</a>
                                </li>
                            @elseif(auth()->user()->role == "Student")
                                <li class="nav-item">
                                    <a class="nav-link nav-link-hover text-white" href="{{route('enroll.index')}}"><i class="fas fa-layer-group"></i> All Courses</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link nav-link-hover text-white" href="{{route('enroll.myCourses')}}"><i class="fas fa-paper-plane"></i> My Courses</a>
                                </li>
                            @endif


                        @endguest

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto ">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link nav-link-hover text-white" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> {{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link nav-link-hover text-white" href="{{ route('register') }}"><i class="fas fa-user-plus"></i> {{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown  ">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle  text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right bg-second " aria-labelledby="navbarDropdown">
                                    <li>
                                        <a role="button" class="dropdown-item " href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                        </a>
                                    </li>

                                    <li>
                                        <a role="button" class="dropdown-item " href="{{route('profile',auth()->user()->id)}}">
                                            <i class="fas fa-cog"></i> {{ __('My Profile') }}
                                        </a>
                                    </li>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
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
