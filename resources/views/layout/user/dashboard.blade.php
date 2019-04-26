<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Story - @yield('title')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 
    <!-- BOOTSTRAP STYLES-->
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="{{asset('assets/css/font-awesome.css')}}" rel="stylesheet" />

    <link href="{{asset('assets/css/fontawesome.css')}}" rel="stylesheet" />
       <!--CUSTOM BASIC STYLES-->
    <link href="{{asset('assets/css/basic.css')}}" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" />

     <link href="{{asset('css/bootstrap_custom.css')}}" rel="stylesheet" />

   
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

  
    <!--Custom-->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet" />

</head>
<body>

 <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
                   Story Sharing Site
                </a>
            </div>

            <div class="header-right">
                <a href="/logout" class="btn btn-danger" title="Logout"><i class="fa fa-sign-out fa-2x"></i></a>

            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div">
                        @if(file_exists(public_path("/images/{{Session::get('userInfo')->avatar}}")))
                            <img src="/images/{{Session::get('userInfo')->avatar}}" alt="Profile" class="img-thumbnail text-center">
                        @else
                            <img src="/images/{{Session::get('userData')->avatar}}"  alt="Profile" class="img-thumbnail text-center">
                        @endif


                            <br>
                            <div class="inner-text pull-left">
                                <label class="text-center">{{Session::get('userInfo')->name}}</label>
                            </div>
                        </div>

                    </li>


                    <li>
                        <a href="/"><i class="fa fa-home "></i>Home</a>
                    </li>
                    <li>
                        <a class="{{ Route::currentRouteNamed('user.dashboard') ? 'active-menu' : '' }}" href="/dashboard"><i class="fa fa-dashboard "></i>Dashboard</a>
                    </li>
                    <li>
                        <a class="{{ Route::currentRouteNamed('user.profile') ? 'active-menu' : '' }}" href="/profile/{{Session::get('userInfo')->id}}"><i class="fa fa-th-large"></i>Profile</a>
                    </li>
                    <li>
                        <a class="{{ Route::currentRouteNamed('story.create') ? 'active-menu' : '' }}" href="/story/new/create"><i class="fa fa-th-large"></i>Create New Story</a>
                    </li>
                     <li>
                        <a class="{{ Route::currentRouteNamed('stories') ? 'active-menu' : '' }}" href="/stories"><i class="fa fa-user-circle"></i>Manage Existing Stories</a>
                    </li>
                </ul>

            </div>

        </nav>
        <!--Right Sidebar Starts-->

        @yield('rightbar')

    
        <!--Right Sidebar Ends-->


        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->

    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="{{asset('assets/js/bootstrap.js')}}"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="{{asset('assets/js/jquery.metisMenu.js')}}"></script>
       <!-- CUSTOM SCRIPTS -->
    <script src="{{asset('assets/js/custom.js')}}"></script>

    <script src="{{asset('js/time.js')}}"></script>
    



</body>
</html>

