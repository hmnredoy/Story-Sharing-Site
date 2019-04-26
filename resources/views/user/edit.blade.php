@extends('../layout.user.dashboard')

@section('title', 'Edit Profile')

@section('rightbar')

<!-- /. NAV SIDE  -->
<div id="page-wrapper">
    <div id="page-inner">
        <div class="card-body pull-right">
          <a href="/profile/{{$userInfo->id}}" class="btn btn-secondary btn-lg"><i class="fa fa-arrow-left"></i></a>
        </div><br><br>
    	<div class="col-md-12 col-sm-12 col-xs-12">
	    	<div class="panel panel-default">
	            <div class="panel-heading">
	               Edit Profile
	            </div>
                
                @include('inc.message')
                <div class="panel-body">
                    <form role="form" action="/profile/{{$userInfo->id}}/edit" method="post" enctype="multipart/form-data">
                        @csrf
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="user_id" value="{{$userInfo->id}}">
                    <input type="hidden" name="action" value="update_profile">
                    <input type="hidden" name="old_image" value="{{$userInfo->avatar}}">

                        <div class="col-md-6">
                            <img src="/images/{{$userInfo->avatar}}" style="width: 300px;" class="card-img-top img-rounded" alt="Story Image"><br>
                            <label>Change Avatar</label>
                            <div class="form-group">
                                <input type="file" class="form-control custom_resize" name="avatar">
                            </div>

                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" type="text" name="name" value="{{$userInfo->name}}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="text" name="email" value="{{$userInfo->email}}">
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input class="form-control" type="text" name="phone" value="{{$userInfo->phone}}">
                            </div>
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input class="form-control custom_resize" type="date" name="dob" value="{{$userInfo->dob}}">
                            </div>
                             <div class="form-group">
                                <label>Gender</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="optionsRadios1" value="Male"@if($userInfo->gender == 'Male') checked @endif>Male
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="optionsRadios2" value="Female" @if($userInfo->gender == 'Female') checked @endif>Female
                                    </label>
                                </div> 
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="optionsRadios2" value="Other" @if($userInfo->gender == 'Other') checked @endif>Other
                                    </label>
                                </div>
                            </div>
                            <input class="btn btn-success fadeIn fourth" type="submit" value="Update">
                        </div>
                    </form>

                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                   Change Password
                                </div>
                                <div class="panel-body">
                            
                                    <form action="/profile/{{$userInfo->id}}/edit/password" method="POST">
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
    </div>
</div>

@endsection