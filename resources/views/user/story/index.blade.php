@extends('../../layout.user.dashboard')

@section('title', 'Manage Story')

@section('rightbar')



<!-- /. NAV SIDE  -->
<div id="page-wrapper">
    <div id="page-inner">
    	<div class="col-md-12">
	    	<div class="panel panel-default">
	            <div class="panel-heading">
	               Manage Story
                   <div class="card-body pull-right">
                      <a href="/stories" class="btn btn-secondary btn-lg"><i class="fa fa-arrow-left"></i></a>
                   </div>
	            </div>

                @include('inc.message')
	            <div class="panel-body">
                    <div class="col-md-4">
                         <!--   Club Table  -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <label style="font-size: 1.3em; font-family: Montserrat;">{{$story->title}}</label>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <img src="/images/{{$story->image}}" style="width: 300px;" class="card-img-top img-rounded" alt="Story Image"><br>
                                    <h4>{{$story->image_caption}}</h4>
                                    <strong>Tags : </strong>{{$story->tags}}

                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Section : </th>
                                                <th>{{$story->section}}</th>
                                            </tr>
                                            <tr>
                                                <th>Created on :</th>
                                                 <th style="color: #ff6666;">{{$story->story_creation_date}}</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    @if($story->status == 'unlisted' && $story->dispute_status != 'disputed')
                                    <div class="alert alert-danger">This content is <strong>Unlisted</strong> by Admin.
                                        <form role="form" action="/dashboard/story/{{$story->id}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-secondary btn-sm">Dispute</button>
                                        </form>
                                    </div>
                                    @elseif($story->status == 'unlisted' && $story->dispute_status == 'disputed')
                                        <div class="alert alert-warning">Content unlisted. A dispute has been filed.</div>
                                    @endif

                                    <a href="/dashboard/story/{{$story->id}}/edit" class="btn btn-primary">Edit</a>&nbsp;&nbsp;
                                    <button type="button" data-toggle="modal" data-target="#deleteModel" class="btn btn-danger pull-right">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="panel-body">
                            <div class="story-height">
                                {!!$story->body!!}                                
                            </div>

                            

                        </div>
                        <div class="pull-right" style="margin-bottom: 10px;">
                            <a class="btn btn-secondary" href="/story/{{$story->id}}">View Story</a>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Comments</div>
                            <div class="panel-body">
                                @foreach($comments as $comment)
                                <div class="col-md-4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                           <strong>{{$comment->name}}</strong>
                                           <span class="text-muted">{{$comment->comment_date_time}}</span>
                                        </div>
                                        <div class="panel-body">
                                            {!!$comment->comment_body!!}
                                        </div>
                                     </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="pull-right">{{ $comments->links() }}</div>
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
        Are you sure you want to delete this story?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Close</button>
        <form role="form" action="/dashboard/story/{{$story->id}}/edit" method="post">
            @csrf
            <input type="hidden" name="_method" value="delete">
            <input type="hidden" name="story_id" value="{{$story->id}}">
            <input type="hidden" name="story_image" value="{{$story->image}}">
            <button type="submit" class="btn btn-danger">Confirm</button>    
        </form>
      </div>
    </div>
  </div>
</div>




@endsection