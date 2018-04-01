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
Route::post('maintain/employee/update','MaintainEmployeeController@updateEmployee');
Route::post('maintain/employee/delete','MaintainEmployeeController@removeEmployee');

Route::get('maintain/project','MaintainProjectController@index');
Route::post('maintain/project','MaintainProjectController@insert');
Route::post('maintain/project/update','MaintainProjectController@updateProject');
Route::post('maintain/project/delete','MaintainProjectController@removeProject');

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