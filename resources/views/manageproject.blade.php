@extends('layouts.app')

@section('content')
<div class="container">
  <h4>List of Projects</h4>
  <br>
  <form action = "/manage/project/showdetails" method="get">
  <div class="form-group row">
    <label for="projSelection" class="col-lg-2 col-md-2 col-sm-2 col-xs-4 text-right">Select Project</label>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
      <select class="form-control" id="projSelection" name="projSelection">
        <option value="0">Please Select</option>
        @foreach ($projects as $project)
        <option value="{{ $project->ProjectID }}">{{ $project->ProjectTitle }}</option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="btn btn-primary btn-md">Go</button>
    <!--a href = '/manage/project/<?php echo $project->ProjectID?>' class="btn btn-primary btn-md" >Go</a-->
  </div>
  <hr>
  <div class="">
    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-8">
            <h4>Project Details</h4>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 text-right">
            <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#addEmpModal">Add Employee</button>
        </div>
    </div>

  
    @foreach ($show_projects as $show_projects)
    <div class="row">
      <label class="col-lg-2 col-md-2 col-sm-2 col-xs-3 text-right">Project ID</label><div class="col-lg-2 col-md-2 col-sm-2 col-xs-3" name="inputProjectID">{{ $show_projects->ProjectID }}</div>
      <label class="col-lg-2 col-md-2 col-sm-2 col-xs-3 text-right">Customer Name</label><div class="col-col-lg-2 col-md-2 col-sm-2 col-xs-3">{{ $show_projects->CustomerName }}</div>
    </div>
    <div class="row">
      <label class="col-lg-2 col-md-2 col-sm-2 col-xs-3 text-right">Project Title</label><div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">{{ $show_projects->ProjectTitle }}</div>
      <label class="col-lg-2 col-md-2 col-sm-2 col-xs-3 text-right">Supervisor</label><div class="col-col-lg-2 col-md-2 col-sm-2 col-xs-3">{{ $show_projects->CustomerName }}</div>
    </div>
    @endforeach
  </div>

  <br><br>
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
            <th>Remove</th>
          </thead>
          <tbody>
          @foreach ($employees as $employee)
            <tr>
              <td>{{ $employee->UserID }}</td>
              <td>{{ $employee->FullName }}</td>
              <td>{{ $employee->Address }}</td>
              <td>{{ $employee->EmailID}}</td>
              <td>{{ $employee->JobTitle}}</td> 
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
  <div class="modal fade" id="addEmpModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <!--form role="form" action = "/manage/project/addemployee" method = "post"-->
        <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Employee</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordred table-striped table-hover" name="empSelection">
                        <thead>
                            <th><input type="checkbox" id="checkall" /></th> 
                            <th>Employee ID</th>
                            <th>Full Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Job Title</th>
                        </thead>
                        <tbody>
                            @foreach ($addemployees as $addemployee)
                            <input type = "hidden" name = "_token" value = "{{ $addemployee->UserID }}">
                            <tr>
                                <td><input type="checkbox" /></td>
                                <td>{{ $addemployee->UserID }}</td>
                                <td>{{ $addemployee->FullName }}</td>
                                <td>{{ $addemployee->Address }}</td>
                                <td>{{ $addemployee->EmailID }}</td>
                                <td>{{ $addemployee->JobTitle }}</td> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" data-dismiss="modal">Add</button>
        </div>
      </div>
    <!--/form-->
    </div>
  </div>
</form>
</div>
@endsection
