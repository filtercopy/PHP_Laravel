@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h4>List of Employees</h4>
        </div>
        <div class="col-md-2 right">
            <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#addEmpModal">Add New Employee</button>
        </div>
    </div>
    <br>
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
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <!-- FETCH EMPLOYEE DATA -->
                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td>komalthakkar30</td>
                            <td>Komal Thakkar</td>
                            <td>800 Lucinda Ave, Neptune West Hall, DeKalb</td>
                            <td>komalthakkar30@yahoo.in</td>
                            <td>Software Developer</td>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addEmpModal" role="dialog">
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
                                    <td><input type="checkbox" class="checkthis" /></td>
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
              <button type="button" class="btn btn-primary">Add</button>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
