<?php


class Category extends Eloquent {	
	public $timestamps = false;
    protected $table = 'category';
	public function items()
	{
		return $this->hasMany('Item');
	}
	public static function getArrayWithAll()
	{
		$item = array('0'=>'ทั้งหมด');	
		$item = array_merge($item,Category::all()->lists('name','id'));		
		return $item;
	}
}

?>