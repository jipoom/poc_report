<?php

class ReportController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	
	
	
	public function showStandAlone(){
		return View::make('report/poc_standalone');
	}
	public function getDashBoard($startDate=null,$endDate=null){
		if(Auth::user()->role_id !=3 )
		{	
			$buddhistYear = date('Y',strtotime(date('d-m-Y')))+543;		
			if($startDate==null || $endDate == null)
			{
				//grab most recent date
				$startDate=ReportSummary::orderBy('found_date','desc')->first()->found_date;	
				//$startDate=Report::convertYearCtoB(date('d-m-Y',strtotime($startDate)));
				//$startDate=date('Y-m-d',strtotime("-1 days"));
				$endDate = $startDate;
			}	
			else{
				$startDate = Report::convertYearBtoC($startDate);
				$endDate = Report::convertYearBtoC($endDate);
			}
			
			$inspect = ReportSummary::
				where('found_date','>=',date("Y-m-d", strtotime($startDate)))
				->where('found_date','<=',date("Y-m-d", strtotime($endDate)));
				//->distinct('location_id')
				//->get(array('location_id','khet_id'));
			
			$drugAndItem = ReportSummary::
				where('found_date','>=',date("Y-m-d", strtotime($startDate)))
				->where('found_date','<=',date("Y-m-d", strtotime($endDate)))
				->where(function($query) {
					$query -> where('a', '>', 0) -> orwhere('b', '>', 0) -> orwhere('c', '>', 0) -> orwhere('d', '>', 0) -> orwhere('e', '>', 0) -> orwhere('f', '>', 0) -> orwhere('p', '>', 0) -> orwhere('r', '>', 0);
				});
				//->distinct('location_id')
				//->get(array('location_id','khet_id'));
				
			$other = ReportSummary::
				where('found_date','>=',date("Y-m-d", strtotime($startDate)))
				->where('found_date','<=',date("Y-m-d", strtotime($endDate)))
				->where(function($query) {
					$query -> where('g', '>', 0) -> orwhere('h', '>', 0) -> orwhere('i', '>', 0) -> orwhere('j', '>', 0) -> orwhere('k', '>', 0) -> orwhere('l', '>', 0) -> orwhere('m', '>', 0) -> orwhere('n', '>', 0) 
					-> orwhere('o', '>', 0) -> orwhere('q', '>', 0) -> orwhere('s', '>', 0) -> orwhere('t', '>', 0) -> orwhere('u', '>', 0) -> orwhere('v', '>', 0) -> orwhere('w', '>', 0);
				});
				//->distinct('location_id')
				//->get(array('location_id','khet_id'));
				
			$notFound = ReportSummaryByFoundAt::
				where('found_date','>=',date("Y-m-d", strtotime($startDate)))
				->where('found_date','<=',date("Y-m-d", strtotime($endDate)))
				->where('found_at_id','=',0)->whereRaw('location_id not in (select location_id from summary_by_found_at where found_at_id <> 0)');
			
			$startDate = Report::convertYearCtoB(date('d-m-Y',strtotime($startDate)));
			$endDate = Report::convertYearCtoB(date('d-m-Y',strtotime($endDate)));
			
			
			
			return View::make('report/dashboard',compact('buddhistYear','startDate','endDate','inspect','drugAndItem','other','notFound'));
		}
		else {
			echo "permission denied";
		}
	}
	public function postDashBoard(){
		if(Auth::user()->role_id !=3 )
		{	
			$buddhistYear = date('Y',strtotime(date('d-m-Y')))+543;		
			if(Input::get('startDate')==null || Input::get('endDate') == null)
			{
				$startDate=ReportSummary::orderBy('found_date','desc')->first()->found_date;	
				//$startDate=date('Y-m-d',strtotime("-1 days"));
				$endDate = $startDate;
			}	
			else{
				$startDate = Report::convertYearBtoC(Input::get('startDate'));
				$endDate = Report::convertYearBtoC(Input::get('endDate'));
			}
			$inspect = ReportSummary::
				where('found_date','>=',date("Y-m-d", strtotime($startDate)))
				->where('found_date','<=',date("Y-m-d", strtotime($endDate)));
				//->distinct('location_id')
				//->get(array('location_id','khet_id'));
			
			$drugAndItem = ReportSummary::
				where('found_date','>=',date("Y-m-d", strtotime($startDate)))
				->where('found_date','<=',date("Y-m-d", strtotime($endDate)))
				->where(function($query) {
					$query -> where('a', '>', 0) -> orwhere('b', '>', 0) -> orwhere('c', '>', 0) -> orwhere('d', '>', 0) -> orwhere('e', '>', 0) -> orwhere('f', '>', 0) -> orwhere('p', '>', 0) -> orwhere('r', '>', 0);
				});
				//->distinct('location_id')
				//->get(array('location_id','khet_id'));
				
			$other = ReportSummary::
				where('found_date','>=',date("Y-m-d", strtotime($startDate)))
				->where('found_date','<=',date("Y-m-d", strtotime($endDate)))
				->where(function($query) {
					$query -> where('g', '>', 0) -> orwhere('h', '>', 0) -> orwhere('i', '>', 0) -> orwhere('j', '>', 0) -> orwhere('k', '>', 0) -> orwhere('l', '>', 0) -> orwhere('m', '>', 0) -> orwhere('n', '>', 0) 
					-> orwhere('o', '>', 0) -> orwhere('q', '>', 0) -> orwhere('s', '>', 0) -> orwhere('t', '>', 0) -> orwhere('u', '>', 0) -> orwhere('v', '>', 0) -> orwhere('w', '>', 0);
				});
				//->distinct('location_id')
				//->get(array('location_id','khet_id'));
			
			$notFound = ReportSummaryByFoundAt::
				where('found_date','>=',date("Y-m-d", strtotime($startDate)))
				->where('found_date','<=',date("Y-m-d", strtotime($endDate)))
				->where('found_at_id','=',0)->whereRaw('location_id not in (select location_id from summary_by_found_at where found_at_id <> 0)');
			
			
			$startDate = Report::convertYearCtoB(date('d-m-Y',strtotime($startDate)));
			$endDate = Report::convertYearCtoB(date('d-m-Y',strtotime($endDate)));
			
			
			return View::make('report/dashboard',compact('buddhistYear','startDate','endDate','inspect','drugAndItem','other','notFound'));
		}
		else {
			echo "permission denied";
		}
	}
	public function showHDashBoard(){
		$date = Input::get('date');
		if($date==null)
		{
			$date=date('d-M-Y');
		}
		$timestamp = strtotime($date);
		$prohibitedId=Category::where('name','=','สิ่งของต้องห้าม')->first()->id;
		// yet to be done
		$drugId=Category::where('name','=','ยาเสพติด')->first()->id;
		$totalItems=Report::where('category_id','=',$prohibitedId)->where('found_date','=',date("Y-m-d", $timestamp))->count();
		$totalDrugs=Report::where('category_id','=',$drugId)->where('found_date','=',date("Y-m-d", $timestamp))->count();
		$totalPrisonInspected=Report::where('found_date','=',date("Y-m-d", $timestamp))->count();
		
		
		return View::make('report/hdashboard',compact('date','totalItems','totalDrugs','totalPrisonInspected'));
		 
		
		 
	}
	public function showPOC()
	{
		//$lat = array(0,0,0,0,0,0,0);
		$lat = Location::getLatitudeJSON();
		$long = Location::getLongitudeJSON();
		$id = Location::getLocationID_JSON();
		$location = Location::getLocationNameJSON();
		$threatToday = Threat::getThreatTodayJSON();
		$threatMax = Threat::getMaxThreatTodayJSON();
		
		return View::make('report/poc', compact('lat', 'long','id','location','threatToday','threatMax'));
	}
	public function export()
	{

		
		/*$users = UserService::findAllPublic();
        $total = UserService::count();
        $total_with_photo = UserService::countWithPhoto();
        Excel::create('excelfile', function($excel) use ($users, $total, $total_with_photo) {
            $excel->sheet('Excel', function($sheet) use ($users, $total, $total_with_photo) {
                $sheet->loadView('report.excel')->with("users", $users)->with("total", $total)->with("total_with_photo", $total_with_photo);
            });
        })->export('xls');*/
     	 $itemFound = Report::generateReportRow(2,"16-10-2014","16-10-2014");
		 foreach($itemFound as $t){
		 	echo $t;
		 }
	 
		 /*Excel::create('excelfile', function($excel)  {
            $excel->sheet('Excel', function($sheet) {
                $sheet->loadView('table.test');
            });
        })->export('xls');*/
	}
	
	public function getAddData()
	{
			
		$location = Auth::user()->location->name;
		$unconfirmInsideReport = Report::where('location_id','=',Auth::user()->location->id)->where('is_confirmed','=',0)->where('found_at_id','=',2)->where('found_date','=',date('Y-m-d'))->get();
		$unconfirmOutsideReport = Report::where('location_id','=',Auth::user()->location->id)->where('is_confirmed','=',0)->where('found_at_id','=',1)->where('found_date','=',date('Y-m-d'))->get();
		$unconfirmNotfound = Report::where('location_id','=',Auth::user()->location->id)->where('is_confirmed','=',0)->where('found_at_id','=',0)->get();
		$buddhistYear = date('Y',strtotime(date('d-m-Y')))+543;
		return View::make('report/add_data',compact('location','unconfirmInsideReport','unconfirmOutsideReport','unconfirmNotfound','buddhistYear' ));
	}
	public function postAddData()
	{
			
		$rules = array('qty' => array('regex:/^(([0-9]+[.][0-9]+)|[0-9]+)$/'), 
		'isFound'=>'required'
		);
		
		// Validate the inputs
		$validator = Validator::make(Input::all(), $rules);
		
		// Check if the form validates with success
		if ($validator -> passes()) {	
			$location = Location::find(Auth::user()->location->id)->name;
			//Insert Data into DB set confirmation bit to 0
			$date = Report::convertYearBtoC(Input::get('date'));
			$timestamp = strtotime($date);
			$result = Report::where('location_id','=',Auth::user()->location->id)->where('is_confirmed','=',1)->where('found_date','=',date("Y-m-d", $timestamp))->get();
			if(count($result) > 0){
					return App::abort(404);
			}
			else {
			if(Input::get('isFound') == "no")
			{
				//Get Note ID to be updated	
				//$noteId = Report::where('found_date','=',date("Y-m-d", $timestamp))->where('location_id','=',Auth::user()->location->id)->first()->note_id;	
				$oldReport = Report::where('found_date','=',date("Y-m-d", $timestamp))->where('is_confirmed','=',1)->where('location_id','=',Auth::user()->location->id)->first();
				if(count($oldReport) > 0){
					$noteId = $oldReport->note_id;
				}
				else{
					$noteId = 0;
				}
				
				//delete old data
				
				
				Report::where('found_date','=',date("Y-m-d", $timestamp))->where('location_id','=',Auth::user()->location->id) -> delete();
				//insert
				$report = new Report;
				$report -> item_id = 0;
				$report -> found_at_id = 0;
				$report -> qty = 0;
				$report -> category_id = 0;
				$report -> found_date = date("Y-m-d", $timestamp);
				$report -> area_id = 0;
				$report -> location_id = Auth::user()->location->id;
				$report -> ip_address = Request::getClientIp();
				$report -> khet_id = Auth::user()->location->khet_id;	
				$report -> is_confirmed = 1;
				$report -> method_id = Input::get('method');
				$report -> item_owner = '';
				$report -> other_item = '';
				$report -> other_area = '';
				if(Input::get('method')==2){
					$report -> special_method_id =Input::get('special_method');
				}
				else{
					$report -> special_method_id =0;
				}
				
				//$oldReport = Report::where('found_date','=',date("Y-m-d", $timestamp))->where('is_confirmed','=',1)->where('location_id','=',Auth::user()->location->id)->first();
				if($noteId != 0){
					// Update	(กรณีเคยมีreport)
					//echo $noteId;
					$note = Note::find($noteId);
					$note->content = Input::get('note');
					$note->save();
					$report -> note_id = $note->id;				
				}
				else{					
					// Create new note	(กรณีไม่มีreport)
					$note = new Note;
					$note->content = Input::get('note');
					$note->save();
					$report -> note_id = $note->id;
				}				
				
				
				$report -> save();
				//return to table page
				return Redirect::to('report/view')->with('message','บันทึกรายงานเสร็จสมบูรณ์');
				}
			else
			{
				//Delete notfound data
				//keep old noteID 
				$oldReport = Report::where('found_date','=',date("Y-m-d", $timestamp))->where('location_id','=',Auth::user()->location->id)->first();
				if(count($oldReport) > 0){
					$noteId = $oldReport->note_id;
				}
				else{
					$noteId = 0;
				}
				//Delete if not found was selected
				//Report::where('found_date','=',date("Y-m-d", $timestamp))->where('location_id','=',Auth::user()->location->id)->where('item_id','=',0) -> delete();
				//If special method
				if(Input::get('method')==2)	
				{
					$report = Report::where('item_id','=',Input::get('item'))
							->where('found_date','=',date("Y-m-d", $timestamp))
							->where('found_at_id','=',Input::get('before'))
							->where('item_owner','=',Input::get('owner'))
							->where('area_id','=',Input::get('area'))
							->where('other_item','=',Input::get('other'))
							->where('other_area','=',Input::get('other_area'))
							->where('method_id','=',Input::get('method'))
							->where('special_method_id','=',Input::get('special_method'))
							->where('location_id','=',Auth::user()->location->id)->first();
				}
				//If normal method
				else if(Input::get('method')==1)
				{
					$report = Report::where('item_id','=',Input::get('item'))
							->where('found_date','=',date("Y-m-d", $timestamp))
							->where('found_at_id','=',Input::get('before'))
							->where('item_owner','=',Input::get('owner'))
							->where('area_id','=',Input::get('area'))
							->where('other_item','=',Input::get('other'))
							->where('other_area','=',Input::get('other_area'))
							->where('method_id','=',Input::get('method'))
							->where('location_id','=',Auth::user()->location->id)->first();
				}
					
				//Update
				if(count($report) > 0)
				{
					$updatedReport = Report::find($report->id);
					$updatedReport->qty = Input::get('qty');
					$updatedReport->is_confirmed = 0;
					$updatedReport->method_id=Input::get('method');
					$updatedReport->ip_address = Request::getClientIp();		
					$updatedReport->save();
				}
				//Insert
				else
				{
					$report = new Report;
					$report -> item_id = Input::get('item');
					$report -> found_at_id =Input::get('before');
					$report -> qty = Input::get('qty');
					$report -> category_id = Item::find(Input::get('item'))->category_id;
					$report -> found_date = date("Y-m-d", $timestamp);
					$report -> area_id = Input::get('area');
					$report -> location_id = Auth::user()->location->id;
					$report -> ip_address = Request::getClientIp();
					$report -> is_confirmed = 0;
					if(Input::get('method')==2){
						$report -> special_method_id =Input::get('special_method');
					}
					else{
						$report -> special_method_id =0;
					}
					if(Input::get('item') == Item::where('name','=','อื่นๆ')->first()->id){
						$report -> other_item = Input::get('other' );
						}
					else{
						$report -> other_item = "";
					}
					if(Input::get('hasOwner') == "yes"){
						$report -> item_owner = Input::get('owner');
					}
					else{
						$report -> item_owner = "";
					}
					// check if area = other
					if(Input::get('area') != 37 && Input::get('area') != 38){
						$report -> other_area = "";
					}
					else if(Input::get('area') == 37 || Input::get('area') == 38){
						$report -> other_area = Input::get('other_area');
					}
					$report -> khet_id = Auth::user()->location->khet_id;
					$report -> method_id = Input::get('method');
					$report -> note_id = $noteId;
					$report -> save();
					}
				}
				//Get Unconfirm Report
				$unconfirmInsideReport = Report::where('location_id','=',Auth::user()->location->id)->where('is_confirmed','=',0)->where('found_at_id','=',2)->where('found_date','=',date("Y-m-d", $timestamp))->get();
				$unconfirmOutsideReport = Report::where('location_id','=',Auth::user()->location->id)->where('is_confirmed','=',0)->where('found_at_id','=',1)->where('found_date','=',date("Y-m-d", $timestamp))->get();
				$unconfirmNotfound = Report::where('location_id','=',Auth::user()->location->id)->where('is_confirmed','=',0)->where('found_at_id','=',0)->get();
				//return Redirect::make('report/add_data',compact('location','unconfirmInsideReport','unconfirmOutsideReport','unconfirmNotfound','date'));
				return Redirect::to('report/add')->withInput(array('date' => Input::get('date'), 'isFound' => Input::get('isFound')));
			}
		}		
		else{
			return Redirect::to('report/add')->withInput()->withErrors($validator);	
		}
	

	}
	public function getUnconfirmedData($date)
	{
		$date = Report::convertYearBtoC($date);	
		$timestamp = strtotime($date);
		$unconfirmInsideReport = Report::where('location_id','=',Auth::user()->location->id)->where('is_confirmed','=',0)->where('found_at_id','=',2)->where('found_date','=',date("Y-m-d", $timestamp))->get();
		$unconfirmOutsideReport = Report::where('location_id','=',Auth::user()->location->id)->where('is_confirmed','=',0)->where('found_at_id','=',1)->where('found_date','=',date("Y-m-d", $timestamp))->get();
		$unconfirmNotfound = Report::where('location_id','=',Auth::user()->location->id)->where('is_confirmed','=',0)->where('found_at_id','=',0)->get();
		$report = Report::where('location_id','=',Auth::user()->location->id)->where('found_date','=',date("Y-m-d", $timestamp))->first();
		if(count($report)>0){
			if($report->note_id == 0){
				$noteContent = '';
			}
			else{
				$noteContent = Note::find($report->note_id)->content;
			}	
			
		}
		else{
			$noteContent = '';
		}
		
		//echo $noteContent;
		return View::make('report/unconfirmed_data',compact('unconfirmInsideReport','unconfirmOutsideReport','unconfirmNotfound','noteContent'));
		
	}
	public function loadAreaOption($foundAt){
		//$form = "บริเวณที่พบ: ".Form::select('area', Area::where('found_at_id','=',$foundAt)->lists('name','id'),"",array('id'=>'area'));
		//return $form;
		echo "<select name='area' id='area' onChange=\"checkAreaOther(this.value)\">";
             $result=Area::where('found_at_id','=',$foundAt)->get();
             foreach($result as $area)
                  echo "<option value='$area->id' >$area->name</option>" ;
		echo "</select>\n";
	}
	public function loadLocation($khetId,$locationId){
		if($khetId==0){
			return null;
		}
		echo "เลือกเรือนจำ: "	;
		/*echo "<select name='location_id' id='location_id'>";
             $result=Location::where('khet_id','=',$khetId)->get();
			 echo "<option value='0' >แสดงทั้งหมด</option>" ;
             foreach($result as $location)
                  echo "<option value='$location->id' >$location->name</option>" ;
		echo "</select>\n";*/
		$location = array('0'=>'เลือกทั้งหมด');	
		$allLocation = Location::where('khet_id','=',$khetId)->get();
		foreach($allLocation as $temp)
		{
			$location = array_add($location, $temp->id, $temp->name);
		}	
		echo Form::select('location_id', $location,$locationId,array('id'=>'location_id'));
	}
	
	public function checkAreaName(){
		if(Area::find(Input::get('areaId'))->name == "อื่นๆ")
			return 1;
		return 0; 
	}
	public function checkMethod($method){
		if($method==1)
			return 0;
		else if ($method==2){
			return 1;
		} 
	}
	public function checkItemName(){
		if(Item::find(Input::get('itemId'))->name == "อื่นๆ")
			return 1;
		return 0; 
	}
	public function getUnit($itemId)
	{
		$unit = Item::find($itemId)->unit;	
		return $unit;
		
	}
	
	public function postConfirm()
	{
		//$location = Location::find(Auth::user()->location->id)->name;
		$date = Report::convertYearBtoC(Input::get('date'));	
		$timestamp = strtotime($date);
		$report = Report::where('location_id','=',Auth::user()->location->id)->where('found_date','=',date("Y-m-d", $timestamp));
		//มี  report เก่า
		if(count($report->get()) > 0)
		{
			if($report->first()->note_id == 0){
				$note = new Note;
				$note->content = Input::get('note1');
				$note->save();	
			}
			else{
				$noteId = $report->first()->note_id;
				$note = Note::find($noteId);
				$note -> content = Input::get('note1');;
				$note -> save();
			}		
			
		}
		//ไม่มี report เก่า
		else{
			$note = new Note;
			$note->content = Input::get('note1');
			$note->save();	
		}
		$affectedRows = Report::where('location_id','=',Auth::user()->location->id)->where('found_date','=',date("Y-m-d", $timestamp))->update(array('is_confirmed' => 1,'note_id'=>$note->id));				
					
		
		return Redirect::to('report/view/'.Input::get('date').'/'.Input::get('date'))->with('message','บันทึกรายงานเสร็จสมบูรณ์');
	}

	public function modifyReport(){
		
		$report = Report::all();
		foreach($report as $r){
			$r->khet_id = location::find($r->location_id)->khet_id;
			$r->save();
		}
	}

	public function checkIfRecordExist()
	{
	    $itemId = Input::get('itemId');
		$methodId= Input::get('methodId');
		$specialId = Input::get('specialId');
		$foundAt = Input::get('foundAt');
		$area = Input::get('area');
		$date = Report::convertYearBtoC(Input::get('date'));	
		$timestamp = strtotime($date);
		$owner = Input::get('itemOwner');
		$other = Input::get('itemOther');
		$otherArea = Input::get('areaOther');
		//$result = Report::whereRaw('found_date = '.date("Y-m-d", $timestamp).' and ((is_confirm = 1 and location_id = '.Auth::user()->location->id.' and  item_id = '.$itemId.') or ( item_id = 0))');
		$result = Report::where('location_id','=',Auth::user()->location->id)->where('is_confirmed','=',1)->where('found_date','=',date("Y-m-d", $timestamp))->get();
		return count($result);
		/*if(Input::get('itemId')==0){
			$result = Report::where('location_id','=',Auth::user()->location->id)->where('found_date','=',date("Y-m-d", $timestamp))->get();
			return count($result);
		}
		else
		{
			$result = Report::where('location_id','=',Auth::user()->location->id)->where('found_date','=',date("Y-m-d", $timestamp))->where('item_id','=',0)->get();
			if(count($result) > 0)
				return 1;
			else if($methodId==2){
				$result = Report::where('location_id','=',Auth::user()->location->id)
				->where('found_date','=',date("Y-m-d", $timestamp))
				->where('found_at_id','=',$foundAt)
				->where('item_id','=',$itemId)
				->where('area_id','=',$area)
				->where('item_owner','=',$owner)
				->where('other_item','=',$other)
				->where('other_area','=',$otherArea)
				->where('method_id','=',$methodId)
				->where('special_method_id','=',$specialId)
				->get();
				return count($result);
			}
			else if($methodId==1){
				$result = Report::where('location_id','=',Auth::user()->location->id)
				->where('found_date','=',date("Y-m-d", $timestamp))
				->where('found_at_id','=',$foundAt)
				->where('item_id','=',$itemId)
				->where('area_id','=',$area)
				->where('item_owner','=',$owner)
				->where('other_item','=',$other)
				->where('other_area','=',$otherArea)
				->where('method_id','=',$methodId)
				->get();
				return count($result);
			}
		}*/
	}
	public function deleteData($reportId,$foundDate)
	{
		$date= date("d-m-Y", strtotime($foundDate));
		$result = Report::where('id','=',$reportId)
		->where('location_id','=',Auth::user()->location->id)
		->where('is_confirmed','=',0)
		->where('found_date','=',$foundDate)->get();
		if(count($result)>0)	{
			//Delete
			Report::find($reportId) -> delete();
			//Return to the add page
			$unconfirmInsideReport = Report::where('location_id','=',Auth::user()->location->id)->where('found_date','=',$foundDate)->where('is_confirmed','=',0)->where('found_at_id','=',2)->get();
			$unconfirmOutsideReport = Report::where('location_id','=',Auth::user()->location->id)->where('found_date','=',$foundDate)->where('is_confirmed','=',0)->where('found_at_id','=',1)->get();
			$unconfirmNotfound = Report::where('location_id','=',Auth::user()->location->id)->where('found_date','=',$foundDate)->where('is_confirmed','=',0)->where('found_at_id','=',0)->get();
			$date = Report::convertYearCtoB($date);
			return View::make('report/add_data',compact('date','unconfirmInsideReport','unconfirmOutsideReport','unconfirmNotfound'));
			//return Redirect::to('report/add')->withInput();	
		}			
		else{
			//Not allowed to delete
			//retrun back to the originating page
			return Redirect::to(URL::previous());
		}
	}
	public function getCreate()
	{
		$location = Location::find(Auth::user()->location->id)->name;
		return View::make('report/create',compact('location'));
	}
	public function postCreate()
	{
		/*$rules = array('username' => 'required|min:3|unique:users', 
		'password'=>'required|alpha_num|between:6,12|confirmed',
    	'password_confirmation'=>'required|alpha_num|between:6,12'
		);
		

		// Validate the inputs
		$validator = Validator::make(Input::all(), $rules);*/
		
		// Check if the form validates with success
		//if ($validator -> passes()) {
			$timestamp = strtotime(Input::get('found_date'));

			if(Input::get('isFound') == "yes")
			{
				if(count(Input::get('check_outside')) != 0)
					{	
						foreach(Input::get('check_outside') as $outside)
						{						
							if($outside!=null){			
								$report = new Report;
								$report -> item_id = $outside;
								$report -> found_at_id = 1;
								$report -> qty = Input::get('item_outside.'.$outside);	
								$report -> category_id = Item::find($outside)->category_id;
								$report -> found_date = date("Y-m-d", $timestamp);

								$report -> location_id = Auth::user()->location->id;
								$report -> ip_address = Request::getClientIp();
								$report -> save();
							}
						}
					}
				if(count(Input::get('check_inside')) != 0)	
					{
						foreach(Input::get('check_inside') as $inside)
						{						
							if($inside!=null){			
								$report = new Report;
								$report -> item_id = $inside;
								$report -> found_at_id = 2;
								$report -> qty = Input::get('item_inside.'.$inside);	
								$report -> category_id = Item::find($outside)->category_id;;
								$report -> found_date = date("Y-m-d", $timestamp);
								$report -> location_id = Auth::user()->location->id;
								$report -> ip_address = Request::getClientIp();
								$report -> save();
							}
						}
					}
			}
			if(Input::get('isFound') == "no")
			{
				// Insert all with 0
			}
			return Redirect::to('/')->with('message', 'new report added');
		//}
		
	}
	public function getHDashBoardData($date,$khetId){

		$timestamp = strtotime($date);
		
		$prohibitedId=Category::where('name','=','สิ่งของต้องห้าม')->first()->id;
		$drugId=Category::where('name','=','ยาเสพติด')->first()->id;
		
		$prohibitedItems = Report::where('category_id','=',$prohibitedId)->where('found_date','=',date("Y-m-d", $timestamp))->where('khet_id','=',$khetId)->count();
		$drug = Report::where('category_id','=',$drugId)->where('found_date','=',date("Y-m-d", $timestamp))->where('khet_id','=',$khetId)->count();
		$locationFound = Report::select(DB::raw('count(*) as location_count, location_id'))->groupBy('location_id')->first();
		$locationAll = Location::where('khet_id','=',$khetId)->count();
		
		$rows = array();
		$row[0] = 'ไม่พบ';
		$row[1] = $locationAll-$locationFound->location_count;
		array_push($rows,$row);
		
		$row[0] = 'พบสารเสพติด';
		$row[1] = $prohibitedItems;
		array_push($rows,$row);
		
	
		$row[0] = 'พบสิ่งของต้องห้าม';
		$row[1] = $drug;
		array_push($rows,$row);
		
		echo json_encode($rows);
	}
	public function getDashBoardData($date,$khetId){
			
		$timestamp = strtotime($date);
		$table = array();
		$table['cols'] = array(
		    /* define your DataTable columns here
		     * each column gets its own array
		     * syntax of the arrays is:
		     * label => column label
		     * type => data type of column (string, number, date, datetime, boolean)
		     */
		    // I assumed your first column is a "string" type
		    // and your second column is a "number" type
		    // but you can change them if they are not
		    array('label' => 'Date', 'type' => 'string'),
		    array('label' => 'Threat', 'type' => 'number'),
		);	
		$prohibitedId=Category::where('name','=','สิ่งของต้องห้าม')->first()->id;
		$drugId=Category::where('name','=','ยาเสพติด')->first()->id;
		$prisonFoundItems=Report::where('category_id','=',$prohibitedId)->where('found_date','=',date("Y-m-d", $timestamp))->where('khet_id','=',$khetId)->count();
		$prisonFoundDrugs=Report::where('category_id','=',$drugId)->where('found_date','=',date("Y-m-d", $timestamp))->where('khet_id','=',$khetId)->count();
		
		$prohibitedItems = Report::where('category_id','=',$prohibitedId)->where('found_date','=',date("Y-m-d", $timestamp))->count();
		$drug = Report::where('category_id','=',$drugId)->where('found_date','=',date("Y-m-d", $timestamp))->where('khet_id','=',$khetId)->count();
		
		$locationFound = Report::select(DB::raw('count(*) as location_count, location_id'))->groupBy('location_id')->first();
		$locationAll = Location::where('khet_id','=',$khetId)->count();
		
		$temp = array();	
		// Prohibited
		$temp[] = array('v' => "สิ่งของต้องห้าม");	
		$temp[] = array('v' => $prohibitedItems);
		$rows[] = array('c' => $temp);
		// Drug
		$temp = array();		
		$temp[] = array('v' => "ยาเสพติด");	
		$temp[] = array('v' => $drug);
		$rows[] = array('c' => $temp);	
		// Not found
		$temp = array();
		$temp[] = array('v' => "ไม่พบ");	
		$temp[] = array('v' => $locationAll - $locationFound->location_count);
		$rows[] = array('c' => $temp);	
			
		/*foreach($allCases as $report)
		{
			// Logic goes here
				
			$temp = array();	
			$temp[] = array('v' => "Threat".$report->id);	
			$temp[] = array('v' => $report->qty);
			$rows[] = array('c' => $temp);	
		}*/
		// create row
			
		// populate the table with rows of data
		$table['rows'] = $rows;	
		
		$jsonTable = json_encode($table);

		// set up header; first two prevent IE from caching queries
		header('Cache-Control: no-cache, must-revalidate');
		header('Content-type: application/json');
		
		// return the JSON data
		echo $jsonTable;
	}
	
	public function getData($startDate,$endDate,$location_id,$found_at){
			
		$timestamp_start = strtotime($startDate);
		$timestamp_end = strtotime($endDate);
		$table = array();
		$table['cols'] = array(
		    /* define your DataTable columns here
		     * each column gets its own array
		     * syntax of the arrays is:
		     * label => column label
		     * type => data type of column (string, number, date, datetime, boolean)
		     */
		    // I assumed your first column is a "string" type
		    // and your second column is a "number" type
		    // but you can change them if they are not
		    array('label' => 'Date', 'type' => 'string'),
		    array('label' => Location::find($location_id)->name.'('.FoundAt::find($found_at)->name.')', 'type' => 'number'),
		);	
		
		
		$allCases = Report::where('location_id','=',$location_id)->where('found_at_id','=',$found_at)->get();
		
			
		foreach($allCases as $report)
		{
			// Logic goes here
				
			$temp = array();	
			$temp[] = array('v' => Item::find($report->item_id)->name);	
			$temp[] = array('v' => $report->qty);
			$rows[] = array('c' => $temp);	
		}
		// create row
			
		// populate the table with rows of data
		$table['rows'] = $rows;	
		
		$jsonTable = json_encode($table);

		// set up header; first two prevent IE from caching queries
		header('Cache-Control: no-cache, must-revalidate');
		header('Content-type: application/json');
		
		// return the JSON data
		echo $jsonTable;
	}

	public function getAllData($id)
	{
			
		$table = array();
		/*$table['cols'] = array(
		    /* define your DataTable columns here
		     * each column gets its own array
		     * syntax of the arrays is:
		     * label => column label
		     * type => data type of column (string, number, date, datetime, boolean)
		   
		    */
	
		//$allItems = Report::groupBy('item_id')->get();
		$allItems = Item::all();
		$reportedLocations = Report::groupBy('location_id')->get();
		$reports = Report::orderBy('item_id')->get();
		$reportedItems = Report::groupBy('item_id')->get();
		$keepIndex = array();
		$temp_col= array();
		$temp_col[] = array('label' => "Threat", 'type' => 'string');
		//Initialize KeepIndex
		foreach($allItems as $item)
		{
			foreach($reportedLocations as $location){
				$keepIndex[$item->id][$location->location_id]=0;
			}
		}
		foreach($reportedLocations as $location)
		{
				$temp_col[] = array('label' => Location::find($location->location_id)->name, 'type' => 'number');
				$cols = $temp_col;
				
		}
		$table['cols'] = $cols;
		// generate pre json table
		foreach($reports as $report)
		{
			
			foreach($allItems as $item)
			{
				if($item->id == $report->item_id){

					$keepIndex[$item->id][$report->location_id] = $report->qty;

				}

			}

		}
		// generate json table
		foreach($reportedItems as $item)
		{
			$temp = array();	
			$temp[] = array('v' => Item::find($item->item_id)->name);		
			foreach($reportedLocations as $location){
				//echo $keepIndex[$item->id][$location->location_id]."_____";
				$temp[] = array('v' => $keepIndex[$item->item_id][$location->location_id]);
			}
			$rows[] = array('c' => $temp);	
			//echo "<br>";
		}
			
		// populate the table with rows of data
		$table['rows'] = $rows;	
		
		$jsonTable = json_encode($table);

		// set up header; first two prevent IE from caching queries
		header('Cache-Control: no-cache, must-revalidate');
		header('Content-type: application/json');
		
		// return the JSON data
		echo $jsonTable;
	}

		
	// By Location
	public function getByLocation(){
		$buddhistYear = date('Y',strtotime(date('d-m-Y')))+543;	
		$khet_id = 0;
		$item_id = 0;
		$startDate = Report::convertYearCtoB(date('d-m-Y'));
		$endDate = Report::convertYearCtoB(date('d-m-Y'));
		return View::make('report/chart_by_location',compact('buddhistYear','khet_id','item_id','startDate','endDate'));
	}
	public function postByLocation(){
		if(Input::get('item_id') != 0)
		{ 	
			$buddhistYear = date('Y',strtotime(date('d-m-Y')))+543;		
			$khet_id=Input::get('khet_id');
			$item_id=Input::get('item_id');	
			$startDate = Input::get('startDate');
			$endDate = Input::get('endDate');
			return View::make('report/chart_by_location',compact('buddhistYear','startDate','endDate','khet_id','item_id'));
		}
		else
		{
			return Redirect::to('report/bylocation')->withInput()->with('error','กรุณาระบุชนิดสิ่งของต้องห้าม');
			
		}
	}

}
