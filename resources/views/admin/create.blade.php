@extends('../layout.admin.dashboard')

@section('title', 'Member Profile')

@section('rightbar')
<!-- /. NAV SIDE  -->
<div id="page-wrapper">
    <div id="page-inner">
        <div class="custom_center">
            
   <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Create Admin
                        </div>
                        @include('inc.message')
                        <div class="panel-body">
                            <form role="form" method="post">
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
                                  <label>Password </label>
                                  <input class="form-control" type="password" name="password">
                                </div>
                                <button type="submit" class="btn btn-success">Create</button>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
          </div>
      </div>
@endsection