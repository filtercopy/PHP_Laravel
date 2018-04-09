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
      	$projects = DB::select("select t.ProjectID, p.ProjectTitle from team t inner join project p on t.ProjectID = p.ProjectID where UserID = $loggedInUser");

      	$timesheet_details = DB::select("select *, DATE_FORMAT(ts.Date, '%m/%d/%Y') as DateFormatted, TIME_FORMAT(ts.StartTime, '%h:%i %p') as StartTimeFormatted, TIME_FORMAT(ts.EndTime, '%h:%i %p') as EndTimeFormatted, TIME_FORMAT(TIMEDIFF(ts.EndTime,ts.StartTime), '%H:%i') as HoursWorked, (ts.Date >= CURDATE()-14) as CanEdit from timesheet ts inner join project p on ts.ProjectID = p.ProjectID where UserID = $loggedInUser");

     	return view('viewtimesheet', ['projects'=>$projects, 'timesheet_details'=>$timesheet_details]);
  	}

	/*
	* Insert timesheet in the system
	*/
	public function insert(Request $request)
    {
	    $ProjectID = $request->input('projSelection');
	    $Date = $request->input('inputDay');
		$StartTime = $request->input('inputStartTime');
	    $EndTime = $request->input('inputEndTime');
	    
	    DB::insert('insert into timesheet (UserID, ProjectID, Date, StartTime, EndTime) values(?, ?, ?, ?, ?)', 
	    	[Auth::user()->UserID, $ProjectID, $Date, $StartTime, $EndTime]);
	    return $this->index();
	}

	/*
	* Update own Timesheets in the system
	*/
  	public function updateTimesheet(Request $request)
    {
    	$UserID = Auth::user()->UserID;
	    $ProjectID = $request->input('inputProjectId');
	    $Date = $request->input('inputDate');
	    $StartTime = $request->input('inputStartTime');
	    $EndTime = $request->input('inputEndTime');

		Timesheet::where(['UserID'=> $UserID, 'ProjectID'=> $ProjectID, 'Date'=> $Date])
            ->update(['StartTime' => $StartTime, 'EndTime' => $EndTime]);
    	return redirect('/employee/viewtimesheet');
  	}
}
