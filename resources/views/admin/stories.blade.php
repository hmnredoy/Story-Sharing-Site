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
                <label>Story List</label>
                <div class="label label-success">{{$rows}}</div>
                  <form class="navbar-form pull-right" role="search" method="GET" action="/admin/stories/search">
                    <div class="input-group add-on" style="margin-top: -12px;">
                    @csrf
                      <input class="form-control" placeholder="Search" name="story_search" type="text" style="width: 350px;">
                      <div class="input-group-btn">
                        <button class="btn btn-success" type="submit" style="padding: 6.4px 10px;"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </form>
                </div>

        <div class="panel-body">


        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
            <tr>
                <th>Story #ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Section</th>
                <th>Tags</th>
                <th>Posted By</th>
                <th>Status</th>

            </tr>

            @foreach($stories as $story)

            <tr>
                <td>{{$story->id}}</td>
                <td><img src="/images/{{$story->image}}" style="width: 100px;" class="card-img-top img-rounded" alt="Story Image"></td>
                <td>{{$story->title}}</td>
                <td>{{$story->section}}</td>
                <td  class="max-lines">{{$story->tags}}</td>
                <td><a href="/admin/members/{{$story->uid}}/{{$story->user_type}}">{{$story->name}}</a></td>
                <td>
                @if($story->status == 'inactive')
                <div class="label label-warning">
                    Inactive
                </div>
                @elseif($story->status == 'unlisted')
                <div class="label label-danger">
                    Unlisted
                </div>
                @else
                <div class="label label-success">
                    Active
                </div>
                @endif

                @if($story->dispute_status == 'disputed')
                <br>
                <div class="label label-info btn-sm text">Disputed</div>
                @endif

                </td>
                <td>
                <a class="btn btn-dark" href="/admin/story/{{$story->id}}">Manage&nbsp;&nbsp;<i class="fa fa-cog"></i></a>
                </td>
              

            </tr>

            @endforeach

            </table>
            </div>
            </div>
            <div class="pull-right">{{ $stories->links() }}</div>
        </div>       <!-- /. PAGE INNER  -->
    </div>
</div>

@endsection