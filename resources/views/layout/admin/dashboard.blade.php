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
    <script type="text/javascript" src="{{ URL::asset('js/custom.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

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
                <a class="navbar-brand" href="/dashboard/admin">
                   Admin Panel
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
                            <img src="/images/admin.png" class="img-thumbnail" />
                            <br>
                            <div class="inner-text pull-left">
                                <label>{{ Session::get('userInfo')->name }}</label>
                            </div>
                        </div>

                    </li>


                    <li>
                        <a href="/"><i class="fa fa-home "></i>Home</a>
                    </li>
                    <li>
                        <a class="{{ Route::currentRouteNamed('admin.dashboard') ? 'active-menu' : '' }}" href="/dashboard/admin"><i class="fa fa-dashboard "></i>Dashboard</a>
                    </li>
                    <li>
                        <a class="{{ Route::currentRouteNamed('admin.profile') ? 'active-menu' : '' }}" href="/admin/profile/{{Session::get('userInfo')->id}}"><i class="fa fa-th-large"></i>Profile</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-users"></i>Manage Members<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                           
                             <li>
                                <a class="{{ Route::currentRouteNamed('member.active') ? 'active-menu' : '' }}" href="/admin/members/active"><i class="fa fa-user"></i>Active Members</a>
                            </li>
                             <li>
                                <a class="{{ Route::currentRouteNamed('member.inactive') ? 'active-menu' : '' }}" class="{{ Route::currentRouteNamed('admin.profile') ? 'active-menu' : '' }}" href="/admin/members/inactive"><i class="fa fa-user-times"></i>Inactive Members</a>
                            </li>
                            <li>
                                <a class="{{ Route::currentRouteNamed('member.blocked') ? 'active-menu' : '' }}" href="/admin/members/blocked"><i class="fa fa-ban"></i>Blocked Members</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-paste"></i>Manage Stories<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                           
                             <li>
                                <a class="{{ Route::currentRouteNamed('stories.active') ? 'active-menu' : '' }}" href="/admin/stories/active"><i class="fa fa-check-circle"></i>Active Stories</a>
                            </li>
                             <li>
                                <a class="{{ Route::currentRouteNamed('stories.unlisted') ? 'active-menu' : '' }}" href="/admin/stories/unlisted"><i class="fa fa-minus-circle"></i>Inactive/Unlisted</a>
                            </li>
                           
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-user-secret"></i>Manage Admins<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a class="{{ Route::currentRouteNamed('admin.create') ? 'active-menu' : '' }}" href="/admin/create/new"><i class="fa fa-user-plus"></i>Create Admin</a>
                            </li>
                            <li>
                                <a class="{{ Route::currentRouteNamed('admin.manage') ? 'active-menu' : '' }}" href="{{route('admin.manage')}}"><i class="fa fa-id-card-o"></i>Existing Admins</a>
                            </li>
                        </ul>
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

