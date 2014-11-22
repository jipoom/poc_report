<?php


class Method extends Eloquent {	
	public $timestamps = false;
    protected $table = 'methods';
	public function report()
	{
		return $this->hasMany('Report');
	}
	public static function getArray()
	{
		$item= array();	
		$init_item = Method::all()->first();
		$item = array_add($item,$init_item->id, $init_item->name);
		$allitem = Method::all();
		foreach($allitem as $temp)
		{
			$item = array_add($item, $temp->id, $temp->name);
		}
		return $item;
	}
	public static function getArrayWithAll()
	{
		$item = array('0'=>'ทั้งหมด');	
		$item = array_merge($item,Method::all()->lists('name','id'));		
		return $item;
	}
}

?>