@extends('../layout.app')

@section('title', 'Registration')

@section('content')
   
 <div class="wrapper">
   <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Registration Form
                        </div>
                        @include('inc.message')
                        <div class="panel-body">
                            <form role="form" action="registration" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" type="text" name="name" value="{{old('name')}}">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="text" name="email" value = "{{old('email')}}">
                                </div>
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input class="form-control custom_resize" type="date" name="dob" value="{{old('date')}}">
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input class="form-control" type="text" name="phone" value="{{old('phone')}}">
                                </div>
                                <div class="form-group">
                                    <label>Gender</label>   
                                    <div class="radio">
                                    <label>
                                    <input type="radio" name="gender" id="optionsRadios1" value="Male" checked>Male
                                    </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="gender" id="optionsRadios2" value="Female">Female
                                        </label>
                                    </div> 
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="gender" id="optionsRadios2" value="Other">Other
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Choose an avatar</label>
                                    <input type="file" class="form-control custom_resize" name="image">
                                </div>
                                <div class="form-group">
                                  <label>Password </label>
                                  <input class="form-control" type="password" name="password">
                                </div>
                                <button type="submit" class="btn btn-success">Register Now</button>
                            </form>
                        </div>
                    </div>
            </div>
          </div>
@endsection