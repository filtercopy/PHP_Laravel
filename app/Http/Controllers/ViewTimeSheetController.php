<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Timesheet;

class ViewTimeSheetController extends Controller
{
	/*
	* Show List of Timesheets in the system
	*/
	public function index()
    {
    	$loggedInUser = Auth::user()->UserID;
      	$projects = DB::select('CALL viewProjects(?)', array($loggedInUser));
      	//$timesheet_details = DB::select('CALL viewEmployeeTimesheet(?)', array($loggedInUser));

      	$timesheet_details = DB::select("select *, DATE_FORMAT(ts.Date, '%m/%d/%Y') as DateFormatted, TIME_FORMAT(ts.StartTime, '%h:%i %p') as StartTimeFormatted, TIME_FORMAT(ts.EndTime, '%h:%i %p') as EndTimeFormatted, TIME_FORMAT(TIMEDIFF(ts.EndTime,ts.StartTime), '%H:%i') as HoursWorked, (ts.Date >= CURDATE()-14) as CanEdit from timesheet ts inner join project p on ts.ProjectID = p.ProjectID where UserID = $loggedInUser");

      	return view('viewtimesheet', 
     		['projects'=>$projects, 
     		'timesheet_details'=>$timesheet_details]);

 	}

	/*
	* Insert timesheet in the system
	*/
	public function insert(Request $request)
    {
    	$loggedInUser = Auth::user()->UserID;
	    $ProjectID = $request->input('projSelection');
	    $Date = $request->input('inputDay');
		$StartTime = $request->input('inputStartTime');
	    $EndTime = $request->input('inputEndTime');
	    
	    $filltimesheet = DB::select('CALL fillTimesheet(?,?,?,?,?)', array($loggedInUser, $ProjectID, $Date, $StartTime, $EndTime));
	    //dump($filltimesheet);
	    return $this->index();
	}

	/*
	* Update own Timesheets in the system
	*/
  	public function updateTimesheet(Request $request)
    {
    	$TimesheetID = $request->input('inputTimesheetID');
    	$UserID = Auth::user()->UserID;
	    $ProjectID = $request->input('inputProjectId');
	    $Date = $request->input('inputDate');
	    $StartTime = $request->input('inputStartTime');
	    $EndTime = $request->input('inputEndTime');

		Timesheet::where(['TimesheetID'=>$TimesheetID,'UserID'=> $UserID, 'ProjectID'=> $ProjectID, 'Date'=> $Date])
            ->update(['StartTime' => $StartTime, 'EndTime' => $EndTime]);
            
    	return redirect('/employee/viewtimesheet');
  	}
}
