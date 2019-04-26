<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateStory;
use App\Http\Requests\UpdateStory;

class StoryController extends Controller
{
    public function create(){

    	return view('user.story.create');
    }



    public function stories(Request $request)
    {
        $user_id = $request->session()->get('userInfo')->id;

        $response = DB::table('stories')
                    ->where('posted_by', $user_id)
                    ->orderBy('id', 'desc')
                    ->paginate(10);

        return view('user.stories')->with('stories',$response);

//      var_dump($request->session()->get('userInfo')->id);

    }


    public function store(CreateStory $request){

    	$request->flash();
    	$imageName = time().'.'.$request->story_image->getClientOriginalExtension();
        $request->story_image->move(public_path('images'), $imageName);


      //  split(',', $request->tags);

    	$params = [
            'title' => $request->story_title,
            'body' => $request->story_body,
            'section' => $request->story_section,
            'tags' => $request->tags,
            'image' => $imageName,
            'image_caption' => $request->story_caption,
            'status' => 'active',
            'posted_by' => $request->user_id,
            'story_creation_date' => date("h:i:s A d-M-Y")
        ];
        $res = DB::table('stories')
            ->insert($params);

        if($res){
         	return redirect('/stories')->with('message','Story Posted Successfully')->with('style','alert alert-success w-75 p-3');
        }
        else{
         	return redirect()->back()->with('message','Something went wrong!')->with('style','alert alert-danger');
        }
    }


    public function show($id){


        $res = DB::table('stories')
            ->join('users', 'stories.posted_by', '=', 'users.id')
            ->where('stories.id',$id)
            ->select('stories.*', 'users.name','users.id AS uid')
            ->first();


        $comments = DB::table('users')
                    ->join('comments','users.id', '=', 'comments.user_id')
                    ->where('comments.story_id',$id)
                    ->select('comments.*','users.name','users.id AS uid')
                    ->paginate(6);


        return view('user.story.index')->with('story',$res)->with('comments',$comments);
    }

    public function edit($id){
        $res = DB::table('stories')
        ->where('id',$id)
        ->first();

        return view('user.story.edit')->with('story',$res);
    }

    public function update(UpdateStory $request){

        if ($request->hasFile('story_image')) {
                
            if(file_exists(public_path("/images/".$request->old_image))){

            unlink(public_path("/images/".$request->old_image));

            }

            $imageName = time().'.'.$request->story_image->getClientOriginalExtension();

            $request->story_image->move(public_path('images'), $imageName);

           }
           else{
                $imageName = $request->old_image;
           }
            $params = [
                'title' => $request->story_title,
                'body' => $request->story_body,
                'section' => $request->story_section,
                'tags' => $request->story_tags,
                'image' => $imageName,
                'image_caption' => $request->story_caption
            ];
            $res = DB::table('stories')
                ->where('id',$request->story_id)
                ->update($params);

            if($res){
                return redirect()->back()->with('message','Story updated successfully!')->with('style','alert alert-success');  
            }
            else{
                return redirect()->back()->with('message','Failed!')->with('style','alert alert-danger');                
            }


    }


    public function destroy(Request $request){

        if(file_exists(public_path("/images/".$request->story_image))){

            unlink(public_path("/images/".$request->story_image));

        }
           
       $res = DB::table('stories')
                ->where('id',$request->story_id)
                ->delete();

        if($res){
                return redirect('stories')->with('message','Story Deleted!')->with('style','alert alert-success');
            }
        else{
            return redirect()->back()->with('message','Failed!')->with('style','alert alert-danger');                
        }
    }


    public function view($id){

        $story = DB::table('stories')
            ->join('users', 'stories.posted_by', '=', 'users.id')
            ->select('stories.*', 'users.name')
            ->where('stories.id',$id)
            ->where('stories.status','active')
            ->first();



        $comments = DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->join('stories', 'comments.story_id', '=', 'stories.id')
            ->select('comments.*', 'users.name', 'users.avatar', 'users.id AS uid','users.user_type')
            ->where('stories.id',$id)
            ->paginate(15);

        return view('user.story.view')
        ->with('story',$story)
        ->with('user_credibility','unregistered')
        ->with('comments',$comments);
    }



    public function search(Request $request){


    $search = $request->input('search');

  //  return view('view_name', compact('items'));

        $response = DB::table('stories')
                ->join('users','stories.posted_by', '=', 'users.id')
                ->where('stories.id',$search)
                ->orWhere('stories.title', 'LIKE', '%'.$search.'%')
                ->orWhere('stories.body', 'LIKE', '%'.$search.'%')
                ->orWhere('stories.section', 'LIKE', '%'.$search.'%')
                ->orWhere('stories.tags', 'LIKE', '%'.$search.'%')
                ->orWhere('stories.image_caption', 'LIKE', '%'.$search.'%')
                ->orWhere('users.name', 'LIKE', '%'.$search.'%')
                ->select('stories.*','users.name','users.id AS uid')
                ->paginate(6);

        $response->appends(['value' => $search]);
        
        return view('user.index')->with('stories',$response);
    }


    public function section(Request $request){


        $response = DB::table('stories')
                ->join('users','stories.posted_by', '=','users.id')
                ->where('stories.section', 'LIKE', '%'.$request->section.'%')
                ->orWhere('stories.tags', 'LIKE', '%'.$request->section.'%')
                ->select('stories.*','users.name','users.id AS uid')
                ->paginate(6);

        $response->appends(['value' => $request->section]);
        
        return view('user.index')->with('stories',$response);





    }


    public function dispute($id){

        DB::table('stories')
            ->where('id',$id)
            ->update(['dispute_status' => 'disputed']);

        return redirect()->back()->with('message','A dispute has been filed!')->with('style','alert alert-success');     
    }
}
