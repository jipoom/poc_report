<?php


class Item extends Eloquent {	
	public $timestamps = false;
    protected $table = 'items';
	public function report()
	{
		return $this->hasMany('Report');
	}
	public function category()
	{
		return $this->belongTo('Category','category_id');
	}
}

?>