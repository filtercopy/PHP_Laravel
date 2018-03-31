<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\employee;

class MaintainEmployeeController extends Controller
{
    public function index()
    {
     	$employees = DB::select('select UserID, FullName, Address, EmailID, JobTitle, Salary from employee');
     	$employees_update = employee::find('145255');
     	//dd($employees_update);
     	return view('maintainemployee',['employees'=>$employees,'employees_update'=>$employees_update]);
  	}

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

	public function show($UserID) 
	{
		$employees = employee::all();
		$employees_update = employee::find($UserID);
		//dd($employees_update);
		return view('maintainemployee',['employees'=>$employees,'employees_update'=>$employees_update]);
	}

	public function updateEmployee(Request $request) 
	{

	}

	
}
