<?php


class SpecialMethod extends Eloquent {	
	public $timestamps = false;
    protected $table = 'special_method';
	public function report()
	{
		return $this->hasMany('Report');
	}
}

?>