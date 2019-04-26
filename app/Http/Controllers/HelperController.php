<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperController extends Controller
{
    
    public function check(Request $request){


		$user = $request->session()->get('userInfo');
        $user_status = $request->session()->get('user');

        if($user->user_type == "admin"){
            $request->session()->flash('message',  'Welcome <strong>Admin</strong>! Deal with the problems now! &#128521;');
            $request->session()->flash('style', 'alert alert-success col-md-4 col-md-offset-4 text-center');
			$request->session()->put('user','admin');
			return redirect('home');
        }
        else if($user->user_type == "member" && $user_status == null){

            $request->session()->flash('message',  'Welcome <strong>'.$user->name.'</strong>!');
            $request->session()->flash('style', 'alert alert-success col-md-4 col-md-offset-4 text-center');
			$request->session()->put('user','member');
			return redirect('home');
        }
        else if($user->user_type == "member" && $user_status == 'reactivated'){

            $request->session()->flash('celeb');
            $request->session()->flash("message","Welcome back <strong>".$user->name."</strong>! Your account is now active!");
            $request->session()->flash('style','alert alert-success col-md-4 col-md-offset-4 text-center');
            $request->session()->put('user','reactivated');
            return redirect('home');
        }
        else{
           return redirect('login')->with("message","Something went wrong! Cause : User Type was not found!")->with('style','alert alert-danger text-center'); 
        }
   
        	
    }


}
