@extends('../layout.app')

@section('title', 'Welcome')

@section('content')

@include('inc.message')

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.js"></script>

@if(Session::has('celeb'))
<div id="confetti" class="confetti"></div>
@endif

    <section class="main-sec">
        <div class="container">
            <div class="standard-post-format">
                <div class="row small-post-sec">


                @foreach($stories as $story)
                    <div class="col-md-6 col-sm-6">
                        <div class="post-item small-post">
                            <img src="/images/{{$story->image}}" class="figure-img img-fluid rounded" alt="Story Image">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">{{$story->story_creation_date}}</li>
                                <li class="breadcrumb-item"> By <a href="#" class="">{{$story->name}}</a></li>
                            </ol>
                            <h2><a href="/story/{{$story->id}}">{{$story->title}}</a></h2>
                            <h5 class="story-height-landing">
                                {{$story->body}}
                            </h5>
                            <a href="/story/{{$story->id}}" class="continue-read">Continue Reading</a>
                        @if(session('userInfo'))
                            <div class="share align-middle">
                                <a href="" style="color: #666666;" data-toggle="collapse" data-target="#{{$story->id}}" aria-expanded="false" aria-controls="collapseExample">
                                   <i class="fa fa-comment-o"></i>&nbsp;Comment
                                </a>
                       
                                    <div class="panel-body">

                                        <form role="form" action="/story/{{$story->id}}/comment" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="user_id" value="{{session('userInfo')->id}}">
                                            <input type="hidden" name="story_id" value="{{$story->id}}">
                                            <div class="collapse" id="{{$story->id}}">
                                                <textarea class="form-control" rows="2" placeholder="Write comment..." style="border-color: #fff;" name="comment"></textarea>
                                                <a href="/story/{{$story->id}}#cmnt" class="pull-left" style="padding-left: 5px; color: #666666;">See all comments...</a>
                                                <button type="submit" class="btn btn-info pull-right" style="margin-top: 3px;">Post</button>
                                            </div>
                                        </form>
                                        
                                    </div>
                        
                            </div>
                        @endif
                        </div>
                    </div>
                    @endforeach
     
          

        
                </div>
                <div class="button-sec">
                    {{ $stories->links() }}
                </div>
            </div>

             @include('inc.story.aside')
        </div>
    </section>

@endsection