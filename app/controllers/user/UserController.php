<?php

class UserController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	public function getCreate(){
		$roles = Role::all()->lists('role','id');		
		return View::make('user/create',compact('roles'));
	}
	public function postCreate(){
		$rules = array('username' => 'required|min:3|unique:users', 
		'description' => 'required|min:3', 
		'password'=>'required|alpha_num|between:6,12|confirmed',
    	'password_confirmation'=>'required|alpha_num|between:6,12'
		);
		

		// Validate the inputs
		$validator = Validator::make(Input::all(), $rules);
		//$image = Post::findImages(Input::get('content'));
		// Check if the form validates with success
		if ($validator -> passes()) {
			$user = new User;
			$user->username	= Input::get('username');
			$user->password	= Hash::make(Input::get('password'));
			$user->description	= Input::get('description');
			$user->role_id = Input::get('role');
			$user->save();
			return Redirect::to('/')->with('message', 'Create user succeeded');
		}
		return Redirect::to('user/create')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		
	}
	public function getLogin()
	{
		// Show Login Page
		return View::make('user/login');
	}
	public function PostLogin()
	{
		// Verify Username and Pwd
		$user = array(
            'username' => Input::get('username'),
            'password' => Input::get('password'),
			//'active' => 1
        );
	  	if (Auth::attempt($user))
		{
			return Redirect::to('/');
			//return View::make('user/profile');
		}
		else {
			return Redirect::to('user/login')
			        ->with('message', 'Your username/password combination was incorrect')
			        ->withInput();
			} 
	}
	public function getLogout(){
		Session::flush();
		return Redirect::to('/')->with('message','You have logged out!!');		
	}

}
