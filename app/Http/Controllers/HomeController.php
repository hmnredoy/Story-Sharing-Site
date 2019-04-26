<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

	public function index(Request $request){

		$res = DB::table('stories')
   		->join('users', 'stories.posted_by', '=', 'users.id')
   		->select('stories.*', 'users.name', 'users.id AS uid')
   		->where('stories.status','active')
   		->orderBy('stories.id', 'desc')
   		->paginate(6);

   		$request->session()->put('stories', $res);

		if($request->session()->pull('user')=='new_user')
		{
			
			$request->session()->flash('celeb');
			$request->session()->put('user_credibility', 'registered');
			return view('user.index')->with('stories',$res);
		
		}
		else if($request->session()->pull('user')=='admin' || $request->session()->pull('user')=='member'|| $request->session()->pull('user')=='reactivated'){

			$request->session()->put('user_credibility', 'registered');
			return view('user.index')->with('stories',$res);
	
		}
		else{
			$request->session()->put('user_credibility', 'unregistered');
			return view('user.index')->with('stories',$res);
	
		}

	}


}
