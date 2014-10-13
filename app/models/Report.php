<?php


class Report extends Eloquent {	
	public $timestamps = false;
    protected $table = 'report';
	public function item()
	{
		return $this->belongTo('Item','item_id');
	}
	public function method()
	{
		return $this->belongTo('Method','method_id');
	}
	public function found_at()
	{
		return $this->belongTo('FoundAt','found_at_id');
	}
	public static function convertYearBtoC($date){
		$cYear = substr($date,count($date)-5,4);
		$dayMonth= substr($date,0,count($date)-5);
		$cYear = $cYear-543;
		return $dayMonth.$cYear;
	} 
	public static function convertYearCtoB($date){
		$bYear = substr($date,count($date)-5,4);
		$dayMonth= substr($date,0,count($date)-5);
		$bYear = $bYear+543;
		return $dayMonth.$bYear;
	} 
}

?>