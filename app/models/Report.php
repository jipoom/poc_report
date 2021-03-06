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
	public function area()
	{
		return $this->belongTo('Area','area_id');
	}
	public function found_at()
	{
		return $this->belongTo('FoundAt','found_at_id');
	}
	public function khet()
	{
		return $this->belongTo('Khet','khet_id');
	}
	public function specialMethod()
	{
		return $this->belongTo('special_method','special_method_id');
	}
	public function note()
	{
		return $this->belongTo('Note','note_id');
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
	public static function getTotal($locationId,$startDate,$endDate){
		 $location_id = $locationId;
		 $khetId = Location::find($locationId)->khet_id;
		 $startDate= date("Y-m-d", strtotime($startDate));	
		 $endDate= date("Y-m-d", strtotime($endDate));	
		 $transaction = DB::table('report')->select('item_id', DB::raw('SUM(qty) as sum'))
		 ->where('found_date','>=',$startDate)
		 ->where('found_date','<=',$endDate)
		 ->where('location_id','=',$location_id)
		 ->where('is_confirmed','=',1)
		 ->groupBy('item_id')
		 ->get();
		 
		 
		 $normalInspectCount = Report::select(DB::raw('COUNT(*) as total'))
                ->from(DB::raw('(SELECT distinct(found_date) FROM report where location_id = '.$locationId.' and method_id = 1) AS T'))
                ->where('found_date','>=',$startDate)
		 		->where('found_date','<=',$endDate)
                ->first()->total;
		 $specialInspectCount = Report::select(DB::raw('COUNT(*) as total'))
                ->from(DB::raw('(SELECT distinct(found_date) FROM report where location_id = '.$locationId.' and method_id = 2) AS T'))
                ->where('found_date','>=',$startDate)
		 		->where('found_date','<=',$endDate)
                ->first()->total;
                
		$notFoundCount = Report::select(DB::raw('COUNT(*) as total'))
                ->from(DB::raw('(SELECT distinct(found_date) FROM report where location_id = '.$locationId.' and item_id = 0) AS T'))
                ->where('found_date','>=',$startDate)
		 		->where('found_date','<=',$endDate)
                ->first()->total;
		$foundCount = Report::select(DB::raw('COUNT(*) as total'))
                ->from(DB::raw('(SELECT distinct(found_date) FROM report where location_id = '.$locationId.' and item_id <> 0) AS T'))
                ->where('found_date','>=',$startDate)
		 		->where('found_date','<=',$endDate)
                ->first()->total;
		 //Don't forget to check not found item
		 $allItems = Item::where('id','<>',0)->get();
		 $itemFound = array();
		 $itemFound = array_add($itemFound, 'วันที่', 'สรุปยอด');
		 $itemFound = array_add($itemFound, 'เขต', Khet::find($khetId)->name);
		 $itemFound = array_add($itemFound, 'เรือนจำ', Location::find($locationId)->name);
		 $itemFound = array_add($itemFound, 'จำนวนครั้งการจู่โจมกรณีปกติ', $normalInspectCount);
		 $itemFound = array_add($itemFound, 'จำนวนครั้งการจู่โจมกรณีพิเศษ', $specialInspectCount);
		 $itemFound = array_add($itemFound, 'ไม่พบ', $notFoundCount);
		 $itemFound = array_add($itemFound, 'พบ', $foundCount);
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
	public static function generateReportRow($locationId,$startDate,$endDate){
		 $firstDate = $startDate;
		 $khetId = Location::find($locationId)->khet_id;
		 $startDate= date("Y-m-d", strtotime($startDate));		
		 $endDate= date("Y-m-d", strtotime($endDate));	
		 $i=0;
		 $reportTotal = array();		
		 while(strtotime($startDate) <= strtotime($endDate))
		 {
					
			 $transaction = DB::table('report')->select('item_id', DB::raw('SUM(qty) as sum'))
			 ->where('found_date','=',$startDate)
			 ->where('location_id','=',$locationId)
			 ->where('is_confirmed','=',1)
			 ->groupBy('item_id')
			 ->get();
			 
			 if(count($transaction)>0)
			 {
			 	$normalInspectCount = Report::select(DB::raw('COUNT(*) as total'))
                ->from(DB::raw('(SELECT distinct(found_date) FROM report where location_id = '.$locationId.' and method_id = 1) AS T'))
                ->where('found_date','=',$startDate)
                ->first()->total;
				 $specialInspectCount = Report::select(DB::raw('COUNT(*) as total'))
	                ->from(DB::raw('(SELECT distinct(found_date) FROM report where location_id = '.$locationId.' and method_id = 2) AS T'))
	                ->where('found_date','=',$startDate)
	                ->first()->total;
	                
				$notFoundCount = Report::select(DB::raw('COUNT(*) as total'))
	                ->from(DB::raw('(SELECT distinct(found_date) FROM report where location_id = '.$locationId.' and item_id = 0) AS T'))
	                ->where('found_date','=',$startDate)
	                ->first()->total;
				$foundCount = Report::select(DB::raw('COUNT(*) as total'))
	                ->from(DB::raw('(SELECT distinct(found_date) FROM report where location_id = '.$locationId.' and item_id <> 0) AS T'))
	                ->where('found_date','=',$startDate)
	                ->first()->total;
			     $allItems = Item::where('id','<>',0)->get();
				 $itemFound = array();
				 $itemFound = array_add($itemFound, 'วันที่', Report::convertYearCtoB(date('d-m-Y', strtotime($startDate))));
				 $itemFound = array_add($itemFound, 'เขต', Khet::find($khetId)->name);
				 $itemFound = array_add($itemFound, 'เรือนจำ', Location::find($locationId)->name);
				 $itemFound = array_add($itemFound, 'จำนวนครั้งการจู่โจมกรณีปกติ', $normalInspectCount);
				 $itemFound = array_add($itemFound, 'จำนวนครั้งการจู่โจมกรณีพิเศษ', $specialInspectCount);
				 $itemFound = array_add($itemFound, 'ไม่พบ', $notFoundCount);
				 $itemFound = array_add($itemFound, 'พบ', $foundCount);
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
				 $reportTotal = array_add($reportTotal,$startDate,$itemFound);
			 }	
			$startDate = date('Y-m-d', strtotime($startDate . " +1 day"));
			$i++;	
			
			}
		
			//$total = Report::getTotal($locationId, $firstDate, $endDate);
			//$reportTotal = array_add($reportTotal,'รวม',$total);
			return $reportTotal;	
		}
		
	public static function notFoundCountAll($startDate,$endDate){
		$startDate = Report::convertYearBtoC($startDate);
		$endDate = Report::convertYearBtoC($endDate);	
		$startDate= date("Y-m-d", strtotime($startDate));	
		$endDate= date("Y-m-d", strtotime($endDate));	
		$khet10 = count(ReportSummaryByFoundAt::where('found_date','>=',$startDate)
				->where('found_date','<=',$endDate)
				->where('khet_id','=',10)
				->where('found_at_id','=',0)->distinct()
				->get(array('location_id')));
		$result = array();
		$result[0] = $khet10;
		for($i=1;$i<10;$i++){
			$temp = count(ReportSummaryByFoundAt::where('found_date','>=',$startDate)
				->where('found_date','<=',$endDate)
				->where('khet_id','=',$i)
				->where('found_at_id','=',0)->distinct()
				->get(array('location_id')));
			$result[$i] = $temp;
		}
		return $result;
	}
	public static function drugFoundCountAll($startDate,$endDate){
		$startDate = Report::convertYearBtoC($startDate);
		$endDate = Report::convertYearBtoC($endDate);	
		$startDate= date("Y-m-d", strtotime($startDate));	
		$endDate= date("Y-m-d", strtotime($endDate));	
		$khet10 = count(ReportSummary::
				where('found_date','>=',$startDate)
				->where('found_date','<=',$endDate)
				->where('khet_id','=',10)
				->where(function($query) {
					$query -> where('a', '>', 0) -> orwhere('b', '>', 0) -> orwhere('c', '>', 0) -> orwhere('d', '>', 0) -> orwhere('e', '>', 0) -> orwhere('f', '>', 0) -> orwhere('p', '>', 0) -> orwhere('r', '>', 0);
				})
				->distinct()
				->get(array('location_id')));
		$result = array();
		$result[0] = $khet10;
		for($i=1;$i<10;$i++){
			$temp = count(ReportSummary::
				where('found_date','>=',$startDate)
				->where('found_date','<=',$endDate)
				->where('khet_id','=',$i)
				->where(function($query) {
					$query -> where('a', '>', 0) -> orwhere('b', '>', 0) -> orwhere('c', '>', 0) -> orwhere('d', '>', 0) -> orwhere('e', '>', 0) -> orwhere('f', '>', 0)-> orwhere('p', '>', 0) -> orwhere('r', '>', 0);;
				})
				->distinct()
				->get(array('location_id')));
			$result[$i] = $temp;
		}
		return $result;
	}
	public static function itemFoundCountAll($startDate,$endDate){
		$startDate = Report::convertYearBtoC($startDate);
		$endDate = Report::convertYearBtoC($endDate);	
		$startDate= date("Y-m-d", strtotime($startDate));	
		$endDate= date("Y-m-d", strtotime($endDate));	
		$khet10 = count(ReportSummary::
				where('found_date','>=',$startDate)
				->where('found_date','<=',$endDate)
				->where('khet_id','=',10)
				->where(function($query) {
					$query -> where('g', '>', 0) -> orwhere('h', '>', 0) -> orwhere('i', '>', 0) -> orwhere('j', '>', 0) 
					-> orwhere('k', '>', 0) -> orwhere('l', '>', 0)-> orwhere('m', '>', 0) -> orwhere('n', '>', 0)
					-> orwhere('o', '>', 0) -> orwhere('q', '>', 0)-> orwhere('s', '>', 0) -> orwhere('t', '>', 0)
					-> orwhere('u', '>', 0) -> orwhere('v', '>', 0) -> orwhere('w', '>', 0);
				})
				->distinct()
				->get(array('location_id')));
		$result = array();
		$result[0] = $khet10;
		for($i=1;$i<10;$i++){
			$temp = count(ReportSummary::
				where('found_date','>=',$startDate)
				->where('found_date','<=',$endDate)
				->where('khet_id','=',$i)
				->where(function($query) {
					$query -> where('g', '>', 0) -> orwhere('h', '>', 0) -> orwhere('i', '>', 0) -> orwhere('j', '>', 0) 
					-> orwhere('k', '>', 0) -> orwhere('l', '>', 0)-> orwhere('m', '>', 0) -> orwhere('n', '>', 0)
					-> orwhere('o', '>', 0) -> orwhere('q', '>', 0)-> orwhere('s', '>', 0) -> orwhere('t', '>', 0)
					-> orwhere('u', '>', 0) -> orwhere('v', '>', 0) -> orwhere('w', '>', 0);
				})
				->distinct()
				->get(array('location_id')));
			$result[$i] = $temp;
		}
		return $result;
	}
	public static function summaryCount($startDate,$endDate){
		$rows = array();
		$result = Report::notFoundCountAll($startDate,$endDate);
		$ans = 0;
		foreach($result as $r){
			$ans+=$r;
		}	
		$row[0] = 'ไม่พบ';
		$row[1] = $ans;
		array_push($rows,$row);
		
		$result = Report::drugFoundCountAll($startDate,$endDate);
		$ans = 0;
		foreach($result as $r){
			$ans+=$r;
		}	
		$row[0] = 'พบสารเสพติด';
		$row[1] = $ans;
		array_push($rows,$row);
		
		$result = Report::itemFoundCountAll($startDate,$endDate);
		$ans = 0;
		foreach($result as $r){
			$ans+=$r;
		}	
		$row[0] = 'พบสิ่งของต้องห้าม';
		$row[1] = $ans;
		array_push($rows,$row);
		return $rows;
	}
	
	
	public static function notFoundCountKhet($khetId,$startDate,$endDate){
		$startDate = Report::convertYearBtoC($startDate);
		$endDate = Report::convertYearBtoC($endDate);	
		$startDate= date("Y-m-d", strtotime($startDate));	
		$endDate= date("Y-m-d", strtotime($endDate));	
		return count(ReportSummaryByFoundAt::where('found_date','>=',$startDate)
				->where('found_date','<=',$endDate)
				->where('khet_id','=',$khetId)
				->where('found_at_id','=',0)->whereRaw('location_id not in (select location_id from summary_by_found_at where found_at_id <> 0)')->distinct()
				->get(array('location_id')));
	}
	public static function drugFoundCountKhet($khetId,$startDate,$endDate){
		$startDate = Report::convertYearBtoC($startDate);
		$endDate = Report::convertYearBtoC($endDate);	
		$startDate= date("Y-m-d", strtotime($startDate));	
		$endDate= date("Y-m-d", strtotime($endDate));	
		return count(ReportSummary::
				where('found_date','>=',$startDate)
				->where('found_date','<=',$endDate)
				->where('khet_id','=',$khetId)
				->where(function($query) {
					$query -> where('a', '>', 0) -> orwhere('b', '>', 0) -> orwhere('c', '>', 0) -> orwhere('d', '>', 0) -> orwhere('e', '>', 0) -> orwhere('f', '>', 0)-> orwhere('p', '>', 0) -> orwhere('r', '>', 0);
				})
				->distinct()
				->get(array('location_id')));
	}
	public static function itemFoundCountKhet($khetId,$startDate,$endDate){
		$startDate = Report::convertYearBtoC($startDate);
		$endDate = Report::convertYearBtoC($endDate);	
		$startDate= date("Y-m-d", strtotime($startDate));	
		$endDate= date("Y-m-d", strtotime($endDate));	
		return count(ReportSummary::
				where('found_date','>=',$startDate)
				->where('found_date','<=',$endDate)
				->where('khet_id','=',$khetId)
				->where(function($query) {
					$query -> where('g', '>', 0) -> orwhere('h', '>', 0) -> orwhere('i', '>', 0) -> orwhere('j', '>', 0) 
					-> orwhere('k', '>', 0) -> orwhere('l', '>', 0)-> orwhere('m', '>', 0) -> orwhere('n', '>', 0)
					-> orwhere('o', '>', 0) -> orwhere('q', '>', 0)-> orwhere('s', '>', 0) -> orwhere('t', '>', 0)
					-> orwhere('u', '>', 0) -> orwhere('v', '>', 0) -> orwhere('w', '>', 0);
				})
				->distinct()
				->get(array('location_id')));
	}
	
	
	

}

?>