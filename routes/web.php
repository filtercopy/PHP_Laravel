<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('maintain/employee','MaintainEmployeeController@index');
Route::post('maintain/employee','MaintainEmployeeController@insert');
Route::get('maintain/employee/{UserID}','MaintainEmployeeController@show');
Route::post('maintain/employee/{UserID}','MaintainEmployeeController@updateEmployee');

Route::get('maintain/project','MaintainProjectController@index');
Route::post('maintain/project','MaintainProjectController@insert');

Route::get('manage/project','ManageProjectController@index');
Route::get('manage/project/showdetails','ManageProjectController@showprojectdetails');

//Route::post('manage/project','ManageProjectController@showprojectdetails');

//Route::post('manage/project/addemployee','ManageProjectController@addemployee');

Route::get('/manage/generatesummary', function () {
    return view('generatesummary');
});

Route::get('/employee/viewtimesheet', function () {
    return view('viewtimesheet');
});