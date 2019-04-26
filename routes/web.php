<?php

Route::get('/', 'HomeController@index');
Route::get('search', 'StoryController@search');
Route::get('section/{section}', 'StoryController@section')->name('sort.section');
Route::get('story/{id}/', 'StoryController@view');

Route::get('login', 'LoginController@index');
Route::post('login', 'LoginController@verify');
Route::get('logout', 'LogoutController@index');
Route::get('registration', 'LoginController@register');
Route::post('registration', 'UserController@create')->name('register.save');



Route::group(['middleware' => ['sess']], function () {

	//Helper Controller
	Route::get('check', 'HelperController@check');
	//Home Controller
	Route::get('home', 'HomeController@index');

	//User Controllers
	Route::get('dashboard', 'UserController@dashboard')->name('user.dashboard');
	Route::get('profile/{id}', 'UserController@detail')->name('user.profile');
	Route::put('profile/{id}/deactivate', 'UserController@deactivate');
	Route::get('profile/{id}/edit', 'UserController@edit');
	Route::put('profile/{id}/edit', 'UserController@update');
	Route::put('profile/{id}/edit/password', 'UserController@change');
	

	//Story Controller
	Route::get('stories', 'StoryController@stories')->name('stories');
	Route::get('story/new/create', 'StoryController@create')->name('story.create');
	Route::post('story/create', 'StoryController@store');
	Route::get('dashboard/story/{id}', 'StoryController@show');
	Route::put('dashboard/story/{id}', 'StoryController@dispute');
	Route::get('dashboard/story/{id}/edit', 'StoryController@edit');
	Route::put('dashboard/story/{id}/edit', 'StoryController@update');
	Route::delete('dashboard/story/{id}/edit', 'StoryController@destroy');
	

	//Admin Controller
	Route::get('dashboard/admin', 'AdminController@dashboard')->name('admin.dashboard');


	Route::get('admin/members/active', 'AdminController@active_members')->name('member.active');
	Route::get('admin/members/inactive', 'AdminController@inactive_members')->name('member.inactive');
	Route::get('admin/members/blocked', 'AdminController@blocked_members')->name('member.blocked');
	Route::get('admin/members/{userId}/{userType}', 'AdminController@member_detail');
	Route::put('admin/members/{id}/block', 'AdminController@block_member');
	Route::put('admin/members/{id}/unblock', 'AdminController@unblock_member');
	Route::delete('admin/members/{id}/delete', 'AdminController@delete_user');



	Route::get('admin/stories/active', 'AdminController@active_stories')->name('stories.active');
	Route::get('admin/stories/unlisted', 'AdminController@unlisted_stories')->name('stories.unlisted');
	Route::get('admin/story/{id}', 'AdminController@story');
	Route::put('admin/story/{id}', 'AdminController@decline_dispute');
	Route::put('admin/story/{id}/unlist', 'AdminController@unlist_story');
	Route::put('admin/story/{id}/reactivate', 'AdminController@reactivate_story');



	Route::get('admin/create/new', 'AdminController@create_admin')->name('admin.create');
	Route::post('admin/create/new', 'AdminController@store_admin');
	Route::get('admin/manage', 'AdminController@manage_admin')->name('admin.manage');
	Route::get('admin/manage/{id}', 'AdminController@view_admin');
	Route::delete('admin/manage/{id}/delete', 'AdminController@delete_admin');
	Route::get('admin/profile/{id}', 'AdminController@profile')->name('admin.profile');



	Route::get('admin/members/search', 'AdminController@member_search');

	Route::get('admin/search', 'AdminController@admin_search')->name('admin.search');

	Route::get('admin/stories/search', 'AdminController@story_search');
	Route::put('admin/profile/{id}/edit/password', 'AdminController@change_password');


	//Comment Controller
	Route::put('story/{id}/comment', 'CommentController@create');
	Route::delete('story/{id}/comment', 'CommentController@owner_remove');
	Route::delete('admin/comment/{id}/remove', 'CommentController@admin_remove');

});