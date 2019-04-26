@extends('../layout.admin.dashboard')

@section('title', 'Members')

@section('rightbar')

<script src="{{asset('js/custom.js')}}"></script>

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
               <div class="panel panel-default">
                <div class="panel-heading">

                @include('inc.message')
                <label>Member List</label>
                <div class="label label-success">{{$rows}}</div>
                <span id="total_records"></span>
                  <form class="navbar-form pull-right" role="search" method="GET" action="/admin/members/search">
                    <input type="hidden" name="user_id" value="{{session('userInfo')->id}}">
                    @csrf
                    <div class="input-group add-on">
                      <input class="form-control" placeholder="Search" name="search" id="search" type="text" style="width: 350px;">
                      <div class="input-group-btn">
                        <button class="btn btn-success" type="submit" style="padding: 6.4px 10px;"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </form>
               


           <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                <tr>
                    <th>Member #ID</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Block Status</th>
                    <th>Member Type</th>
                </tr>

                @foreach($userInfo as $user)

                @if($user->user_type == 'admin')

                @else
                <tr>
                    <td>{{$user->id}}</td>
                    <td><img src="/images/{{$user->avatar}}" class="crop-image" alt="Profile Image">
                    </td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->dob}}</td>
                    <td>{{$user->gender}}</td>
                    <td>
                    @if($user->active_status == 'inactive')
                    <div class="label label-danger">{{$user->active_status}}</div>
                    @else
                    {{$user->active_status}}
                    @endif
                    </td>
                    <td>
                    @if($user->block_status == 'unblocked')
                    <div class="label label-success">{{$user->block_status}}</div>
                    @else
                    <div class="label label-danger">{{$user->block_status}}</div>
                    @endif
                    </td>
                    <td>
                        @if($user->user_type == 'admin')
                        <div class="label label-warning">{{$user->user_type}}</div>
                        @else
                        <div class="label label-info">{{$user->user_type}}</div>
                        @endif
                    </td>
                    <td>
                        <a class="btn  btn-dark" href="/admin/members/{{$user->id}}/{{$user->user_type}}">Manage&nbsp;&nbsp;<i class="fa fa-cog"></i></a>
                    </td>
                </tr>

                @endif
                @endforeach

                </table>
                </div>
            </div>
            <div class="pull-right">{{ $userInfo->links() }}</div>
        </div>
    </div>
</div>










@endsection