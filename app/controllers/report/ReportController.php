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

	public function showPOC()
	{
		//$lat = array(0,0,0,0,0,0,0);
		$lat = Location::getLatitudeJSON();
		$long = Location::getLongitudeJSON();
		$id = Location::getLocationID_JSON();
		$location = Location::getLocationNameJSON();
		$threatToday = Threat::getThreatTodayJSON();
		$threatMax = Threat::getMaxThreatTodayJSON();
		
		return View::make('Report/poc', compact('lat', 'long','id','location','threatToday','threatMax'));
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
	public function getData($id)
	{
			
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
		
		$allCases = Threat::where('location_id','=',$id)->get();
		foreach($allCases as $poc)
		{
			$temp = array();	
			$temp[] = array('v' => "Threat".$poc->id);	
			$temp[] = array('v' => $poc->qty);
			$rows[] = array('c' => $temp);	
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
