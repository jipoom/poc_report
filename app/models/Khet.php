<?php


class Khet extends Eloquent {	
	public $timestamps = false;
    protected $table = 'khets';
	public function report()
	{
		return $this->hasMany('Report');
	}
}

?>