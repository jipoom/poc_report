<?php


class Note extends Eloquent {	
	public $timestamps = false;
    protected $table = 'note';
	public function report()
	{
		return $this->hasMany('Report');
	}
}

?>