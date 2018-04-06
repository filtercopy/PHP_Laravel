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

class ManageProjectController extends Controller
{
    public function index()
    {
      $loggedInUser = Auth::user()->UserID;
      $projects = [];

      if(Auth::user()->Role == 1) {
        $projects = project::all();
      } else {
        $projects = DB::select("select * from project where SupervisorID = $loggedInUser");
      }
     	return view('manageproject',array('projects'=>$projects,'getselectedproj'=>0,'show_projects'=>[], 'employees'=>[], 'addemployees'=>[]));
  	}

  	public function showprojectdetails(Request $request)
    {	
    	$projects = project::all();
    	$getselectedproj = Input::get('projSelection');
    	$show_projects = DB::select('select * from project where ProjectID = ?', [$getselectedproj]);

    	$employees = DB::select('select t.UserID, e.FullName, e.Address, e.EmailID, e.JobTitle from team t inner join employee e on t.UserID = e.UserID where t.ProjectID = ?', [$getselectedproj]);

    	$addemployees = DB::select('select UserID, FullName, Address, EmailID, JobTitle from employee where Role = 3  and UserID not in (select UserID from team where ProjectID = ?)', [$getselectedproj]);

		  return view('manageproject',array('projects'=>$projects,'getselectedproj'=>$getselectedproj,'show_projects'=>$show_projects,'employees'=>$employees, 'addemployees'=>$addemployees));
  	}

  	public function addEmployee(Request $request)
    {	
    	//dd('I AM HERE');
    	$getselectedemp = Input::get('addEmployeesList');
      $getselectedproj = Input::get('getselectedproj');

      if(count($getselectedemp) > 0)
      {
        foreach ($getselectedemp as $id)
        {
          DB::insert('insert into team (UserID, ProjectID) values(?, ?)', [$id, $getselectedproj]);
        }
      }
    	return redirect("/manage/project/showdetails?projSelection=$getselectedproj");
  	}

  /*
   * Remove Existing Employee from the project
   */
  public function removeEmployee(Request $request) 
  {
    $employeeId = $request->input('InputRemovePrjEmp');
    $getselectedproj = Input::get('getselectedproj');
    //Remove from Team Table
    Team::where('UserID', $employeeId)
      ->delete();

    return redirect("/manage/project/showdetails?projSelection=$getselectedproj");
  }
}
