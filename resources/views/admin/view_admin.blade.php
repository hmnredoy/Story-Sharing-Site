@extends('../layout.admin.dashboard')

@section('title', 'Member Profile')

@section('rightbar')


<!-- /. NAV SIDE  -->
<div id="page-wrapper">
    <div id="page-inner">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Admin Details
                   <div class="card-body pull-right">
                      <a href="{{ URL::previous() }}" class="btn btn-secondary btn-lg"><i class="fa fa-arrow-left"></i></a>
                   </div>
                </div>

                @include('inc.message')
                <div class="panel-body">

                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body pull-right">
                        

                        </div>
                        <div class="card" style="width: 100%;">
                
                            <strong>Admin Profile</strong>

                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Name : <strong>{{$userInfo->name}}</strong></li>
                            <li class="list-group-item">Email : <strong>{{$userInfo->email}}</strong></li>
                            <li class="list-group-item">Join Date : <strong>To Be Implemented</strong></li>
                            <li class="list-group-item">Active Status :
                                @if($userInfo->active_status == 'active')
                                <div class="label label-success">{{$userInfo->active_status}}</div>
                                @else
                                <div class="label label-danger">{{$userInfo->active_status}}</div>
                                @endif
                            </li>
                            <li class="list-group-item">
                                <button type="button" data-toggle="modal" data-target="#deleteModel" class="btn btn-danger">Delete</button>
                            </li>
                          </ul>
                          
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
        Are you sure you want to delete this Admin?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Close</button>
        <form role="form" action="/admin/manage/{{$userInfo->id}}/delete" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Confirm</button>    
        </form>
      </div>
    </div>
  </div>
</div>

  
@endsection