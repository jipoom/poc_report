<?php


class Area extends Eloquent {	
	public $timestamps = false;
    protected $table = 'area';
	public function report()
	{
		return $this->hasMany('Report');
	}
}

?>