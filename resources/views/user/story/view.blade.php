@extends('../../layout.app')


@section('title', 'Story')

@section('content')

    <hr class="hr-color">
    <section class="main-sec blog-inner">
        <div class="container">
            <div class="standard-post-format">

                <div class="row">
                    <div class="col-md-12">
                        @if(session('userInfo'))
                            @if(session('userInfo')->id == $story->posted_by)
                            <div class="pull-right" style="margin: 5px 7px;">
                                    <a class="btn btn-default" style="background-color: #ecebed; color: #737373;" href="/dashboard/story/{{$story->id}}/edit">Edit</a>
                                </div>
                            @endif
                        @endif
                        <div class="post-item big-post">
                                <h1>{{$story->title}}</h1>
                            <div class="img_container">
                            <img src="/images/{{$story->image}}" alt="post-img">
                            <div class="content_img"> 
                                <h4>{{$story->image_caption}}</h4>
                            </div>

                            </div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">{{$story->story_creation_date}}</li>
                                <li class="breadcrumb-item"> By <a href="#" class="admin">{{$story->name}}</a></li>
                                <li class="breadcrumb-item">In <a href="#" class="fashion">{{$story->section}} </a></li>
                                @if(session('userInfo'))
                                <li class="breadcrumb-item">({{ $comments->total() }}) Comments</li>
                                @endif
                            </ol>
                            <div style="word-wrap: break-word; text-align: justify; padding: 0px 5px;">
                             {!!$story->body!!}                                
                            </div>

                    
                            <div class="share align-middle">
                                <span class="text">Share This</span>
                                <span class="fb"><i class="fa fa-facebook-official"></i></span>
                                <span class="instagram"><i class="fa fa-instagram"></i></span>
                                <span class="twitter"><i class="fa fa-twitter"></i></span>
                                <span class="pinterest"><i class="fa fa-pinterest"></i></span>
                                <span class="google"><i class="fa fa-google-plus"></i></span>
                                <span class="google"><i class="fa fa-commenting"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <a name="cmnt"></a>
                  <div class="col-md-12">
                        


                        @if(session('userInfo'))
                        <div class="panel panel-default">
                
                             @include('inc.message')
                            <div class="panel-body">
                                <ul class="media-list">

                                    <li class="media">

                                        <div class="media-body">
                                            @if($comments->count() > 0)
                                            @foreach($comments as $comment)
                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img  
                                                    @if($comment->user_type == 'admin')
                                                    src="/images/admin.png"
                                                    @else
                                                    src="/images/{{$comment->avatar}}"
                                                    @endif
                                                    class="crop-image" alt="commenter image">
                                                </a>
                                                <div class="media-body" style="font-family: 'Raleway', sans-serif;">
                                                    <strong class="media-heading">{{$comment->name}} </strong>
                                                    <p>{!!$comment->comment_body!!}</p>
                                                </div>
                                                <div>
                                                    @if($comment->user_id == session('userInfo')->id)
                                                    <form role="form" action="/story/{{$story->id}}/comment" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                                    <button type="submit" class="btn btn-default btn-sm pull-right">Delete</button>
                                                    </form>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                            @endforeach
                                            @else
                                            <p class="text-muted">No Comments..</p>
                                            @endif
                                            {{ $comments->links() }}
                                            </div>
                                        </li>
                                    </ul>
                                </div>


                                <div class="panel-footer">
                                    <div class="input-group">
                                        <form role="form" action="/story/{{$story->id}}/comment" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="user_id" value="{{session('userInfo')->id}}">
                                            <input type="hidden" name="story_id" value="{{$story->id}}">
                                            <textarea class="autofit form-control" rows="2" placeholder="Write comment..." style="margin-bottom: 5px;" name="comment"></textarea>
                                            <button type="submit" class="btn btn-secondary pull-right">Post</button>
                                        </form>
                                    </div>
                                </div>

                    </div>
                    @endif
                </div>
          </div>
           @include('inc.story.aside')
        </div>
    </section>

@endsection