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
	//Route::get('poc', 'ReportController@showPOC');
	//Route::get('stand_alone', 'ReportController@showStandAlone');
	//Route::get('hdashboard', 'ReportController@showHDashBoard');
	
	//Admin Panel
	//report mgmt
	Route::get('admin/report', array('before' => 'role_1', 'uses' => 'AdminController@getAdminPanel'));
	Route::post('admin/report', array('before' => 'role_1', 'uses' =>'AdminController@postAdminPanel'));
	Route::post('admin/report/add', array('before' => 'role_1', 'uses' =>'AdminController@postAddData'));
	Route::post('admin/report/confirm', array('before' => 'role_1', 'uses' =>'AdminController@postConfirm'));
	Route::get('admin/report/loadLocation/{khet_id}/{location_id}/{firstLocation?}', array('before' => 'role_1_2', 'uses' =>'AdminController@loadLocation'));
	Route::get('admin/report/exist', array('before' => 'role_1', 'uses' =>'AdminController@checkIfRecordExist'));
	Route::get('admin/report/delete/{id}/{foundDate}/{locationId}/{khetId}', array('before' => 'role_1', 'uses' =>'AdminController@deleteData'));
	
	
	//khet mgmt
	Route::get('admin/khet',  array('before' => 'role_1', 'uses' => 'AdminKhetController@getIndex'));
	Route::get('admin/khet/data',  array('before' => 'role_1', 'uses' => 'AdminKhetController@getData'));
	Route::get('admin/khet/create',  array('before' => 'role_1', 'uses' => 'AdminKhetController@getCreate'));
	Route::post('admin/khet/create',  array('before' => 'role_1', 'uses' => 'AdminKhetController@postCreate'));
	Route::get('admin/khet/{khetId}/edit',  array('before' => 'role_1', 'uses' => 'AdminKhetController@getEdit'));
	Route::post('admin/khet/{khetId}/edit',  array('before' => 'role_1', 'uses' => 'AdminKhetController@postEdit'));
	Route::get('admin/khet/{khetId}/delete',  array('before' => 'role_1', 'uses' => 'AdminKhetController@getDelete'));
	Route::post('admin/khet/{khetId}/delete',  array('before' => 'role_1', 'uses' => 'AdminKhetController@postDelete'));
	
	
	//prison  mgmt
	Route::get('admin/location',  array('before' => 'role_1', 'uses' => 'AdminLocationController@getIndex'));
	Route::get('admin/location/data',  array('before' => 'role_1', 'uses' => 'AdminLocationController@getData'));
	Route::get('admin/location/create',  array('before' => 'role_1', 'uses' => 'AdminLocationController@getCreate'));
	Route::post('admin/location/create',  array('before' => 'role_1', 'uses' => 'AdminLocationController@postCreate'));
	Route::get('admin/location/{locationId}/edit',  array('before' => 'role_1', 'uses' => 'AdminLocationController@getEdit'));
	Route::post('admin/location/{locationId}/edit',  array('before' => 'role_1', 'uses' => 'AdminLocationController@postEdit'));
	Route::get('admin/location/{locationId}/delete', array('before' => 'role_1', 'uses' =>  'AdminLocationController@getDelete'));
	Route::post('admin/location/{locationId}/delete',  array('before' => 'role_1', 'uses' => 'AdminLocationController@postDelete'));
	
	Route::get('admin/user',  array('before' => 'role_1', 'uses' => 'AdminUserController@getIndex'));
	Route::get('admin/user/data',  array('before' => 'role_1', 'uses' => 'AdminUserController@getData'));
	Route::get('admin/user/create',  array('before' => 'role_1', 'uses' => 'AdminUserController@getCreate'));
	Route::post('admin/user/create',  array('before' => 'role_1', 'uses' => 'AdminUserController@postCreate'));
	Route::get('admin/user/{userId}/edit',  array('before' => 'role_1', 'uses' => 'AdminUserController@getEdit'));
	Route::post('admin/user/{userId}/edit',  array('before' => 'role_1', 'uses' => 'AdminUserController@postEdit'));
	Route::get('admin/user/{userId}/delete',  array('before' => 'role_1', 'uses' => 'AdminUserController@getDelete'));
	Route::post('admin/user/{userId}/delete',  array('before' => 'role_1', 'uses' => 'AdminUserController@postDelete'));
	
	
	//admin view report
	Route::post('view_all', array('before' => 'role_1_2', 'uses' => 'TableController@postAdminReport'));
	Route::get('view_all/{startDate?}/{endDate?}', array('before' => 'role_1_2', 'uses' =>'TableController@getAdminReport'));
	Route::post('view_category', array('before' => 'role_1_2', 'uses' =>'TableController@postAdminReportCategory'));
	Route::get('view_category/{startDate?}/{endDate?}', array('before' => 'role_1_2', 'uses' =>'TableController@getAdminReportCategory'));
	//Route::get('export/{categoryId}/{khetId}/{methodId}/{foundAtId}/{locationId}/{startDate}/{endDate}', array('before' => 'role_1_2', 'uses' =>'TableController@export'));
	//Route::get('map', 'ReportController@showPOC');
	//Route::get('overall', 'ReportController@showOverall');
	
	//เรือนจำ
	Route::get('add', array('as' => 'add', 'uses' => 'ReportController@getAddData'));
	Route::post('add', 'ReportController@postAddData');
	Route::get('delete/{id}/{foundDate}', 'ReportController@deleteData');
	Route::post('confirm', array('before' => 'csrf', 'uses' => 'ReportController@postConfirm'));
	//Route::get('view', 'ReportController@showReport');
	Route::post('view', 'TableController@postReport');
	Route::get('view/{startDate?}/{endDate?}', 'TableController@getReport');
	Route::get('exist', 'ReportController@checkIfRecordExist');
	
	//Route::get('create', 'ReportController@getCreate');
	//Route::post('create', 'ReportController@postCreate');
	
	//Route::get('export', 'ReportController@export');
	//Route::get('getData/{startDate}/{endDate}/{location_id}/{found_at}', 'ReportController@getData');
	//Route::get('getDashBoardData/{date}/{khetId}', 'ReportController@getDashBoardData');
		
	//DashBoard
	Route::get('dashboard/{startDate?}/{endDate?}', array('before' => 'role_1_2', 'uses' => 'ReportController@getDashBoard'));
	Route::post('dashboard', array('before' => 'role_1_2', 'uses' =>'ReportController@postDashBoard'));
	Route::get('getPieAllData/{startDate}/{endDate}', array('before' => 'role_1_2', 'uses' =>'ChartController@getDashBoardDrugData'));
	Route::get('getCombinationAllData/{startDate}/{endDate}', array('before' => 'role_1_2', 'uses' =>'ChartController@getCombinationAllData'));
	Route::get('Khet10Data/{startDate}/{endDate}', array('before' => 'role_1_2', 'uses' =>'ChartController@getKhet10Data'));
	Route::get('Khet01Data/{startDate}/{endDate}', array('before' => 'role_1_2', 'uses' =>'ChartController@getKhet01Data'));
	Route::get('Khet02Data/{startDate}/{endDate}', array('before' => 'role_1_2', 'uses' =>'ChartController@getKhet02Data'));
	Route::get('Khet03Data/{startDate}/{endDate}', array('before' => 'role_1_2', 'uses' =>'ChartController@getKhet03Data'));
	Route::get('Khet04Data/{startDate}/{endDate}', array('before' => 'role_1_2', 'uses' =>'ChartController@getKhet04Data'));
	Route::get('Khet05Data/{startDate}/{endDate}', array('before' => 'role_1_2', 'uses' =>'ChartController@getKhet05Data'));
	Route::get('Khet06Data/{startDate}/{endDate}', array('before' => 'role_1_2', 'uses' =>'ChartController@getKhet06Data'));
	Route::get('Khet07Data/{startDate}/{endDate}', array('before' => 'role_1_2', 'uses' =>'ChartController@getKhet07Data'));
	Route::get('Khet08Data/{startDate}/{endDate}', array('before' => 'role_1_2', 'uses' =>'ChartController@getKhet08Data'));
	Route::get('Khet09Data/{startDate}/{endDate}', array('before' => 'role_1_2', 'uses' =>'ChartController@getKhet09Data'));
	
	//By Location
	Route::get('bylocation', array('before' => 'role_1_2', 'uses' =>'ReportController@getByLocation'));
	Route::post('bylocation', array('before' => 'role_1_2', 'uses' =>'ReportController@postByLocation'));
	Route::get('getByLocationData/{startdDate}/{endDate}/{khet_id}/{item_id}', array('before' => 'role_1_2', 'uses' =>'ChartController@getByLocation'));
	
	//By Date
	Route::get('bydate', array('before' => 'role_1_2', 'uses' =>'ReportController@getByDate'));
	Route::post('bydate', array('before' => 'role_1_2', 'uses' =>'ReportController@postByDate'));
	Route::get('getByDateData/{startdDate}/{endDate}/{khet_id}/{item_id}', array('before' => 'role_1_2', 'uses' =>'ChartController@getByDate'));
	
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
