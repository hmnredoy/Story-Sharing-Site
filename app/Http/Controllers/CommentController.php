<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function create(Request $request){

    	$validatedData = $request->validate([
        'comment' => 'required',
    	]);

    	$res = DB::table('comments')
    		->insert([
    			'comment_body' => $request->comment,
    			'user_id' => $request->user_id,
    			'story_id' => $request->story_id,
    			'comment_date_time' => date("h:i:s A d-M-Y"),
    			'created_at' => date('Y-m-d G:i:s')
    		]);

    		if(!$res){
	    	return redirect()->back()->with('message','Failed!')->with('style','alert alert-danger');	
    		}
    		else{
    			return redirect()->back();
    		}

    }


    public function admin_remove($id){
        $res = DB::table('comments')
            ->where('id',$id)
            ->delete();

        if($res){

            return redirect()->back()->with('message','Comment Deleted!')->with('style','alert alert-success');
        }else{

        return redirect()->back()->with('message','Failed!')->with('style','alert alert-danger');
       }

    }


    public function owner_remove(Request $request){

        $res = DB::table('comments')
            ->where('id',$request->comment_id)
            ->delete();

        if(!$res){

            return redirect()->back()->with('message','Failed')->with('style','alert alert-danger');
        }else{

        return redirect()->back();
       }
    }



}
