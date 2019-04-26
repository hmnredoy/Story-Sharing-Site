<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreAdmin;
use App\Http\Requests\ChangePassword;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
	public function dashboard(Request $request){
		$user = $request->session()->get('userInfo');
		
		$user_count = DB::table('users')
	                ->where('user_type','<>' ,'admin')
	                ->where('block_status', '=', 'unblocked')
	                ->where('active_status', '=', 'active')
	                ->count();

        $story_count = DB::table('stories')
            ->where('status', '=', 'active')
            ->count();

        $comment_count = DB::table('comments')
            ->count();

	    return view('admin.dashboard')
	    ->with('user_count',$user_count)
	    ->with('comment_count',$comment_count)
	    ->with('story_count',$story_count);
	}


	public function active_members(Request $request){
		$users = DB::table('users')
	                ->where('user_type','<>' ,'admin')
	                ->where('block_status', '=', 'unblocked')
	                ->where('active_status', '=', 'active')
	                ->orderBy('id', 'desc')
	                ->paginate(10);
		
	    return view('admin.members')->with('userInfo',$users)->with('rows',$users->count());
	}

	public function inactive_members(Request $request){

		$users = DB::table('users')
	                ->where('user_type','<>' ,'admin')
	                ->where('block_status', '=', 'unblocked')
	                ->where('active_status', '=', 'inactive')
	                ->orderBy('id', 'desc')
	                ->paginate(10);
		
	    return view('admin.members')->with('userInfo',$users)->with('rows',$users->count());
	}

	public function blocked_members(Request $request){

		$users = DB::table('users')
	                ->where('user_type','<>' ,'admin')
	                ->where('block_status', '=', 'blocked')
	                ->orderBy('id', 'desc')
	                ->paginate(10);
		
	    return view('admin.members')->with('userInfo',$users)->with('rows',$users->count());
	}


	public function member_detail(Request $request, $userId, $userType){

		$request->session()->put('userId_for_detail',$userId);
		if($userType == 'admin')
		{
			return redirect('/admin/manage/$userId');
		}else{

		$stories = DB::table('stories')
				->where('posted_by',$userId)
				->count();

		$user = DB::table('users')
                ->where('id',$userId)
                ->first();


		return view('admin.member_profile')->with('userInfo', $user)->with('stories', $stories);	
		}

	}
	

	public function block_member($id){

			DB::table('users')
	            ->where('id', $id)
	            ->update(['block_status' => 'blocked']);

	    	DB::table('stories')
		   		->where('posted_by',$id)
	            ->update(['status' => 'inactive']);

		
	    return redirect('admin/members/blocked')->with("message","User Blocked!")->with('style','alert alert-danger');

	}
	public function unblock_member($id){

		DB::table('users')
	            ->where('id', $id)
	            ->update(['block_status' => 'unblocked']);
	    DB::table('stories')
		   		->where('posted_by',$id)
	            ->update(['status' => 'active']);
		
	    return redirect()->back()->with("message","User Unblocked!")->with('style','alert alert-success');

	}


	public function active_stories(){

		$stories = DB::table('stories')
        		->join('users','stories.posted_by', '=', 'users.id')
				->where('stories.status', 'active')
				->select('stories.*','users.name','users.id AS uid','users.user_type')
	            ->orderBy('stories.id', 'desc')
	            ->paginate(10);
		
	    return view('admin.stories')->with('stories',$stories)->with('rows',$stories->count());
	}

	public function unlisted_stories(){

		$stories = DB::table('stories')
        		->join('users','stories.posted_by', '=', 'users.id')
				->where('stories.status', '<>', 'active')
				->select('stories.*','users.name','users.id AS uid','users.user_type')
	            ->orderBy('stories.id', 'desc')
	            ->paginate(10);
		
    	return view('admin.stories')->with('stories',$stories)->with('rows',$stories->count());
	}

	public function story($id){

		$story = DB::table('stories')
        		->join('users','stories.posted_by', '=', 'users.id')
				->where('stories.id', $id)
				->select('stories.*','users.name','users.id AS uid','users.user_type')
	            ->first();


        $comments = DB::table('users')
        		->join('comments','users.id', '=', 'comments.user_id')
                ->where('comments.story_id',$id)
                ->select('comments.*','users.name','users.id AS uid')
                ->paginate(6);


        return view('admin.story')->with('story',$story)->with('comments',$comments);

	}

	public function unlist_story($id){

		$story = DB::table('stories')
				->where('id', $id)
	            ->update(['status' => 'unlisted']);
		
    	return redirect('admin/stories/unlisted');
	}

	public function reactivate_story(Request $request){

		$user = DB::table('users')
				->where('id',$request->user_id)
				->first();

		if($user->block_status == 'blocked'){
			return redirect()->back()->with("message","Failed! User is blocked!")->with('style','alert alert-danger');
		}
		else if($user->active_status == 'inactive'){
			return redirect()->back()->with("message","Failed! User has deactivated his account!")->with('style','alert alert-danger');
		}
		else{

			DB::table('stories')
				->where('id', $request->story_id)
	            ->update(['status' => 'active']);

	        DB::table('stories')
            ->where('id',$request->story_id)
            ->update(['dispute_status' => null]);
		
    		return redirect()->back()->with('message','Story reactivated! Its live now!')->with('style','alert alert-success');  
		}

	}

	public function decline_dispute($id){

		DB::table('stories')
            ->where('id',$id)
            ->update(['dispute_status' => null]);

        return redirect()->back()->with('message','Dispute declined!')->with('style','alert alert-success');  
	}


	public function create_admin(){
		return view('admin.create');
	}

	public function store_admin(StoreAdmin $request){

		// $user_check = DB::table('users')
		//  	->where('user_type','admin')
		//  	->where('email', $request->email)
  //       	->get();

  //       if($user_check){
        
  //       	return redirect()->back()->with('message','Admin with this email already exists. Please enter another email.')->with('style','alert alert-danger');
		// }

		$params = [
	            'user_type' => 'admin',
	            'name' => $request->name,
	            'email' => $request->email,
	            'password' => Hash::make($request->password),
	            'active_status' => 'active',
    			'created_at' => date('Y-m-d G:i:s')
	        ];
	        $response = DB::table('users')
	            ->insert($params);

	            if($response){
	            	return redirect('admin/manage')->with('message','Admin created successfully')->with('style','alert alert-success');
	            }
	            else{
	            	return redirect()->back()->with('message','Failed!')->with('style','alert alert-danger');
	            }

		
	}


	public function manage_admin(Request $request){

		$self_id = $request->session()->get('userInfo')->id;

		$admins = DB::table('users')
				->where('user_type', 'admin')
				->where('id','<>',$self_id)
				->paginate(10);

		$rows = $admins->total();
		
    	return view('admin.admins')->with('admins',$admins)->with('rows',$rows);
	}

	public function view_admin($id){

		// if(session('userId_for_detail')){

		// 	$id = $request->session()->get('userId_for_detail');
		// 	$admin = DB::table('users')
		// 		->where('id', $id)
		// 		->first();

  //   		return view('admin.view_admin')->with('userInfo',$admin);
		// }else{

			$admin = DB::table('users')
				->where('id', $id)
				->first();
    		return view('admin.view_admin')->with('userInfo',$admin);
	//	}

		
	}

	public function delete_admin($id){
		$admin = DB::table('users')
				->where('id', $id)
				->where('user_type','admin')
				->delete();
		
    	return redirect('admin/manage')->with('message','Admin deleted successfully')->with('style','alert alert-success');
	}
	public function profile($id){

		$admin = DB::table('users')
				->where('id', $id)
				->first();
		
    	return view('admin.profile')->with('userInfo',$admin);
	}

	public function member_search(Request $request){

		$search = $request->input('search');

		$response = DB::table('users')
				->where('id',$request->search)
				->orWhere('name', 'LIKE', '%'.$search.'%')
				->orWhere('email', 'LIKE', '%'.$search.'%')
				->orWhere('phone', 'LIKE', '%'.$search.'%')
				->orWhere('dob', 'LIKE', '%'.$search.'%')
				->orWhere('active_status', $search)
				->orWhere('block_status', $search)
				->orderBy('id', 'desc')
				->paginate(10);

		$response->appends(['value' => $search]);

		$rows = $response->total();
		
    	return view('admin.members')
    	->with('userInfo',$response)
    	->with('rows',$rows);
	}

	public function admin_search(Request $request){

		$search = $request->input('search');

		$response = DB::table('users')
				->where('id',$request->search)
				->orWhere('name', 'LIKE', '%'.$search.'%')
				->orWhere('email', 'LIKE', '%'.$search.'%')
				->orderBy('id', 'desc')
				->paginate(10);

		$response->appends(['value' => $search]);

		$rows = $response->total();
		
    	return view('admin.admins')
    	->with('admins',$response)
    	->with('rows',$rows);
	}	


	public function story_search(Request $request){

		// $stories = DB::table('stories')
  //       		->join('users','stories.posted_by', '=', 'users.id')
		// 		->where('stories.status', 'active')
		// 		->select('stories.*','users.name')
	 //            ->orderBy('stories.id', 'desc')
	 //            ->get();

		$search = $request->input('story_search');

		$response = DB::table('stories')
        		->join('users','stories.posted_by', '=', 'users.id')
				->where('stories.id',$search)
				->orWhere('stories.title', 'LIKE', '%'.$search.'%')
				->orWhere('stories.body', 'LIKE', '%'.$search.'%')
				->orWhere('stories.section', 'LIKE', '%'.$search.'%')
				->orWhere('stories.tags', 'LIKE', '%'.$search.'%')
				->orWhere('stories.image_caption', 'LIKE', '%'.$search.'%')
				->orWhere('stories.status', $search)
				->orWhere('users.name', 'LIKE', '%'.$search.'%')
				->orWhere('users.email', $search)
				->select('stories.*','users.name','users.id AS uid','users.user_type')
				->orderBy('stories.id', 'desc')
				->paginate(10);

		$response->appends(['value' => $search]);

		$rows = $response->total();
		
    	return view('admin.stories')
    	->with('stories',$response)
    	->with('rows',$rows);
	}



	public function change_password(ChangePassword $request){

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









	public function delete_user(Request $request){

		if(file_exists(public_path("/images/".$request->user_image))){

            unlink(public_path("/images/".$request->user_image));

        }


  //   	DB::table('stories')
  //   	->where('posted_by',$request->user_id)
  //   	->chunk(100, function($stories)
		// {
		//     foreach ($stories as $story)
		//     {
		        
	 //        	if(file_exists(public_path("/images/".$story->image))){

	 //            unlink(public_path("/images/".$story->image));

	 //        	}
		//     }
		// });

        $stories = DB::table('stories')
        	->where('posted_by',$request->user_id)
        	->get();


        if($stories){
        	foreach($stories as $story){
        	
	        	if(file_exists(public_path("/images/".$story->image))){

	            unlink(public_path("/images/".$story->image));

	        	}
        	}
        }
        
        DB::table('stories')
        	->where('posted_by',$request->user_id)
        	->delete();

        DB::table('comments')
        	->where('user_id',$request->user_id)
        	->delete();

		$res = DB::table('users')
			->where('id',$request->user_id)
			->delete();


		if($res)
		{
			return redirect('/admin/members/active')->with('message','User removed successfully!')->with('style','alert alert-success');
		}else{
			return redirect()->back()->with('message','Failed!')->with('style','alert alert-danger');
		}



	}




	// public function mem_search(){
	// 	return view('admin.member_search_back');
	// }


	// public function member_search_back(Request $request){

	// 	if($request->ajax()){

	// 		$query = $request->get('query');
	// 		if($query != ''){

	// 			$data = DB::table('users')
	// 					->where('name', 'LIKE', '%'.$query.'%')
	// 					->orWhere('email', 'LIKE', '%'.$query.'%')
	// 					->orWhere('phone', 'LIKE', '%'.$query.'%')
	// 					->orderBy('id', 'desc')
	// 					->get();


	// 		}
	// 		else{
	// 			$data = DB::table('users')
	// 					->orderBy('id', 'desc')
	// 					->get();
	// 		}

	// 		$total_row = $data->count();
	// 		if($total_row > 0){

	// 			foreach($data as $row){
	// 				$output .= '
	// 					<tr>
	// 						<td>'.$row->name.'</td>
	// 						<td>'.$row->email.'</td>
	// 						<td>'.$row->phone.'</td>
	// 					</tr>
	// 				';
	// 			}

	// 		}
	// 		else{

	// 			$output = '
	// 			<tr>
	// 				<td align="center">No Data Found</td>

	// 			</tr>';
	// 		}

	// 		$data = array(
	// 			'table_data' => $output,
	// 			'total_data' => $total_data

	// 		);

	// 		echo json_decode($data);
	// 	}

	// }






}
