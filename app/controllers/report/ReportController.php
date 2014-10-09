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
	public function showDashBoard(){
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
		$totalPrisonInspected=Report::where('found_date','=',date("Y-m-d", $timestamp))->groupBy('location_id')->count();
		
		
		return View::make('report/dashboard',compact('date','totalItems','totalDrugs','totalPrisonInspected'));
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
		$threat = Threat::all();

		$threat_array = (array)$threat->toArray();

		Excel::create('POC')
		-> sheet('Threat_Report')
		-> with($threat_array)
		-> export('xlsx');
	}
	
	public function getAddData()
	{
		$location = Location::find(Auth::user()->location->id)->name;
		$unconfirmInsideReport = Report::where('location_id','=',Auth::user()->location->id)->where('is_confirmed','=',0)->where('found_at_id','=',2)->get();
		$unconfirmOutsideReport = Report::where('location_id','=',Auth::user()->location->id)->where('is_confirmed','=',0)->where('found_at_id','=',1)->get();
		$unconfirmNotfound = Report::where('location_id','=',Auth::user()->location->id)->where('is_confirmed','=',0)->where('found_at_id','=',0)->get();
		return View::make('report/add_data',compact('location','unconfirmInsideReport','unconfirmOutsideReport','unconfirmNotfound'));
	}
	public function postAddData()
	{
		$location = Location::find(Auth::user()->location->id)->name;
		//Insert Data into DB set confirmation bit to 0
		$timestamp = strtotime(Input::get('date'));
		if(Input::get('isFound') == "no")
		{
			foreach(Item::all() as $item)	
			{
				$report = new Report;
				$report -> item_id = $item->id;
				$report -> found_at_id = 0;
				$report -> qty = 0;	
				$report -> category_id = Item::find($item->id)->category_id;
				$report -> found_date = date("Y-m-d", $timestamp);
				$report -> note = Input::get('area');
				$report -> location_id = Auth::user()->location->id;
				$report -> ip_address = Request::getClientIp();
				$report -> is_confirmed = 0;
				$report -> save();
			}
		}
		//Get Unconfirm Report
		$unconfirmInsideReport = Report::where('location_id','=',Auth::user()->location->id)->where('is_confirmed','=',0)->where('found_at_id','=',2)->get();
		$unconfirmOutsideReport = Report::where('location_id','=',Auth::user()->location->id)->where('is_confirmed','=',0)->where('found_at_id','=',1)->get();
		$unconfirmNotfound = Report::where('location_id','=',Auth::user()->location->id)->where('is_confirmed','=',0)->where('found_at_id','=',0)->get();
		return View::make('report/add_data',compact('location','unconfirmInsideReport','unconfirmOutsideReport','unconfirmNotfound'));
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
								$report -> note = Input::get('note');
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
								$report -> note = Input::get('note');
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

}
