<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\project;
use App\Team;
use Input;
use Auth;

class GenerateReportController extends Controller
{
    public function index()
    {
      $loggedInUser = Auth::user()->UserID;

      if(Auth::user()->Role == 1) {
        $projects = project::all();
      } else {
        $projects = DB::select("select * from project where SupervisorID = $loggedInUser");
      }
     	return view('generatesummary',array('projects'=>$projects, 'getselectedproj'=>0, 'getselectedreport'=>0, 'reports'=>[]));
  	}

  	public function generatereport(Request $request)
    {	
    	$projects = project::all();

    	$getselectedproj = Input::get('projSelection');
    	$getreporttype = Input::get('reportSelection');
    	$getstartdate =  Input::get('inputStartDate');
    	$getenddate = Input::get('inputEndDate');

    	if($getreporttype == '1')
    	{
 			$reports = DB::select("select *, TIME_FORMAT(ts.StartTime, '%h:%i %p') as StartTime, TIME_FORMAT(ts.EndTime, '%h:%i %p') as EndTime, TIME_FORMAT(TIMEDIFF(ts.EndTime,ts.StartTime), '%H:%i') as HoursWorked from timesheet ts inner join employee e on ts.UserID = e.UserID inner join project p on ts.ProjectID = p.ProjectID where ts.ProjectID = ? and ts.Date = CURDATE()", [$getselectedproj]);
		}
 		else if($getreporttype == '2')
 		{
 			$reports = DB::select("select *, TIME_FORMAT(ts.StartTime, '%h:%i %p') as StartTime, TIME_FORMAT(ts.EndTime, '%h:%i %p') as EndTime, TIME_FORMAT(TIMEDIFF(ts.EndTime,ts.StartTime), '%H:%i') as HoursWorked from timesheet ts inner join employee e on ts.UserID = e.UserID inner join project p on ts.ProjectID = p.ProjectID where ts.ProjectID = ? and ts.Date BETWEEN DATE_SUB( CURDATE( ) , INTERVAL( WEEKDAY( CURDATE( ) ) ) DAY ) AND CURDATE( )", [$getselectedproj]);
 		}
 		else if($getreporttype == '3')
 		{
 			$reports = DB::select("select *, TIME_FORMAT(ts.StartTime, '%h:%i %p') as StartTime, TIME_FORMAT(ts.EndTime, '%h:%i %p') as EndTime, TIME_FORMAT(TIMEDIFF(ts.EndTime,ts.StartTime), '%H:%i') as HoursWorked from timesheet ts inner join employee e on ts.UserID = e.UserID inner join project p on ts.ProjectID = p.ProjectID where ts.ProjectID = ? and ts.Date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)",[$getselectedproj]);
 		}
 		else 
 		{
 			$reports = DB::select("select *, TIME_FORMAT(ts.StartTime, '%h:%i %p') as StartTime, TIME_FORMAT(ts.EndTime, '%h:%i %p') as EndTime, TIME_FORMAT(TIMEDIFF(ts.EndTime,ts.StartTime), '%H:%i') as HoursWorked from timesheet ts inner join employee e on ts.UserID = e.UserID inner join project p on ts.ProjectID = p.ProjectID where ts.ProjectID = ? and ts.Date >= ? and ts.Date <= ?", [$getselectedproj, $getstartdate, $getenddate]);
 		}

 		//dd($getselectedproj, $getreporttype, $reports);
 		return view('generatesummary',array('projects'=>$projects, 'getselectedproj'=>$getselectedproj, 'getselectedreport'=>$getreporttype,'reports'=>$reports));
  	}
}
