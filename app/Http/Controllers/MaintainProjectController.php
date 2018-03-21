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
     	$projects = DB::select('select * from project');
     	return view('maintainproject',['projects'=>$projects]);
  	}

   	public function insert(Request $request)
    {
	    $ProjectID = $request->input('inputProjectID');
	    $ProjectTitle = $request->input('inputTitle');
	    $Budget = $request->input('inputBudget');
	    $CustomerName = $request->input('inputCustomerName');
	    
	    DB::insert('insert into project (ProjectID, ProjectTitle, Budget, CustomerName) values(?, ?, ?, ?)', [$ProjectID, 
	    	$ProjectTitle, $Budget, $CustomerName]);

	    return $this->index();
	}
}
