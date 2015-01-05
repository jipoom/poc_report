<?php

class AdminController extends BaseController {
	public function getAdminPanel(){
		$buddhistYear = date('Y',strtotime(date('d-m-Y')))+543;		
		$location_id = 0;
		return View::make('admin/admin_panel',compact('buddhistYear','location_id'));
	}
	public function postAdminPanel(){
		if(Input::get('khet_id') != 0)
		{ 	
			$khetId = Input::get('khet_id');	
			$locationId = Input::get('location_id');
			$isUserRequest = true;
			$date = Input::get('date');		
			$location_id = Input::get('location_id');	
			$buddhistYear = date('Y',strtotime(date('d-m-Y')))+543;		
			$foundDate = Report::convertYearBtoC($date);	
			$timestamp = strtotime($foundDate);
			$unconfirmInsideReport = Report::where('location_id','=',$location_id)->where('found_at_id','=',2)->where('found_date','=',date("Y-m-d", $timestamp))->get();
			$unconfirmOutsideReport = Report::where('location_id','=',$location_id)->where('found_at_id','=',1)->where('found_date','=',date("Y-m-d", $timestamp))->get();
			$unconfirmNotfound = Report::where('location_id','=',$location_id)->where('found_at_id','=',0)->where('found_date','=',date("Y-m-d", $timestamp))->get();
			$report = Report::where('location_id','=',$location_id)->where('found_date','=',date("Y-m-d", $timestamp))->first();
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
			
			
			
			return View::make('admin/admin_panel',compact('buddhistYear','location_id','isUserRequest','khetId','date','unconfirmInsideReport','unconfirmOutsideReport','unconfirmNotfound','noteContent'));
		}
		else
		{
			return Redirect::to('report/admin/report')->withInput()->with('error','กรุณาระบุเขต');
			
		}
	}
	public function loadLocation($khetId,$locationId,$firstLocation=null){
		if($khetId==0){
			if($firstLocation!=null)
				return "<b>Step 3: &nbsp; &nbsp; </b>ทุกเรือนจำ</br></br>";
			return null;
		}
		echo "<b>Step 3: &nbsp; &nbsp; </b>เลือกเรือนจำ: "	;
		
		if($firstLocation!=null)
			$location = array('0'=>'ทุกเรือนจำในเขต');
		else {
			$location = array();	
		}	
		$allLocation = Location::where('khet_id','=',$khetId)->get();
		foreach($allLocation as $temp)
		{
			$location = array_add($location, $temp->id, $temp->name);
		}	
		echo Form::select('location_id', $location,$locationId,array('id'=>'location_id'))."</br></br>";
	}
	public function postAddData()
	{
			
		$rules = array('qty' => array('regex:/^(([0-9]+[.][0-9]+)|[0-9]+)$/'), 
		'isFound'=>'required'
		);
		$locationId = Input::get('location_id');
		$khetId = Input::get('khetId');
		// Validate the inputs
		$validator = Validator::make(Input::all(), $rules);
		
		// Check if the form validates with success
		if ($validator -> passes()) {	
			$location = Location::find($locationId)->name;
			//Insert Data into DB set confirmation bit to 0
			$date = Report::convertYearBtoC(Input::get('date'));
			$timestamp = strtotime($date);
			/*$result = Report::where('location_id','=',$locationId)->where('is_confirmed','=',1)->where('found_date','=',date("Y-m-d", $timestamp))->get();
			if(count($result) > 0){
					return App::abort(404);
			}
			else {*/
			if(Input::get('isFound') == "no")
			{
				//Get Note ID to be updated	
				//$noteId = Report::where('found_date','=',date("Y-m-d", $timestamp))->where('location_id','=',Auth::user()->location->id)->first()->note_id;	
				$oldReport = Report::where('found_date','=',date("Y-m-d", $timestamp))->where('is_confirmed','=',1)->where('location_id','=',$locationId)->first();
				if(count($oldReport) > 0){
					$noteId = $oldReport->note_id;
				}
				else{
					$noteId = 0;
				}
				
				//delete old data
				
				
				Report::where('found_date','=',date("Y-m-d", $timestamp))->where('location_id','=',$locationId) -> delete();
				//insert
				$report = new Report;
				$report -> item_id = 0;
				$report -> found_at_id = 0;
				$report -> qty = 0;
				$report -> category_id = 0;
				$report -> found_date = date("Y-m-d", $timestamp);
				$report -> area_id = 0;
				$report -> location_id = $locationId;
				$report -> ip_address = Request::getClientIp();
				$report -> khet_id = $khetId;	
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
				
					
				$unconfirmInsideReport = Report::where('location_id','=',$locationId)->where('found_at_id','=',2)->where('found_date','=',date("Y-m-d", $timestamp))->get();
				$unconfirmOutsideReport = Report::where('location_id','=',$locationId)->where('found_at_id','=',1)->where('found_date','=',date("Y-m-d", $timestamp))->get();
				$unconfirmNotfound = Report::where('location_id','=',$locationId)->where('found_at_id','=',0)->where('found_date','=',date("Y-m-d", $timestamp))->get();
				$report = Report::where('location_id','=',$locationId)->where('found_date','=',date("Y-m-d", $timestamp))->first();
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
				$date = Input::get('date');
				$location_id = $locationId;
				$isUserRequest=true;
				

				//return to table page
				return View::make('admin/admin_panel',compact('buddhistYear','location_id','isUserRequest','khetId','date','unconfirmInsideReport','unconfirmOutsideReport','unconfirmNotfound','noteContent'));
				
			}
			else
			{
				//Delete notfound data
				//keep old noteID 
				$oldReport = Report::where('found_date','=',date("Y-m-d", $timestamp))->where('location_id','=',$locationId)->first();
				if(count($oldReport) > 0){
					$noteId = $oldReport->note_id;
				}
				else{
					$noteId = 0;
				}
				//Delete if not found was selected
				Report::where('found_date','=',date("Y-m-d", $timestamp))->where('location_id','=',$locationId)->where('item_id','=',0) -> delete();
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
							->where('location_id','=',$locationId)->first();
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
							->where('location_id','=',$locationId)->first();
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
					$report -> location_id = $locationId;
					$report -> ip_address = Request::getClientIp();
					$report -> is_confirmed = 1;
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
					$report -> khet_id = $khetId;
					$report -> method_id = Input::get('method');
					$report -> note_id = $noteId;
					$report -> save();
					}
				}
				//Get Unconfirm Report
				$unconfirmInsideReport = Report::where('location_id','=',$locationId)->where('found_at_id','=',2)->where('found_date','=',date("Y-m-d", $timestamp))->get();
				$unconfirmOutsideReport = Report::where('location_id','=',$locationId)->where('found_at_id','=',1)->where('found_date','=',date("Y-m-d", $timestamp))->get();
				$unconfirmNotfound = Report::where('location_id','=',$locationId)->where('found_at_id','=',0)->where('found_date','=',date("Y-m-d", $timestamp))->get();
				$report = Report::where('location_id','=',$locationId)->where('found_date','=',date("Y-m-d", $timestamp))->first();
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
				$date = Input::get('date');
				$location_id = $locationId;
				$isUserRequest=true;
				return View::make('admin/admin_panel',compact('buddhistYear','location_id','isUserRequest','khetId','date','unconfirmInsideReport','unconfirmOutsideReport','unconfirmNotfound','noteContent'));
				//return Redirect::to('report/admin')->withInput(array('date' => Input::get('date'), 'isFound' => Input::get('isFound')));
			
			}
		//}		
		else{
			return Redirect::to('report/add')->withInput()->withErrors($validator);	
		}
	

	}
	public function postConfirm()
	{
		//$location = Location::find(Auth::user()->location->id)->name;
		$locationId = Input::get('location_id');
		$date = Report::convertYearBtoC(Input::get('date'));	
		$timestamp = strtotime($date);
		$report = Report::where('location_id','=',$locationId)->where('found_date','=',date("Y-m-d", $timestamp));
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
		$affectedRows = Report::where('location_id','=',$locationId)->where('found_date','=',date("Y-m-d", $timestamp))->update(array('is_confirmed' => 1,'note_id'=>$note->id));				
					
		$unconfirmInsideReport = Report::where('location_id','=',$locationId)->where('found_at_id','=',2)->where('found_date','=',date("Y-m-d", $timestamp))->get();
		$unconfirmOutsideReport = Report::where('location_id','=',$locationId)->where('found_at_id','=',1)->where('found_date','=',date("Y-m-d", $timestamp))->get();
		$unconfirmNotfound = Report::where('location_id','=',$locationId)->where('found_at_id','=',0)->where('found_date','=',date("Y-m-d" , $timestamp))->get();
		$report = Report::where('location_id','=',$locationId)->where('found_date','=',date("Y-m-d", $timestamp))->first();
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
			$date = Input::get('date');
			$location_id = $locationId;
			$isUserRequest=true;
			$khetId = Location::find($locationId)->khet_id;
			$buddhistYear = date('Y',strtotime(date('d-m-Y')))+543;		
			//return to table page
			return View::make('admin/admin_panel',compact('buddhistYear','location_id','isUserRequest','khetId','date','unconfirmInsideReport','unconfirmOutsideReport','unconfirmNotfound','noteContent'));

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
		$result = Report::where('location_id','=',Input::get('locationId'))->where('is_confirmed','=',1)->where('found_date','=',date("Y-m-d", $timestamp))->get();
		return count($result);

	}
	public function deleteData($reportId,$foundDate,$locationId,$khetId)
	{
		$date= date("d-m-Y", strtotime($foundDate));
		$result = Report::where('id','=',$reportId)
		->where('location_id','=',$locationId)
		->where('found_date','=',$foundDate)->get();
		if(count($result)>0)	{
			//Delete
			Report::find($reportId) -> delete();
			//Return to the add page
			$unconfirmInsideReport = Report::where('location_id','=',$locationId)->where('found_at_id','=',2)->where('found_date','=',$foundDate)->get();
		$unconfirmOutsideReport = Report::where('location_id','=',$locationId)->where('found_at_id','=',1)->where('found_date','=',$foundDate)->get();
		$unconfirmNotfound = Report::where('location_id','=',$locationId)->where('found_at_id','=',0)->where('found_date','=',$foundDate)->get();
		$report = Report::where('location_id','=',$locationId)->where('found_date','=',$foundDate)->first();
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
			$date = Report::convertYearCtoB($date);
			$location_id = $locationId;
			$isUserRequest=true;
			$buddhistYear = date('Y',strtotime(date('d-m-Y')))+543;		
			//return to table page
			return View::make('admin/admin_panel',compact('buddhistYear','location_id','isUserRequest','khetId','date','unconfirmInsideReport','unconfirmOutsideReport','unconfirmNotfound','noteContent'));

		}			
		else{
			//Not allowed to delete
			//retrun back to the originating page
			return Redirect::to(URL::previous());
		}
	}
}

?>
