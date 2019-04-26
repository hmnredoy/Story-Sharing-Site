@extends('../layout.admin.dashboard')

@section('title', 'Profile')

@section('rightbar')


<!-- /. NAV SIDE  -->
<div id="page-wrapper">
    <div id="page-inner">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Profile Details
                   <div class="card-body pull-right">
                      <a href="/dashboard/admin" class="btn btn-secondary btn-lg"><i class="fa fa-arrow-left"></i></a>
                   </div>
                </div>

                @include('inc.message')
                <div class="panel-body">

                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="card" style="width: 100%;">
                            <img src="/images/admin.png" style="width: 200px;" class="card-img-top img-rounded" alt="User Profile Picture">
                        <div class="card-body">
                
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Name : <strong>{{$userInfo->name}}</strong></li>
                            <li class="list-group-item">Email : <strong>{{$userInfo->email}}</strong></li>
                            <li class="list-group-item">Join Date : <strong>{{$userInfo->created_at}}</strong></li>
                            <li class="list-group-item">Active Status :
                                @if($userInfo->active_status == 'active')
                                <div class="label label-success">{{$userInfo->active_status}}</div>
                                @else
                                <div class="label label-danger">{{$userInfo->active_status}}</div>
                                @endif

                            </li>
                          </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 pull-right">
                       <div class="panel panel-default">
                                <div class="panel-heading">
                                   Change Password
                                </div>
                                <div class="panel-body">
                            
                                    <form action="/admin/profile/{{$userInfo->id}}/edit/password" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{$userInfo->id}}">
                                    <div class="form-group">
                                    <label>Old Password</label>
                                        <input class="form-control " type="password" name="old_password">
                                    </div>
                                    <div class="form-group">
                                    <label>New Password</label>
                                        <input class="form-control " type="password" name="new_password">
                                    </div>
                                    <input class="btn btn-success fadeIn fourth pull-right" type="submit" value="Change">
                                    </form>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
  
@endsection