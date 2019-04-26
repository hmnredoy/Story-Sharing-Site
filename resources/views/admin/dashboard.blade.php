@extends('../layout.admin.dashboard')

@section('title', 'Dashboard')

@section('rightbar')


        <!-- /. NAV SIDE  -->

    @include('inc.message')
   <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">DASHBOARD</h1>
                        <h1 class="page-subhead-line"></h1>

                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="main-box mb-red">
                            <a href="/admin/members/active">
                                <i class="fa fa-user fa-4x"></i>
                                <h5>Active Users : {{$user_count}}</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="main-box mb-dull">
                            <a href="/admin/stories/active">
                                <i class="fa fa-th-large fa-4x"></i>
                                <h5>Active Stories : {{$story_count}}</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="main-box mb-pink">
                            <a href="#">
                                <i class="fa fa-comments fa-4x"></i>
                                <h5>Comments : {{$comment_count}}</h5>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>

@endsection