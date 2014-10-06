<?php


class FoundAt extends Eloquent {	
	public $timestamps = false;
    protected $table = 'found_at';
	public function report()
	{
		return $this->hasMany('Report');
	}
}

?>