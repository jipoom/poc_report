<?php

class ChartController extends BaseController {
	
	public function getDashBoardDrugData($startDate,$endDate){
			
		$startDate = Report::convertYearBtoC($startDate);
		$endDate = Report::convertYearBtoC($endDate);	
		$startDate= date("Y-m-d", strtotime($startDate));	
		$endDate= date("Y-m-d", strtotime($endDate));	
		$rows = array();
		$i=1;
		foreach(Khet::all() as $khet){
				$temp = ReportSummary::
				where('found_date','>=',$startDate)
				->where('found_date','<=',$endDate)
				->where('khet_id','=',$khet->id)
				->where(function($query) {
					$query -> where('a', '>', 0) -> orwhere('b', '>', 0) -> orwhere('c', '>', 0) -> orwhere('d', '>', 0) -> orwhere('e', '>', 0) -> orwhere('f', '>', 0);
				})
				->distinct()
				->get(array('location_id'));
			
				if($i==10)
					$row[0] = 'เขตอิสระ';
				else
					$row[0] = 'เขต'.$i;
				$row[1] = count($temp);
				array_push($rows,$row);
				$i++;
		}
		echo json_encode($rows);
	}
}
?>