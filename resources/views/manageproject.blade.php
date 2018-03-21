@extends('layouts.app')

@section('content')
<div class="container">
  <h4>List of Projects</h4>

  <br>
  <div class="form-group row">
    <label for="projSelection" class="col-lg-2 col-md-2 col-sm-2 col-xs-4 text-right">Select Project</label>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
      <select class="form-control" id="projSelection">
        <option value="0">Please Select</option>
        <option value="1">Time and Attendance Management</option>
        <option value="2">Billing System</option>
      </select>
    </div>
    <button type="button" class="btn btn-primary btn-md">Go</button>
  </div>

  <hr>
  <div class="row">
      <div class="col-lg-10 col-md-10 col-sm-10 col-xs-8">
          <h4>Project Details</h4>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 text-right">
          <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#addEmpModal">Add Employee</button>
      </div>
  </div>

  <div class="row">
    <label class="col-lg-2 col-md-2 col-sm-2 col-xs-3 text-right">Project Title</label><div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">Billing System</div>
    <label class="col-lg-2 col-md-2 col-sm-2 col-xs-3 text-right">Customer Name</label><div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">Easy Pay</div>
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
          <!-- FETCH EMPLOYEE DATA -->
            <tr>
              <td>komalthakkar30</td>
              <td>Komal Thakkar</td>
              <td>800 Lucinda Ave, Neptune West Hall, DeKalb</td>
              <td>komalthakkar30@yahoo.in</td>
              <td>Software Developer</td>
              <td>
                <p data-placement="top" data-toggle="tooltip" title="Delete">
                <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" >
                <span class="glyphicon glyphicon-remove"></span></button></p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="addEmpModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Employee</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                            <th><input type="checkbox" id="checkall" /></th>
                            <th>Employee ID</th>
                            <th>Full Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Job Title</th>
                        </thead>
                        <tbody>
                            <!-- FETCH EMPLOYEE DATA -->
                            <tr>
                                <td><input type="checkbox" /></td>
                                <td>komalthakkar30</td>
                                <td>Komal Thakkar</td>
                                <td>800 Lucinda Ave, Neptune West Hall, DeKalb</td>
                                <td>komalthakkar30@yahoo.in</td>
                                <td>Software Developer</td>
                            </tr>
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
    </div>
  </div>
</div>
@endsection
