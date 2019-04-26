<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUser;

class LoginController extends Controller
{
    public function index(){
    	return view('user.login');
    }

    public function register(){
    	return view('user.register');
    }

    public function verify(Request $request){

    	if($request->email == null || $request->password == null){
           return redirect('login')->with("message","Empty fields!")->with('style','alert alert-warning');
        }
        else{

            $response = DB::table('users')
                ->where('email', $request->email)
                ->first();

            if($response){

            	if (Hash::check($request->password,  $response->password)) {

            		$res = DB::table('users')
		                ->where('email', $request->email)
		                ->where('block_status', 'unblocked')
		                ->first();

	                if($res){

	                	if($response->active_status == 'inactive'){
	                		DB::table('users')
			                ->where('email',$request->email)
			                ->update(['active_status' => 'active']);

                            DB::table('stories')
                            ->where('posted_by',$response->id)
                            ->update(['status' => 'active']);

                            $request->session()->put('user','reactivated');

            			}
               			// if ($request->password === $response->password) { //to be removed

                    	$request->session()->put('userInfo', $response);
                    	$request->session()->put('status','active');

                    	return redirect('check');

                	}
                	else{
                		return redirect('login')
	               		->with("message","You account is blocked. Please contact admin.")
	               		->with('style','alert alert-danger');
                	}

                }
                else{
                	return redirect('login')
               		->with("message","Wrong password!")
               		->with('style','alert alert-danger');
                }
            }
            else{
           		return redirect('login')
           		->with("message","Wrong email!")
           		->with('style','alert alert-warning');
            }
    	}              
    }
}
