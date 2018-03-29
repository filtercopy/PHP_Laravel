@extends('layouts.app')

@section('content')
<div class="container">
	<h4>Fill Timesheet</h4>

	<br>
	<form role="form">
		<div class="form-group row">
			<label for="inputDay" class="col-md-2 col-xs-4 text-right">Select Day</label>
			<div class="col-md-4 col-xs-8">
				<div class='input-group'>
					<input type="date" class="form-control" id="inputDay" name="inputDay" placeholder="Enter Day"/>
                    <label class="input-group-addon" for="inputDay">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </label>
                </div>
			</div>
		</div>
		<div class="form-group row">
			<label for="projSelection" class="col-md-2 col-xs-4 text-right">Select Project</label>
			<div class="col-md-4 col-xs-8">
				<select class="form-control" id="projSelection">
					<option value="0">Please Select</option>
					<option value="1">Time and Attendance Management</option>
					<option value="2">Billing System</option>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputStartTime" class="col-md-2 col-xs-4 text-right">Start Time</label>
			<div class="col-lg-4 col-md-4 col-sm-5 col-xs-6">
				<input type="time" class="form-control" id="inputStartTime" placeholder="Enter Start Time"/>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputEndTime" class="col-md-2 col-xs-4 text-right">End Time</label>
			<div class="col-lg-4 col-md-4 col-sm-5 col-xs-6">
				<input type="time" class="form-control" id="inputEndTime" placeholder="Enter End Time"/>
			</div>
		</div>
		<br>
		<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<button type="button" class="btn btn-default col-lg-offset-5 col-lg-3 col-md-offset-5 col-md-3 col-sm-offset-5 col-sm-3 col-xs-offset-5 col-xs-3 pull-left" data-dismiss="modal">Cancel</button>
			<button type="button" class="btn btn-primary col-lg-3 col-md-3 col-sm-offset-1 col-sm-3 col-xs-3 pull-right">Update</button>
		</div>
	</form>
</div>
@endsection
