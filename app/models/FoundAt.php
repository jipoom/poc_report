<?php


class FoundAt extends Eloquent {	
	public $timestamps = false;
    protected $table = 'found_at';
	public function report()
	{
		return $this->hasMany('Report');
	}
	public static function getArray(){
		$item = array('0'=>'ทั้งหมด');	
		$item = array_merge($item,FoundAt::all()->lists('name','id'));		
		return $item;
	}
}

?>