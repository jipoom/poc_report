<?php


class Role extends Eloquent {	
	public $timestamps = false;
    protected $table = 'roles';
	public function user()
	{
		return $this->hasMany('User');
	}
}

?>