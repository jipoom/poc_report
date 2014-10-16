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
Route::group(array('prefix' => 'report', 'before' => 'auth'), function()
{
	Route::get('poc', 'ReportController@showPOC');
	Route::get('stand_alone', 'ReportController@showStandAlone');
	Route::get('dashboard', 'ReportController@showDashBoard');
	Route::get('hdashboard', 'ReportController@showHDashBoard');
	
	//อธิบดี
	Route::get('map', 'ReportController@showPOC');
	Route::get('overall', 'ReportController@showOverall');
	
	//เรือนจำ
	Route::get('add', array('as' => 'add', 'uses' => 'ReportController@getAddData'));
	Route::post('add', 'ReportController@postAddData');
	Route::get('delete/{id}/{foundDate}', 'ReportController@deleteData');
	Route::post('confirm', array('before' => 'csrf', 'uses' => 'ReportController@postConfirm'));
	Route::get('unconfirmedData/{date}','ReportController@getUnconfirmedData');
	Route::get('exist', 'ReportController@checkIfRecordExist');
	Route::get('getunit/{itemId}','ReportController@getUnit');
	//Route::get('create', 'ReportController@getCreate');
	//Route::post('create', 'ReportController@postCreate');
	Route::get('view', 'ReportController@getView');
	
	
	Route::get('export', 'ReportController@export');
	Route::get('getData/{startDate}/{endDate}/{location_id}/{found_at}', 'ReportController@getData');
	Route::get('getDashBoardData/{date}/{khetId}', 'ReportController@getDashBoardData');
	Route::get('getHDashBoardData/{date}/{khetId}', 'ReportController@getHDashBoardData');
	

});

Route::group(array('prefix' => 'user'), function()
{
	Route::get('create', 'UserController@getCreate');
	Route::get('bulk','UserController@getCreateBulkUsers');
	Route::post('create', 'UserController@postCreate');
	Route::get('login', 'UserController@getLogin');
	Route::post('login', 'UserController@postLogin');
	Route::get('logout', 'UserController@getLogout');
});

Route::get('/', function()
{
	return View::make('home');
});
