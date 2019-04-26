<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Story Sharing Site - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#03a6f3">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Old+Standard+TT:400,400i,700|Raleway:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">

    <!-- BOOTSTRAP STYLES-->
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="{{asset('assets/css/font-awesome.css')}}" rel="stylesheet" />
    <!--CUSTOM BASIC STYLES-->
    <link href="{{asset('assets/css/basic.css')}}" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" />
    <link href="{{asset('css/bootstrap_custom.css')}}" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    
<link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
</head>

<body>
    <header>
        <div class="header-top"></div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>

            <div class="collapse navbar-collapse">
                <div class="nav-sec">
                    <div class="container">

                        <ul class="nav">
                            <div class="pull-left">
                               <li class="nav-item">
                                <a style="font-family: 'Pacifico', cursive; color: #333; font-size: 1.9em;" href="/">Story Sharing Site</a>
                                </li> 
                            </div>
                            <div class="pull-right">
                                <li class="nav-item search-sec">
                       
                                    <div class="topnav">
                                        <div class="search-container">
                                        <form role="search" method="GET" action="/search">
                                            @csrf
                                          <input type="text" placeholder="Search.." name="search">
                                          <button type="submit"><i class="fa fa-search"></i></button>
                                        </form>
                                        </div>
                                    </div>
                                </li>
                            
                            @if(session('userInfo'))
                                <li class="nav-item">
                                    <a class="nav-link"
                                        @if(session('userInfo')->user_type == 'admin')
                                            href="/dashboard/admin"
                                        @elseif(session('userInfo')->user_type == 'member')
                                            href="/dashboard"
                                        @endif
                                    
                                    >Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/logout">Logout</a>
                                </li>
                                @else

                                <li class="nav-item">
                                    <a class="nav-link" href="/registration">Registration</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/login">Login</a>
                                </li> 

                            @endif  
                            </div>

                        </ul>    
                    </div>
                            
                        
                </div>
            </div>
    

    </header>
    <!-- Main body sec -->


    @yield('content')

    <footer style="background-color: #464646;">
    <div class="container">
        <h5 style=" color: #f2f2f2; ">(C) 2019. Developed by <a style=" color: #f2f2f2; " href="http://facebook.com/hmnredoy">Nazmuzzaman Redoy</a></h5>
    </div>
    </footer>
    
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>

</body>

</html>