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
		$locations = Location::orderBy('name')->lists('name','id');	
		return View::make('user/create',compact('locations'));
	}
	public function postCreate(){
		$rules = array('username' => 'required|min:3|unique:users', 
		'password'=>'required|alpha_num|confirmed',
    	'password_confirmation'=>'required|alpha_num'
		);
		

		// Validate the inputs
		$validator = Validator::make(Input::all(), $rules);
		//$image = Post::findImages(Input::get('content'));
		// Check if the form validates with success
		if ($validator -> passes()) {
			$user = new User;
			$user->username	= Input::get('username');
			$user->password	= Hash::make(Input::get('password'));
			$user->location_id = Input::get('location');
			$user->role_id = 3;
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
			return Redirect::to('report/dashboard');
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
	public function getCreateBulkUsers(){
		User::add('poptran','nwq3zq','รจ.จ.ตรัง');
		User::add('popnara','5dew3s','รจ.จ.นราธิวาส');
		User::add('poppatt','v2whpd','รจ.ก.ปัตตานี');
		User::add('coppata','jmdeau','รจ.ก.พัทลุง');
		User::add('coppata1','f8n4zw','รจ.พ.พัทลุง');
		User::add('odcbanna','bjmhry','ทส.ป.บ้านนาวง');
		User::add('copyala','3uq2cy','รจ.ก.ยะลา');
		User::add('aopbato','6e9wnt','รจ.อ.เบตง');
		User::add('copsong','efrq8h','รจ.ก.สงขลา');
		User::add('popsong','zt4yp5','รจ.จ.สงขลา');
		User::add('fdcsong','zwf9sc','ทส.ญ.สงขลา');
		User::add('tdcsong','88b2u4','ทส.บ.สงขลา');
		User::add('popsatu','9qtexs','รจ.จ.สตูล');
		User::add('aopnatv','aerb7v','รจ.อ.นาทวี');
		//User::add('inctrad','bj46mv','สถานกักขังกลางจังหวัดตราด');
	}

}
