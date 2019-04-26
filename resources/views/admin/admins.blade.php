@extends('../layout.admin.dashboard')

@section('title', 'Dashboard')

@section('rightbar')

<script src="{{asset('js/custom.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
               <div class="panel panel-default">
                <div class="panel-heading">
                 @include('inc.message')
                <label>Admin List</label>
                <div class="label label-success">{{$rows}}</div>
                  <form class="navbar-form pull-right" role="search" method="get" action="{{route('admin.search')}}">
                    <div class="input-group add-on">
                      <input class="form-control" placeholder="Search" name="search" type="text" style="width: 350px;">
                      <div class="input-group-btn">
                        <button class="btn btn-success" type="submit" style="padding: 6.4px 10px;"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </form>
              


       <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Join Date</th>
                <th>Status</th>
            </tr>

            @foreach($admins as $user)

            @if($user->user_type == 'member' || $user->id == session('userInfo')->id)

            @else

            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at}}</td>
                <td>
                    @if($user->active_status == 'active')
                    <div class="label label-success">{{$user->active_status}}</div>
                    @else
                    <div class="label label-success">{{$user->active_status}}</div>
                    @endif
                </td>
                <td>
                    <a class="btn btn-dark" href="/admin/manage/{{$user->id}}">View&nbsp;&nbsp;<i class="fa fa-cog"></i></a>
                </td>
            </tr>
            @endif

            @endforeach

                </table>
                </div>
            </div>
            <div class="pull-right">{{ $admins->links() }}</div>
        </div>
    </div>
</div>


@endsection