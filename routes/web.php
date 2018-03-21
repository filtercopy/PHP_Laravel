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


Route::get('/maintain/employee', function () {
    return view('maintainemployee');
});

Route::get('/maintain/project', function () {
    return view('maintainproject');
});

Route::get('/manage/employee', function () {
    return view('manageemployee');
});

Route::get('/manage/project', function () {
    return view('manageproject');
});

Route::get('/manage/generatesummary', function () {
    return view('generatesummary');
});

Route::get('/employee/viewtimesheet', function () {
    return view('viewtimesheet');
});