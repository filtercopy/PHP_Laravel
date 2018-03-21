@extends('layouts.app')

@section('content')
<div class="container">
    <div id="manageprojects">Manage Projects Content</div>

    <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#addEmpModal">Add Employee</button>
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
              <button type="button" class="btn btn-primary">Add</button>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
