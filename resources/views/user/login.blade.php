@extends('../layout.app')

@section('title', 'Login')

@section('content')


<div class="wrapper" style="margin-bottom: 15.7%;">
  <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="panel panel-default">
          <div class="panel-heading">
             Login Form
          </div>

          @include('inc.message')

          <div class="panel-body">
              <form role="form" method="post">
              {{ csrf_field() }}
                   <div class="form-group">
                        <label>Enter Email</label>
                        <input class="form-control" type="text" name="email">
                    </div>
                    <div class="form-group">
                        <label>Enter Password</label>
                        <input class="form-control" type="password" name="password">
                    </div>
                  <button type="submit" class="btn btn-success">Login</button>
              </form>
          </div>
      </div>
  </div>
</div>
@endsection