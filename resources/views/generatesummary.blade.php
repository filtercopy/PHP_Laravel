@extends('layouts.app')

@section('content')
<div class="container">
	<h4>Generate Summary</h4>

	<br>
    <div class="form-group row">
	    <label for="projSelection" class="col-lg-2 col-md-2 col-sm-4 col-xs-3 text-right">Select Project</label>
	    <div class="col-lg-4 col-md-4 col-sm-5 col-xs-6">
	      <select class="form-control" id="projSelection">
	        <option value="0">Please Select</option>
	        <option value="1">Time and Attendance Management</option>
	        <option value="2">Billing System</option>
	      </select>
	    </div>
  	</div>

  	<div class="form-group row">
	    <label for="projSelection" class="col-lg-2 col-md-2 col-sm-4 col-xs-3 text-right">Time Period</label>
	    <div class="col-lg-4 col-md-4 col-sm-5 col-xs-6">
			<select class="form-control" id="projSelection">
				<option value="0">Please Select</option>
				<option value="1">Daily</option>
				<option value="2">Weekly</option>
				<option value="3">Monthly</option>
				<option value="4">Custom</option>
			</select>
	    </div>
  	</div>
  	<div class="form-group row">
		<label for="inputStartTime" class="col-lg-2 col-md-2 col-sm-4 col-xs-3 text-right">Start Time</label>
		<div class="col-lg-4 col-md-4 col-sm-5 col-xs-6">
			<input type="time" class="form-control" id="inputStartTime" placeholder="Enter Start Time"/>
		</div>
    </div>
  	<div class="form-group row">
		<label for="inputEndTime" class="col-lg-2 col-md-2 col-sm-4 col-xs-3 text-right">End Time</label>
		<div class="col-lg-4 col-md-4 col-sm-5 col-xs-6">
			<input type="time" class="form-control" id="inputEndTime" placeholder="Enter End Time"/>
		</div>
  	</div>

  	<br>
  	<div class="row">
		<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<button type="button" class="btn btn-default col-lg-offset-5 col-lg-3 col-md-offset-5 col-md-3 col-sm-offset-5 col-sm-3 col-xs-offset-5 col-xs-3 pull-left" data-dismiss="modal">Reset</button>
			<button type="button" class="btn btn-primary col-lg-3 col-md-3 col-sm-offset-1 col-sm-3 col-xs-3 pull-right">Generate</button>
		</div>
	</div>

  	<hr>
	<h4>Summary Report</h4>
	<br>
	<div class="container" style="background-color: #e1f5fe63;">
		<div class="row">
			<h4><div class="col-lg-12">
					<label>03/30/2018</label>
				</div>
				<div class="text-center">
					<label>Project Title : Billing System
					</label>
				</div>
			</h4>
		</div>
		<div class="row">
			<h4 class="text-center"></h4>
		</div>
		<br>
	  	<div class="form-group row">
		    <div class="col-md-12">
				<div class="table-responsive">
					<table id="mytable" class="table table-bordred table-striped">
						<thead>
							<th></th>
							<th>Employee ID</th>
							<th>Full Name</th>
							<th>Hours Worked</th>
						</thead>
					  	<tbody>
					  	<!-- FETCH EMPLOYEE DATA -->
					    <tr>
							<td>1</td>
							<td>1834925</td>
							<td>Komal Thakkar</td>
							<td>17</td>
					    </tr>
					    <tr>
							<td>2</td>
							<td>1834925</td>
							<td>Komal Thakkar</td>
							<td>17</td>
					    </tr>
					    <tr>
							<td>3</td>
							<td>1834925</td>
							<td>Komal Thakkar</td>
							<td>17</td>
					    </tr>
					  </tbody>
					</table>
				</div>
			</div>
	  	</div>
  	</div>
</div>
@endsection
