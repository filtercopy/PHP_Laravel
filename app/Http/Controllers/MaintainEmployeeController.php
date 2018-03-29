<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MaintainEmployeeController extends Controller
{
    public function index()
    {
     	$employees = DB::select('select UserID, FullName, Address, EmailID, JobTitle, Salary from employee');
     	return view('maintainemployee',['employees'=>$employees]);
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

	public function updateEmployee(Request $request) {

	}
}
