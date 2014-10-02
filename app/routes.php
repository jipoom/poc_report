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
Route::group(array('prefix' => 'report'), function()
{
	Route::get('poc', 'ReportController@showPOC');
	Route::get('stand_alone', 'ReportController@showStandAlone');
	Route::get('dashboard', 'ReportController@showDashBoard');
	
	//อธิบดี
	Route::get('map', 'ReportController@showPOC');
	Route::get('overall', 'ReportController@showOverall');
	
	//เรือนจำ
	Route::get('create', 'ReportController@getCreate');
	Route::post('create', 'ReportController@postCreate');
	Route::get('view', 'ReportController@getView');
	
	
	Route::get('export', 'ReportController@export');
	Route::get('getData/{id}', 'ReportController@getData');
	Route::get('getDashBoardData', 'ReportController@getDashBoardData');
	

});

Route::group(array('prefix' => 'user'), function()
{
	Route::get('create', 'UserController@getCreate');
	Route::post('create', 'UserController@postCreate');
	Route::get('login', 'UserController@getLogin');
	Route::post('login', 'UserController@postLogin');
	Route::get('logout', 'UserController@getLogout');
});

Route::get('/', function()
{
	return View::make('home');
});
