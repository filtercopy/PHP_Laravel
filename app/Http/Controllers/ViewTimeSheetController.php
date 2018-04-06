<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class ViewTimeSheetController extends Controller
{
	public function index()
    {
    	$loggedInUser = Auth::user()->UserID;
      	$projects = DB::select("select t.ProjectID, p.ProjectTitle from team t inner join project p on t.ProjectID = p.ProjectID where UserID = $loggedInUser");

      	$timesheet_details = DB::select("select ts.ProjectID, p.ProjectTitle, ts.Date, ts.StartTime, ts.EndTime, TIMEDIFF(ts.EndTime,ts.StartTime) as HoursWorked from timesheet ts inner join project p on ts.ProjectID = p.ProjectID where UserID = $loggedInUser");

     	return view('viewtimesheet', ['projects'=>$projects, 'timesheet_details'=>$timesheet_details]);
  	}

	public function insert(Request $request)
    {
	    $ProjectID = $request->input('projSelection');
	    $Date = $request->input('inputDay');
		$StartTime = $request->input('inputStartTime');
	    $EndTime = $request->input('inputEndTime');
	    
	    DB::insert('insert into timesheet (UserID, ProjectID, Date, StartTime, EndTime) values(?, ?, ?, ?, ?)', 
	    	[Auth::user()->UserID, $ProjectID, $Date, $StartTime, $EndTime]);
	}
}
