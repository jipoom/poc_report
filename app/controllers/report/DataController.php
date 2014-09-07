<?php

class DataController extends BaseController {
	public function getCreate(){
		// Display new info form
		return View::make('report/create_edit');
	}
	public function postCreate(){
		//Insert INfo to DB
	}
}
?>