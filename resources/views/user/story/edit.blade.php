@extends('../../layout.user.dashboard')

@section('title', 'Edit Story')

@section('rightbar')

<!-- /. NAV SIDE  -->
<div id="page-wrapper">
    <div id="page-inner">
        <div class="card-body pull-right">
          <a href="/dashboard/story/{{$story->id}}" class="btn btn-secondary btn-lg"><i class="fa fa-arrow-left"></i></a>
        </div><br><br>
    	<div class="col-md-12 col-sm-12 col-xs-12">
	    	<div class="panel panel-default">
	            <div class="panel-heading">
	               Edit Story
	            </div>
                
                @include('inc.message')
			     <div class="panel-body">
                <form role="form" action="/dashboard/story/{{$story->id}}/edit" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                <input type="hidden" name="story_id" value="{{$story->id}}">
                <input type="hidden" name="old_image" value="{{$story->image}}">

                    <div class="col-md-6">
                        <img src="/images/{{$story->image}}" style="width: 500px;" class="card-img-top img-rounded" alt="Story Image"><br>
                            <label>Change Cover Image</label>
                            <div class="form-group">
                            <input type="file" class="form-control custom_resize" name="story_image">
                            </div>
                        <div class="form-group">
                            <label>Image Caption</label>
                            <input class="form-control" type="text" name="story_caption" value="{{$story->image_caption}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" type="text" name="story_title" value="{{$story->title}}">
                        </div>
                        <div class="form-group">
                            <label>Body</label>
                            <textarea class="form-control" rows="6" name="story_body">{{$story->body}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Section</label>
                            <input class="form-control" type="text" name="story_section" value="{{$story->section}}">
                        </div>
                        <div class="form-group">
                            <label>Tags</label>
                            <input class="form-control custom_resize" type="text" name="story_tags" value="{{$story->tags}}">
                            <span style="color: #b3b3b3;">Seperate each tag by comma (,)</span>
                        </div>
                        <input class="btn btn-success fadeIn fourth" type="submit" value="Update">
                        <a href='/story/{{$story->id}}' class="btn btn-secondary fadeIn fourth pull-right">View Story</a>
                    </div>
                </form>
            </div>



	            </div>
	        </div>
        </div>
    </div>
</div>

@endsection