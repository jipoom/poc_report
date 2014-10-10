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
		$init_item = Item::where('id','<>',0)->where('id','<>',1)->first();
		$item = array_add($item,$init_item->id, $init_item->name);
		$allitem = Item::where('id','<>',0)->where('id','<>',1)->get();
		foreach($allitem as $temp)
		{
			$item = array_add($item, $temp->id, $temp->name);
		}
		$item = array_add($item, 1, 'อื่นๆ');
		return $item;
	}
}

?>