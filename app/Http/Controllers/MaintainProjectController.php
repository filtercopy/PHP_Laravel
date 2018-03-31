<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MaintainProjectController extends Controller
{
    public function index()
    {
     	$supervisorlist = DB::select('select UserID, FullName from employee where JobTitle = "Supervisor" ');
     	$employeelist = DB::select('select UserID, FullName from employee where JobTitle != "Supervisor" ');
    	$projects = DB::select('select p.ProjectID, p.ProjectTitle, p.SupervisorID, e.Fullname as SupervisorName, p.Budget, p.CustomerName from Project p inner join employee e on p.SupervisorID = e.UserID');

     	return view('maintainproject',['projects'=>$projects, 'supervisorlist'=>$supervisorlist, 'employeelist'=>$employeelist]);
  	}

   	public function insert(Request $request)
    {
	    $ProjectID = $request->input('inputProjectID');
	    $ProjectTitle = $request->input('inputTitle');
	    $SupervisorID = $request->input('SupervisorSelection');
		$Budget = $request->input('inputBudget');
	    $CustomerName = $request->input('inputCustomerName');
	    
	    DB::insert('insert into project (ProjectID, ProjectTitle, Budget, CustomerName, SupervisorID) values(?, ?, ?, ?, ?)', [$ProjectID, $ProjectTitle, $Budget, $CustomerName, $SupervisorID]);

	    if(!empty($_POST['EmployeeSelection']))
		{
			foreach ($_POST['EmployeeSelection'] as $Selected)
			{
					DB::insert('insert into team (UserID, ProjectID) values(?, ?)', [$Selected, $ProjectID]);
	    	}
	    }
	    return $this->index();
	}
}
