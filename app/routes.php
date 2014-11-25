<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//Route::get('report/mody','ReportController@modifyReport');
Route::get('report/unconfirmedData/{date}','ReportController@getUnconfirmedData');
Route::get('report/getunit/{itemId}','ReportController@getUnit');
Route::get('report/item/need_other','ReportController@checkItemName');
Route::get('report/method/{methodId}','ReportController@checkMethod');
Route::get('report/area/need_other','ReportController@checkAreaName');
Route::get('report/area_option/{found_at_id}','ReportController@loadAreaOption');
Route::get('report/loadLocation/{khet_id}/{location_id}','ReportController@loadLocation');
Route::group(array('prefix' => 'report', 'before' => 'auth'), function()
{
	Route::get('poc', 'ReportController@showPOC');
	Route::get('stand_alone', 'ReportController@showStandAlone');
	Route::get('dashboard', 'ReportController@showDashBoard');
	Route::get('hdashboard', 'ReportController@showHDashBoard');
	//อธิบดี
	Route::post('view_all', 'TableController@postAdminReport');
	Route::get('view_all/{startDate?}/{endDate?}', 'TableController@getAdminReport');
	Route::post('view_category', 'TableController@postAdminReportCategory');
	Route::get('view_category/{startDate?}/{endDate?}', 'TableController@getAdminReportCategory');
	
	//Route::get('map', 'ReportController@showPOC');
	//Route::get('overall', 'ReportController@showOverall');
	
	//เรือนจำ
	Route::get('add', array('as' => 'add', 'uses' => 'ReportController@getAddData'));
	Route::post('add', 'ReportController@postAddData');
	Route::get('delete/{id}/{foundDate}', 'ReportController@deleteData');
	Route::post('confirm', array('before' => 'csrf', 'uses' => 'ReportController@postConfirm'));
	//Route::get('view', 'ReportController@showReport');
	Route::post('view', 'ReportController@postReport');
	Route::get('view/{startDate?}/{endDate?}', 'ReportController@getReport');
	Route::get('exist', 'ReportController@checkIfRecordExist');
	
	//Route::get('create', 'ReportController@getCreate');
	//Route::post('create', 'ReportController@postCreate');
	
	Route::get('export', 'ReportController@export');
	Route::get('getData/{startDate}/{endDate}/{location_id}/{found_at}', 'ReportController@getData');
	Route::get('getDashBoardData/{date}/{khetId}', 'ReportController@getDashBoardData');
	Route::get('getHDashBoardData/{date}/{khetId}', 'ReportController@getHDashBoardData');
	

});

Route::group(array('prefix' => 'user'), function()
{
	//Route::get('create', 'UserController@getCreate');
	//Route::get('bulk','UserController@getCreateBulkUsers');
	//Route::post('create', 'UserController@postCreate');
	Route::get('login', 'UserController@getLogin');
	Route::post('login', 'UserController@postLogin');
	Route::get('logout', 'UserController@getLogout');
});

Route::get('/', function()
{
	if(Auth::check()){
		return View::make('home');
	}
	else {
		return View::make('user/login');
	}	
	
});
