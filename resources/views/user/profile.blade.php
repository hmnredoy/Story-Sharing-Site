@extends('../layout.user.dashboard')

@section('title', 'Profile')

@section('rightbar')


<script src="{{asset('js/custom.js')}}"></script>

<!-- /. NAV SIDE  -->
<div id="page-wrapper">
    <div id="page-inner">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Member Details
                   <div class="card-body pull-right">
                      <a href="/dashboard" class="btn btn-secondary btn-lg"><i class="fa fa-arrow-left"></i></a>
                   </div>
                </div>

                @include('inc.message')
                <div class="panel-body">

                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body pull-right">
                        
                            <a href="/profile/{{$user_id}}/edit" type="button" class="btn btn-dark btn-lg">Edit&nbsp;&nbsp;<i class="fa fa-pencil-square-o"></i></a>

                        </div>
                        <div class="card" style="width: 100%;">
                            <img src="/images/{{$userInfo->avatar}}" style="width: 200px;" class="card-img-top img-rounded" alt="User Profile Picture">
                        <div class="card-body">
                            <strong>Stories Posted</strong>
                                <span class="card-text badge">{{$stories}}</span>
                        </div>
                        
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Name : <strong>{{$userInfo->name}}</strong></li>
                            <li class="list-group-item">Gender : <strong>{{$userInfo->gender}}</strong></li>
                            <li class="list-group-item">DOB : <strong>{{$userInfo->dob}}</strong></li>
                            <li class="list-group-item">Phone : <strong>{{$userInfo->phone}}</strong></li>
                            <li class="list-group-item">Email : <strong>{{$userInfo->email}}</strong></li>
                            <li class="list-group-item">Join Date : <strong>To Be Implemented</strong></li>
                            <li class="list-group-item">Active Status : 
                                <form method="post" action="/profile/{{$user_id}}/deactivate" style="display: inline;">
                                <input type="hidden" name="_method" value="put">
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{$user_id}}">
                                <div class="label label-success">{{$userInfo->active_status}}</div>
                                <div class="pull-right">
                                <input type="hidden" name="active_status" value="inactive">
                                <input class="btn btn-danger" type="submit" value="Deactivate">
                                </div>
                                </form>
                            </li>
                            
                          </ul>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  
@endsection