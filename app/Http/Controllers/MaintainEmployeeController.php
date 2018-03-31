<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\employee;
use App\Timesheet;
use App\Team;
use Response;

class MaintainEmployeeController extends Controller
{
	/*
	 * Show List of Employees in the system
	 */
    public function index()
    {
    	$employees = employee::all();
    	return view('maintainemployee', ['employees'=>$employees]);
  	}

	/*
	 * Insert New Employee in the system
	 */
   	public function insert(Request $request)
    {
	    $UserID = $request->input('inputUserID');
	    $Password = $request->input('inputUserID');
	    $FullName = $request->input('inputFullName');
	    $Address = $request->input('inputAddress');
	    $EmailID = $request->input('inputEmail');
	    $JobTitle = $request->input('inputJobTitle');
	    $Salary = $request->input('inputSalary');

	    DB::insert('insert into employee (UserID, Password, FullName, Address, EmailID, JobTitle, Salary) values(?, ?, ?, ?, ?, ?, ?)',	[$UserID, $Password, $FullName, $Address, $EmailID, $JobTitle, $Salary]);

	    return $this->index();
	}

	/*
	 * Update Existing Employee in the system
	 */
	public function updateEmployee(Request $request) 
	{
		$UserID = $request->input('inputUserID');
	    $FullName = $request->input('inputFullName');
	    $Address = $request->input('inputAddress');
	    $EmailID = $request->input('inputEmail');
	    $JobTitle = $request->input('inputJobTitle');
	    $Salary = $request->input('inputSalary');

		Employee::where('UserID', $UserID)
            ->update(['FullName' => $FullName, 'Address' => $Address, 'EmailID' => $EmailID, 'JobTitle' => $JobTitle, 'Salary' => $Salary]);

	    return redirect('/maintain/employee');
	}

	/*
	 * Remove Existing Employee from the system
	 */
	public function removeEmployee(Request $request) 
	{
		$employeeId = $request->input('InputRemoveEmp');
		//Remove from Team Table (FOREIGN KEY)
		Team::where('UserID', $employeeId)
            ->delete();
        //Remove from Team Table (FOREIGN KEY)
		Timesheet::where('UserID', $employeeId)
            ->delete();
        //Remove from Employee Table
        Employee::where('UserID', $employeeId)
        	->delete();

		return redirect('/maintain/employee');
	}
}
