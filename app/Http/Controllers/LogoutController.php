<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function index(Request $request){

    	
    	
    	$request->session()->forget('userInfo');
    	$request->session()->flush();
    	$request->session()->put('user_credibility', 'unregistered');
    	return redirect('/');
    }
}
