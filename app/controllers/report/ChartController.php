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
					$query -> where('a', '>', 0) -> orwhere('b', '>', 0) -> orwhere('c', '>', 0) -> orwhere('d', '>', 0) -> orwhere('e', '>', 0) -> orwhere('f', '>', 0) -> orwhere('p', '>', 0) -> orwhere('r', '>', 0);
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
	public function getCombinationAllData($startDate,$endDate){
		$data1 = Report::notFoundCountAll($startDate,$endDate);
		$data2 = Report::drugFoundCountAll($startDate,$endDate);
		$data3 = Report::itemFoundCountAll($startDate,$endDate);
		//$data4 = Report::summaryCount($startDate,$endDate);
		$serie1[] = array('type'=>'column', 'name' => 'พบสิ่งของต้องห้ามอื่นๆ', 'data' => $data3);
		$serie1[] = array('type'=>'column', 'name' => 'พบสารเสพติด-มือถือ-ซิมการ์ด', 'data' => $data2);
		$serie1[] = array('type'=>'column', 'name' => 'ไม่พบ', 'data' => $data1);
		
	
		//$serie1[] = array('type'=>'pie', 'name' => 'รวมทั้งประเทศ', 'data' => $data4);		
		echo json_encode($serie1);	
		
	}

	public function getKhet10Data($startDate,$endDate){
		$rows = array();	
		$row[0] = 'พบสิ่งของต้องห้าม';
		$row[1] = Report::itemFoundCountKhet(10,$startDate,$endDate);
		array_push($rows,$row);
		
		$row[0] = 'พบสารเสพติด';
		$row[1] = Report::drugFoundCountKhet(10,$startDate,$endDate);
		array_push($rows,$row);
		
		$row[0] = 'ไม่พบ';
		$row[1] = Report::notFoundCountKhet(10,$startDate,$endDate);
		array_push($rows,$row);
		echo json_encode($rows);	
		
	}
	public function getKhet01Data($startDate,$endDate){
		$rows = array();	
		$row[0] = 'พบสิ่งของต้องห้าม';
		$row[1] = Report::itemFoundCountKhet(1,$startDate,$endDate);
		array_push($rows,$row);
		
		$row[0] = 'พบสารเสพติด';
		$row[1] = Report::drugFoundCountKhet(1,$startDate,$endDate);
		array_push($rows,$row);
		
		$row[0] = 'ไม่พบ';
		$row[1] = Report::notFoundCountKhet(1,$startDate,$endDate);
		array_push($rows,$row);
		echo json_encode($rows);	
		
	}
	public function getKhet02Data($startDate,$endDate){
		$rows = array();	
		$row[0] = 'พบสิ่งของต้องห้าม';
		$row[1] = Report::itemFoundCountKhet(2,$startDate,$endDate);
		array_push($rows,$row);
		
		$row[0] = 'พบสารเสพติด';
		$row[1] = Report::drugFoundCountKhet(2,$startDate,$endDate);
		array_push($rows,$row);
		
		$row[0] = 'ไม่พบ';
		$row[1] = Report::notFoundCountKhet(2,$startDate,$endDate);
		array_push($rows,$row);
		echo json_encode($rows);	
		
	}
	public function getKhet03Data($startDate,$endDate){
		$rows = array();	
		$row[0] = 'พบสิ่งของต้องห้าม';
		$row[1] = Report::itemFoundCountKhet(3,$startDate,$endDate);
		array_push($rows,$row);
		
		$row[0] = 'พบสารเสพติด';
		$row[1] = Report::drugFoundCountKhet(3,$startDate,$endDate);
		array_push($rows,$row);
		
		$row[0] = 'ไม่พบ';
		$row[1] = Report::notFoundCountKhet(3,$startDate,$endDate);
		array_push($rows,$row);
		echo json_encode($rows);	
		
	}
	public function getKhet04Data($startDate,$endDate){
		$rows = array();	
		$row[0] = 'พบสิ่งของต้องห้าม';
		$row[1] = Report::itemFoundCountKhet(4,$startDate,$endDate);
		array_push($rows,$row);
		
		$row[0] = 'พบสารเสพติด';
		$row[1] = Report::drugFoundCountKhet(4,$startDate,$endDate);
		array_push($rows,$row);
		
		$row[0] = 'ไม่พบ';
		$row[1] = Report::notFoundCountKhet(4,$startDate,$endDate);
		array_push($rows,$row);
		echo json_encode($rows);	
		
	}
	public function getKhet05Data($startDate,$endDate){
		$rows = array();	
		$row[0] = 'พบสิ่งของต้องห้าม';
		$row[1] = Report::itemFoundCountKhet(5,$startDate,$endDate);
		array_push($rows,$row);
		
		$row[0] = 'พบสารเสพติด';
		$row[1] = Report::drugFoundCountKhet(5,$startDate,$endDate);
		array_push($rows,$row);
		
		$row[0] = 'ไม่พบ';
		$row[1] = Report::notFoundCountKhet(5,$startDate,$endDate);
		array_push($rows,$row);
		echo json_encode($rows);	
		
	}
	public function getKhet06Data($startDate,$endDate){
		$rows = array();	
		$row[0] = 'พบสิ่งของต้องห้าม';
		$row[1] = Report::itemFoundCountKhet(6,$startDate,$endDate);
		array_push($rows,$row);
		
		$row[0] = 'พบสารเสพติด';
		$row[1] = Report::drugFoundCountKhet(6,$startDate,$endDate);
		array_push($rows,$row);
		
		$row[0] = 'ไม่พบ';
		$row[1] = Report::notFoundCountKhet(6,$startDate,$endDate);
		array_push($rows,$row);
		echo json_encode($rows);	
		
	}
	public function getKhet07Data($startDate,$endDate){
		$rows = array();	
		$row[0] = 'พบสิ่งของต้องห้าม';
		$row[1] = Report::itemFoundCountKhet(7,$startDate,$endDate);
		array_push($rows,$row);
		
		$row[0] = 'พบสารเสพติด';
		$row[1] = Report::drugFoundCountKhet(7,$startDate,$endDate);
		array_push($rows,$row);
		
		$row[0] = 'ไม่พบ';
		$row[1] = Report::notFoundCountKhet(7,$startDate,$endDate);
		array_push($rows,$row);
		echo json_encode($rows);	
		
	}
	public function getKhet08Data($startDate,$endDate){
		$rows = array();	
		$row[0] = 'พบสิ่งของต้องห้าม';
		$row[1] = Report::itemFoundCountKhet(8,$startDate,$endDate);
		array_push($rows,$row);
		
		$row[0] = 'พบสารเสพติด';
		$row[1] = Report::drugFoundCountKhet(8,$startDate,$endDate);
		array_push($rows,$row);
		
		$row[0] = 'ไม่พบ';
		$row[1] = Report::notFoundCountKhet(8,$startDate,$endDate);
		array_push($rows,$row);
		echo json_encode($rows);	
		
	}
	public function getKhet09Data($startDate,$endDate){
		$rows = array();	
		$row[0] = 'พบสิ่งของต้องห้าม';
		$row[1] = Report::itemFoundCountKhet(9,$startDate,$endDate);
		array_push($rows,$row);
		
		$row[0] = 'พบสารเสพติด';
		$row[1] = Report::drugFoundCountKhet(9,$startDate,$endDate);
		array_push($rows,$row);
		
		$row[0] = 'ไม่พบ';
		$row[1] = Report::notFoundCountKhet(9,$startDate,$endDate);
		array_push($rows,$row);
		echo json_encode($rows);	
		
	}
	
	public function getByLocation($startDate,$endDate,$khetId,$itemId){
		if($itemId == 0)
		{
			return "...";
		}	
		$category = array();
		$category['name'] = 'Location';
		$check	= array();
		$series1 = array();
		$series1['name'] = 'สกัดกั้นก่อนเข้าเรือนจำ';	
		$series2 = array();
		$series2['name'] = 'พบภายในเรือนจำ';
		$startDate = Report::convertYearBtoC($startDate);
		$endDate = Report::convertYearBtoC($endDate);
		$itemAlias = Item::find($itemId)->alias;
		//Specify khet_id
		if($khetId != 0)
		{
			$data1 = ReportSummaryByFoundAt::where('khet_id','=',$khetId)->where('found_date','>=',date("Y-m-d", strtotime($startDate)))->where('found_date','<=',date("Y-m-d", strtotime($endDate)))->where('found_at_id','=',1)->orderBy('location_id')->get();
			$data2 = ReportSummaryByFoundAt::where('khet_id','=',$khetId)->where('found_date','>=',date("Y-m-d", strtotime($startDate)))->where('found_date','<=',date("Y-m-d", strtotime($endDate)))->where('found_at_id','=',2)->orderBy('location_id')->get();		
			$i=0;
			foreach(Location::where('khet_id','=',$khetId)->get() as $temp)
			{
				$check[$temp->name] = $i;	
				$category['data'][] = $temp->name;
				$series1['data'][] = 0;
				$series2['data'][] = 0;
				$i++;
			}
			
			foreach($data2 as $temp)
			{
				$index = $check[Location::find($temp->location_id)->name];	
				$series2['data'][$index] = $series2['data'][$index]+$temp->$itemAlias;
			}
			foreach($data1 as $temp)
			{
				$index = $check[Location::find($temp->location_id)->name];	
				$series1['data'][$index] = $series1['data'][$index]+$temp->$itemAlias;
			}
		}
		//All khet
		else{
			foreach(Khet::all() as $temp)
			{
				$data1 = ReportSummaryByFoundAt::where('found_date','>=',date("Y-m-d", strtotime($startDate)))->where('found_date','<=',date("Y-m-d", strtotime($endDate)))->where('found_at_id','=',1)->where('khet_id','=',$temp->id)->sum($itemAlias);
				$data2 = ReportSummaryByFoundAt::where('found_date','>=',date("Y-m-d", strtotime($startDate)))->where('found_date','<=',date("Y-m-d", strtotime($endDate)))->where('found_at_id','=',2)->where('khet_id','=',$temp->id)->sum($itemAlias);		
				$category['data'][] = $temp->name;
				$series1['data'][] = $data1;
				$series2['data'][] = $data2;
			}
		}
		$result = array();
		array_push($result,$category);
		array_push($result,$series1);
		array_push($result,$series2);
		//$serie1[] = array('type'=>'pie', 'name' => 'รวมทั้งประเทศ', 'data' => $data4);		
		echo json_encode($result, JSON_NUMERIC_CHECK);	
		
	}
	
}
?>