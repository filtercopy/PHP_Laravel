<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Timesheet;

class ViewEmployeeTimeSheetController extends Controller
{
	public function index()
    {
		  $loggedInUser = Auth::user()->UserID;
      $timesheet_details = DB::select('CALL viewEmployeeTimesheet(0)');

     	return view('viewemployeetimesheet', ['timesheet_details'=>$timesheet_details]);
  	}

  	public function updateTimesheet(Request $request)
    {
    	$UserID = $request->input('inputEmployeeId');
	    $ProjectID = $request->input('inputProjectId');
	    $Date = $request->input('inputDate');
	    $StartTime = $request->input('inputStartTime');
	    $EndTime = $request->input('inputEndTime');

		  Timesheet::where(['UserID'=> $UserID, 'ProjectID'=> $ProjectID, 'Date'=> $Date])
            ->update(['StartTime' => $StartTime, 'EndTime' => $EndTime]);

    	return redirect('/employee/viewemployeetimesheet');
  	}
}
