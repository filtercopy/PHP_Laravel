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
	public function index()
    {
    	$loggedInUser = Auth::user()->UserID;
      	$projects = DB::select('CALL viewProjects(?)', array($loggedInUser));
      	$timesheet_details = DB::select('CALL viewEmployeeTimesheet(?)', array($loggedInUser));

     	return view('viewtimesheet', 
     		['projects'=>$projects, 
     		'timesheet_details'=>$timesheet_details]);
  	}

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
