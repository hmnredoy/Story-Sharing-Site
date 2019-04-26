@extends('../layout.user.dashboard')

@section('title', 'Dashboard')

@section('rightbar')


        <!-- /. NAV SIDE  -->

    
   <div id="page-wrapper">
            <div id="page-inner">
            	@include('inc.message')
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">DASHBOARD</h1>
                        <h1 class="page-subhead-line"> </h1>

                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="main-box mb-red">
                            <a href="#">
                                <i class="fa fa-user fa-4x"></i>
                                <h5>Stories Posted : {{$total_stories}}</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="main-box mb-dull">
                            <a href="#">
                                <i class="fa fa-th-large fa-4x"></i>
                                <h5>Story Comments : {{$total_comments}}</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="main-box mb-pink">
                            <a href="#">
                                <i class="fa fa-eye fa-4x"></i>
                                <h5>Total Views : TBI</h5>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>

@endsection