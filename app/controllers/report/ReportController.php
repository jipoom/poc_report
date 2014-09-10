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
								$report -> category_id = 0;
								$report -> found_date = Input::get('found_date');
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
								$report -> category_id = 0;
								$report -> found_date = Input::get('found_date');
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
	
	public function getData($id)
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
