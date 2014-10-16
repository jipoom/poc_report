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
	public static function generateReportRow($locationId,$startDate,$endDate){
		 $location_id = 2;
		 $startDate= date("Y-m-d", strtotime($startDate));	
		 $endDate= date("Y-m-d", strtotime($endDate));	
		 $transaction = DB::table('report')->select('item_id', DB::raw('SUM(qty) as sum'))
		 ->where('found_date','>=',$startDate)
		 ->where('found_date','<=',$endDate)
		 ->where('location_id','=',$location_id)
		 ->groupBy('item_id')
		 ->get();
		 $inspectCount = Report::where('found_date','>=',$startDate)
		 ->where('found_date','<=',$endDate)
		 ->groupBy('location_id')
		 ->get();
		 //Don't forget to check not found item
		 $allItems = Item::where('id','<>',0)->get();
		 $itemFound = array();
		 $itemFound = array_add($itemFound, 'จำนวนครั้งการจู่โจม', count($inspectCount));
		 foreach($allItems as $item)
		 {
			 $match = false;	
			 foreach($transaction as $t){
				if($t->item_id == $item->id){
					$itemFound = array_add($itemFound, $t->item_id, $t->sum);
					//echo "match...";
					//echo $item->name."...";
					//echo $t->sum."...";
					//echo $item->id."<br>";
					$match = true;
					break;
				}						
			 }
			 if(!$match){
			 	$itemFound = array_add($itemFound, $item->id, 0);
				//echo "not match...";
				//echo $item->name."...";
				//echo $item->id."<br>";
			 }
		 }
		 return $itemFound;
	}
}

?>