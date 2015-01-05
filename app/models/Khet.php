<?php


class Khet extends Eloquent {	
	public $timestamps = false;
    protected $table = 'khets';
	public function report()
	{
		return $this->hasMany('Report');
	}
	public static function getArray(){
		$khet = array('0'=>'เลือกทุกเขต');	
		$khet = array_merge($khet,Khet::all()->lists('name','id'));		
		return $khet;
	}
	public static function getArrayNotAll(){
		$khet = array('0'=>'ระบุเขต');	
		$khet = array_merge($khet,Khet::all()->lists('name','id'));		
		return $khet;
	}
	public static function getArrayCustomFirstRecord($customName){
		$khet = array('0'=>$customName);	
		$khet = array_merge($khet,Khet::all()->lists('name','id'));		
		return $khet;
	}
}

?>