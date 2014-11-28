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
	public function getCombinationNotFoundData($startDate,$endDate){
		//$result = Report::notFoundCount($startDate,$endDate);
		//echo json_encode($result);	
	}
	public function getCombinationDrugFoundData($startDate,$endDate){
		
		//echo json_encode($result);	
	}
	public function getCombinationItemFoundData($startDate,$endDate){
		
		//echo json_encode($result);		
		
	}
	public function getCombinationAllData($startDate,$endDate){
		$rows = array();	
		$row[0] = 'ไม่พบ';
		$row[1] = 10;
		array_push($rows,$row);
		
		$row[0] = 'พบยาเสพติด';
		$row[1] = 20;
		array_push($rows,$row);
		
		$row[0] = 'พบสิ่งของต้องห้าม';
		$row[1] = 30;
		array_push($rows,$row);
		$data1 = Report::notFoundCount($startDate,$endDate);
		$data2 = Report::drugFoundCount($startDate,$endDate);
		$data3 = Report::itemFoundCount($startDate,$endDate);
		$data4 = Report::summaryCount($startDate,$endDate);
		$serie1[] = array('type'=>'column', 'name' => 'ไม่พบ', 'data' => $data1);
		$serie1[] = array('type'=>'column', 'name' => 'พบสารเสพติด', 'data' => $data2);
		$serie1[] = array('type'=>'column', 'name' => 'พบสิ่งของต้องห้าม', 'data' => $data3);
		$serie1[] = array('type'=>'pie', 'name' => 'รวมทั้งประเทศ', 'data' => $data4);		
		echo json_encode($serie1);	
		
	}
}
?>