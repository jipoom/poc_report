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
	Route::get('export', 'ReportController@export');
	Route::get('getData/{id}', 'ReportController@getData');
});

Route::get('/', function()
{
	return View::make('hello');
});
