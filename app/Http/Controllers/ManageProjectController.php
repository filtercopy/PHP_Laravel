<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\project;
use Input;

class ManageProjectController extends Controller
{
    public function index()
    {
     	$projects = project::all();

     	return view('manageproject',array('projects'=>$projects,'getselectedproj'=>0,'show_projects'=>[], 'employees'=>[], 'addemployees'=>[]));
  	}

  	public function showprojectdetails(Request $request)
    {	
    	$projects = project::all();
    	$getselectedproj = Input::get('projSelection');
    	$show_projects = DB::select('select * from project where ProjectID = ?', [$getselectedproj]);

    	$employees = DB::select('select t.UserID, e.FullName, e.Address, e.EmailID, e.JobTitle from team t inner join employee e on t.UserID = e.UserID where t.ProjectID = ?', [$getselectedproj]);

    	$addemployees = DB::select('select UserID, FullName, Address, EmailID, JobTitle from employee where JobTitle != "Supervisor"  and UserID not in (select UserID from team where ProjectID = ?)', [$getselectedproj]);

		  return view('manageproject',array('projects'=>$projects,'getselectedproj'=>$getselectedproj,'show_projects'=>$show_projects,'employees'=>$employees, 'addemployees'=>$addemployees));
  	}

  	public function addemployee(Request $request)
    {	
    	dd('I AM HERE');
    	$getselectedemp = Input::get('empSelection');
    	dd($getselectedemp);

    	return $this->showprojectdetails();
  	}
}
