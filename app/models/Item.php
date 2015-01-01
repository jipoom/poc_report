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
	public static function getAllItemArray()
	{
		$item= array();	
		$init_item = Item::where('id','<>',0)->first();
		$item = array_add($item,$init_item->id, $init_item->name);
		$allitem = Item::where('id','<>',0)->get();
		foreach($allitem as $temp)
		{
			$item = array_add($item, $temp->id, $temp->name);
		}
		return $item;
	}
	public static function getArrayNotAll()
	{
		$item = array('0'=>'ระบุชนิดสิ่งของต้องห้าม');	
		$item = array_merge($item,Item::where('id','<>',0)->get()->lists('name','id'));		
		return $item;
	}
}

?>