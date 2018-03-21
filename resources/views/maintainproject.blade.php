@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-10">
          <h4>List of Projects</h4>
      </div>
      <div class="col-md-2 right">
          <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#addNewProjectModal">Add New Project</button>
      </div>
  </div>
  <br>
  <div class="row">
      <div class="col-md-10">
          <div class="table-responsive">
              <table id="mytable" class="table table-bordred table-striped">
                  <thead>
                      <th>Project ID</th>
                      <th>Project Title</th>
                      <th>Budget</th>
                      <th>Customer Name</th>
                      <th>Edit</th>
                      <th>Delete</th>
                  </thead>
                  <tbody>
                      @foreach ($projects as $project)
                      <tr>
                          <td>{{ $project->ProjectID }}</td>
                          <td>{{ $project->ProjectTitle }}</td>
                          <td>{{ $project->Budget }}</td>
                          <td>{{ $project->CustomerName}}</td>
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
  <div class="modal fade" id="addNewProjectModal" role="dialog" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <form role="form" action = "/insertprojectdetails" method = "post">
          <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
          <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Project</h4>
              </div>
              <div class="modal-body">
                  <div class="">
                      <!--form role="form"-->
                          <div class="form-group row">
                              <label for="inputProjectID" class="col-sm-3">Project ID</label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" id="inputProjectID" name='inputProjectID'
                                  placeholder="Enter Project ID"/>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="inputTitle" class="col-sm-3">Project Title</label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" id="inputTitle" name='inputTitle' placeholder="Enter Project Title"/>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="inputBudget" class="col-sm-3">Budget</label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" id="inputBudget" name='inputBudget' placeholder="Enter Budget"/>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="inputCustomerName" class="col-sm-3">Customer Name</label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" id="inputCustomerName" name='inputCustomerName' placeholder="Enter Customer Name"/>
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