<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	
	public function role()
	{
		return $this->belongsTo('Role', 'role_id');
	}
	public function location()
	{
		return $this->belongsTo('Location', 'location_id');
	}
	public static function add($username,$pwd,$location){
		$user = new User;
		$user->username	= $username;
		$user->password	= Hash::make($pwd);
		$user->location_id = Location::where('name','=',$location)->first()->id;
		$user->role_id = 3;
		$user->save();
	}

}
