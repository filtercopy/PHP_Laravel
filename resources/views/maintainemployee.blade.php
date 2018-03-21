@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h4>List of Employees</h4>
        </div>
        <div class="col-md-2 right">
            <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#addNewEmpModal">Add New Employee</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="mytable" class="table table-bordred table-striped">
                    <thead>
                        <th>Employee ID</th>
                        <th>Full Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Job Title</th>
                        <th>Salary</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->UserID }}</td>
                            <td>{{ $employee->FullName }}</td>
                            <td>{{ $employee->Address }}</td>
                            <td>{{ $employee->EmailID}}</td>
                            <td>{{ $employee->JobTitle}}</td> 
                            <td>{{ $employee->Salary}}</td>                         
                            <td>
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" >
                                <span class="glyphicon glyphicon-edit"></span></button></p>
                            </td>
                            <td>
                                <p data-placement="top" data-toggle="tooltip" title="Delete">
                                <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" >
                                <span class="glyphicon glyphicon-remove"></span></button></p>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addNewEmpModal" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md">
          <!-- Modal content-->
          <form role="form" action = "/insertemployeedetails" method = "post">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add New Employee</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!--form role="form" action = "/insertdetails" method = "post"-->
                            <div class="form-group row">
                                <label for="inputUserID" class="col-sm-3">Employee ID</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputUserID" name='inputUserID' placeholder="Enter Employee ID"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputFullName" class="col-sm-3">Full Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputFullName" name='inputFullName' placeholder="Enter Full Name"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputAddress" class="col-sm-3">Address</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="inputAddress" name='inputAddress' placeholder="Enter Address"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-3">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="inputEmail" name='inputEmail' placeholder="Enter Email"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputJobTitle" class="col-sm-3">Job Title</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputJobTitle" name='inputJobTitle' placeholder="Enter Job Title"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputSalary" class="col-sm-3">Salary</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputSalary" name='inputSalary' placeholder="Enter Salary"/>
                                </div>
                            </div>
                        <!--/form-->
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
