<?php


class Category extends Eloquent {	
	public $timestamps = false;
    protected $table = 'category';
	public function items()
	{
		return $this->hasMany('Item');
	}
}

?>