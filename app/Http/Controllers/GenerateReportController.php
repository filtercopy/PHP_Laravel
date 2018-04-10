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
        $projects = DB::select('CALL selectProjBySupervisor(?)', array($loggedInUser));
      }
     	return view('generatesummary',
          ['projects'=>$projects, 
          'getselectedproj'=>0, 
          'getselectedreport'=>0, 
          'reports'=>[]]);
  	}

  	public function generatereport(Request $request)
    {	
    	$projects = project::all();

    	$getselectedproj = Input::get('projSelection');
    	$getreporttype = Input::get('reportSelection');
    	$getstartdate = Input::get('inputStartDate');
    	$getenddate = Input::get('inputEndDate');

      //Get the reports based on ReportType
 			$reports = DB::select('CALL generateReport(?,?,?,?)',array($getselectedproj, $getreporttype, $getstartdate, $getenddate));

      return view('generatesummary',
        array('projects'=>$projects, 
        'getselectedproj'=>$getselectedproj,
        'getselectedreport'=>$getreporttype,
        'reports'=>$reports));
  	}
}
