@extends('../../layout.user.dashboard')

@section('title', 'Dashboard')

@section('rightbar')

<div id="page-wrapper">
    <div id="page-inner">
            <div class="card-body pull-right">
                <a href="/dashboard" class="btn btn-secondary btn-lg"><i class="fa fa-arrow-left"></i></a>
            </div>
        <div class="row" style="margin-top: 2%;">
            <div class="col-md-10 col-sm-10 col-xs-10 col-md-offset-1">
               <div class="panel panel-default">
                    <div class="panel-heading">
                           Create a Story
                   
                   </div>
                    @if(session('message'))
                        <div style="padding: 5px 5px;">
                            <div class="{{session('style')}}">
                            {{session('message')}}
                            </div>  
                        </div>   
                    @endif
                
                    @if(count($errors) > 0)
                    <div class="alert alert-danger" style="margin: 5px 5px;">
                        @foreach ($errors->all() as $error)
                           {{ $error }}<br>
                        @endforeach
                    </div>  
                    @endif
                    <div class="panel-body">
                        <form role="form" action="/story/create" enctype="multipart/form-data" method="post">
                            <input type="hidden" name="user_id" value="{{ Session::get('userInfo')->id }}">
            

                             {{ csrf_field() }}
                             <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control custom_resize" name="story_image" >
                                </div>
                                <div class="form-group">
                                    <label>Caption</label>
                                    <input class="form-control" type="text" name="story_caption" value="{{old('story_caption')}}">
                                </div>     
                             </div>
                            
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" type="text" name="story_title" value="{{old('story_title')}}">
                            </div>
                            <div class="form-group">
                                <label>Section</label>
                                <input class="form-control" type="text" name="story_section" value="{{old('story_section')}}">
                            </div>
                            <div class="form-group">
                                <label>Your Story</label>
                                <textarea class="form-control" rows="4" name="story_body">{{old('story_body')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Tags</label>
                                <p class="help-block">Seperate each tag by comma (,). ex: Cars,Super-cars etc.</p>
                                <input class="form-control" type="text" name="tags" value="{{old('tags')}}">
                            </div>

                            <button type="submit" class="btn btn-success btn-block btn-lg">Post Story </button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection