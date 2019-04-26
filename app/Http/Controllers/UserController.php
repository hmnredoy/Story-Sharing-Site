<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateProfile;
use App\Http\Requests\ChangePassword;


class UserController extends Controller
{

	  public function index(){

    	return view('user.landing');
    }


    public function create(StoreUser $request){


    	$request->flashExcept(['password', 'image']);

  //       $user_check = DB::table('users')
  //       ->get();

  //       if($user_check){
  //       	foreach($user_check as $uc)
  //       	{
	 //    		if($uc->email == $request->email)
		//         {
		//         	return redirect()->back()->with('message','Email already exists. Please enter another email.')->with('style','alert alert-danger');
		//         }
		//     }
		// }

    	$imageName = time().'.'.$request->image->getClientOriginalExtension();

        $request->image->move(public_path('images'), $imageName);


        $params = [
	            'user_type' => 'member',
	            'name' => $request->name,
	            'dob' => $request->dob,
	            'phone' => $request->phone,
	            'email' => $request->email,
	            'password' => Hash::make($request->password),
	            'active_status' => 'active',
	            'avatar' => $imageName,
	            'gender' => $request->gender
	        ];
	        $response = DB::table('users')
	            ->insertGetId($params);



	        if($response){

	        	$res = DB::table('users')
                ->where('id', $response)
                ->first();

                $request->session()->flash('message',  'Welcome <strong>'.$res->name.'</strong>! Start Writing Now!');
			 	$request->session()->flash('style', 'alert alert-success col-md-4 col-md-offset-4');
	        	$request->session()->put('userInfo', $res);

				$request->session()->put('user','new_user');
	         	return redirect('home');

	         }
	         else{
	         	return redirect()->back()->with('message','Something went wrong!')->with('style','alert alert-danger');
	         }
	   

	}

    public function detail($id){

    	 $res = DB::table('users')
            ->where('id',$id)
            ->first();


        $stories = DB::table('stories')
        	->where('posted_by',$id)
        	->count();



        	//var_dump($res);

        return view('user.profile')
        ->with('userInfo',$res)
        ->with('stories',$stories)
        ->with('user_id',$id);
    }


    public function deactivate(Request $request){
    	$res = DB::table('users')
                ->where('id',$request->user_id)
                ->update(['active_status' => $request->active_status]);

        $res = DB::table('stories')
                ->where('posted_by',$request->user_id)
                ->update(['status' => 'inactive']);



    	$request->session()->flush();
    	return redirect('/')->with('message','Deactivated! Your posts will not be visible until you reactivate your profile. Reactivate your account just by logging in.')->with('style','alert alert-danger col-md-4 col-md-offset-4');
    }


    public function edit($id){

    	$res = DB::table('users')
        	->where('id',$id)
        	->first();

        return view('user.edit')->with('userInfo',$res);
    }

    public function update(UpdateProfile $request){

        // $user_email = DB::table('users')
        //         ->where('id',$request->user_id)
        //         ->select('email')
        //         ->first();

        // if($user_email->email != $request->email){

        // }

        // if($user_check){
        //  foreach($user_check as $uc)
        //  {
        //      if($uc->email == $request->email)
        //         {
        //          return redirect()->back()->with('message','Email already exists. Please enter another email.')->with('style','alert alert-danger');
        //         }
        //     }
        // }


		if ($request->hasFile('avatar')) {
            
            if(file_exists(public_path("/images/".$request->old_image))){

            unlink(public_path("/images/".$request->old_image)); }

        	$imageName = time().'.'.$request->avatar->getClientOriginalExtension();

        	$request->avatar->move(public_path('images'), $imageName);
       }
       else{
            $imageName = $request->old_image;
       }

       	$params = [
	            'name' => $request->name,
	            'dob' => $request->dob,
	            'phone' => $request->phone,
	            'email' => $request->email,
	            'avatar' => $imageName,
	            'gender' => $request->gender
            ];
            $res = DB::table('users')
                ->where('id',$request->user_id)
                ->update($params);

            if($res){

                $userData = DB::table('users')
                    ->where('id',$request->user_id)
                    ->first();

                $request->session()->put('userData',$userData);
                return redirect()->back()->with('message','Profile updated successfully!')->with('style','alert alert-success');  
            }
            else{
                return redirect()->back()->with('message','Failed!')->with('style','alert alert-danger');                
            }

    }


    public function change(ChangePassword $request){

	    		$res = DB::table('users')
	    			->where('id',$request->user_id)
	    			->first();

	    		if (Hash::check($request->old_password, $res->password)) {
	    
		        	$response = DB::table('users')
				            ->where('id', $request->user_id)
				            ->update(['password' => Hash::make($request->new_password)]);

		            if($response){
		                return redirect()->back()->with('message','Password changed successfully!')->with('style','alert alert-success');  
		            }
		            else{
		            	return redirect()->back()->with('message','Failed!')->with('style','alert alert-danger');
		            }
		   		}
		   		else{
		   			return redirect()->back()->with('message','Old password is wrong!')->with('style','alert alert-danger');
		   		}
    	}



        public function dashboard(Request $request){

            $user = $request->session()->get('userInfo');

            $stories = DB::table('stories')
                    ->where('posted_by',$user->id)
                    ->get();

            $comments = DB::table('comments')
                    ->join('stories', 'stories.id', '=', 'comments.story_id')
                    ->where('stories.posted_by',$user->id)
                    ->get();

            $userData = DB::table('users')
                    ->where('id',$user->id)
                    ->first();


            $request->session()->put('userData',$userData);
            $total_stories = $stories->count();
            $total_comments = $comments->count();
            
            return view('user.dashboard')
            ->with('total_stories',$total_stories)
            ->with('total_comments',$total_comments);
        }



}
 

