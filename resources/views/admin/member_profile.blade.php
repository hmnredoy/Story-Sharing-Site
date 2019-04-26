@extends('../layout.admin.dashboard')

@section('title', 'Member Profile')

@section('rightbar')


<!-- /. NAV SIDE  -->
<div id="page-wrapper">
    <div id="page-inner">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Member Details
                   <div class="card-body pull-right">
                      <a href="/admin/members/active" class="btn btn-secondary btn-lg"><i class="fa fa-arrow-left"></i></a>
                   </div>
                </div>

                @include('inc.message')
                <div class="panel-body">

                    <div class="col-md-8">
               
                        <div class="panel">
                            <div class="panel-heading">
                            <img src="/images/{{$userInfo->avatar}}" style="width: 29%;" class="card-img-top img-rounded" alt="User Profile Picture">

                            <button type="button" data-toggle="modal" data-target="#deleteModel" class="btn btn-dark pull-right">Delete</button>

                        <div class="card-body">
                             <form role="search" method="GET" action="/admin/stories/search">
                                <input type="hidden" name="story_search" value="{{$userInfo->email}}">
                                <button style="margin-top: 5px; width: 29%;" type="submit" class="btn btn-info">Stories Posted <span class="badge">{{$stories}}</span></button>
                            </form>
                        </div>

                        </div>
                        <div class="panel-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Name : <strong>{{$userInfo->name}}</strong></li>
                            <li class="list-group-item">Gender : <strong>{{$userInfo->gender}}</strong></li>
                            <li class="list-group-item">DOB : <strong>{{$userInfo->dob}}</strong></li>
                            <li class="list-group-item">Phone : <strong>{{$userInfo->phone}}</strong></li>
                            <li class="list-group-item">Email : <strong>{{$userInfo->email}}</strong></li>
                            <li class="list-group-item">Join Date : <strong>To Be Implemented</strong></li>
                            
                            @if($userInfo->block_status == 'unblocked')
                            <li class="list-group-item">Active Status :
                                @if($userInfo->active_status == 'active')
                                <div class="label label-success">{{$userInfo->active_status}}</div>
                                @else
                                <div class="label label-danger">{{$userInfo->active_status}}</div>
                                @endif

                            </li>
                            @endif


                            @if($userInfo->active_status == 'active')
                            <li class="list-group-item">Block Status :
                                @if($userInfo->block_status == 'unblocked')
                                <div class="label label-success">{{$userInfo->block_status}}</div>
                                @else
                                <div class="label label-danger">{{$userInfo->block_status}}</div>
                                @endif

                                @if($userInfo->block_status == 'unblocked')
                                <form method="post" action="/admin/members/{{$userInfo->id}}/block" style="display: inline;">
                                    <input type="hidden" name="_method" value="put">
                                    <input type="hidden" name="user_id" value="{{$userInfo->id}}">
                                    {{ csrf_field() }}
                                    <div class="pull-right">
                                    <input type="hidden" name="active_status" value="inactive">
                                    <input class="btn btn-danger" type="submit" value="Block User">
                                    </div>
                                </form>
                                @else
                                <form method="post" action="/admin/members/{{$userInfo->id}}/unblock" style="display: inline;">
                                    <input type="hidden" name="_method" value="put">
                                    <input type="hidden" name="user_id" value="{{$userInfo->id}}">
                                    {{ csrf_field() }}
                                    <div class="pull-right">
                                    <input type="hidden" name="active_status" value="inactive">
                                    <input class="btn btn-success" type="submit" value="Unblock User">
                                    </div>
                                </form>
                                @endif
                            </li>
                            @else
                            @endif
                            
                          </ul>
                          </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this user?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Close</button>
        <form role="form" action="/admin/members/{{$userInfo->id}}/delete" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="user_id" value="{{$userInfo->id}}">
            <input type="hidden" name="user_image" value="{{$userInfo->avatar}}">
            <button type="submit" class="btn btn-danger">Confirm</button>    
        </form>
      </div>
    </div>
  </div>
</div>



  
@endsection