@extends('../layout.user.dashboard')

@section('title', 'Dashboard')

@section('rightbar')

<link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
               <div class="panel panel-default">
                <div class="panel-heading">
                @include('inc.message')
                <label>Stories Posted by You</label>
                </div>

        <div class="panel-body">

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
            <tr>
                <th>Story #ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Body</th>
                <th>Section</th>
                <th>Tags</th>
            </tr>

            @foreach($stories as $story)

            <tr>
                <td>{{$story->id}}</td>
                <td><img src="/images/{{$story->image}}" style="width: 100px;" class="card-img-top img-rounded" alt="Story Image">

                @if($story->status == 'unlisted')
                <div class="label label-danger" style="padding: 2% 14%;"><i class="fa fa-ban"></i>&nbsp;Unlisted</div>
                @else
                @endif
                </td>
                <td>{{$story->title}}</td>
                <td class="max-lines">{{$story->body}}</td>
                <td>{{$story->section}}</td>
                <td>{{$story->tags}}</td>
                <td>
                    <a class="btn  btn-dark" href="/dashboard/story/{{$story->id}}">Manage&nbsp;&nbsp;<i class="fa fa-cog"></i></a>
                </td>
            </tr>

            @endforeach

            </table>
                </div>
            </div>
            <div class="pull-right">{{ $stories->links() }}</div>           
        </div>
    </div>
</div>
@endsection