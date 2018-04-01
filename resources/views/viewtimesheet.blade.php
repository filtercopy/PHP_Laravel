@extends('layouts.app')

@section('content')
<div class="container">
	<h4>Fill Timesheet</h4>
	<br>
	<form role="form" action = "/employee/viewtimesheet" method = "post">
        <input type = "hidden" name = "_token" value = "{{ csrf_token() }}">
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
				<select class="form-control" id="projSelection" name="projSelection">
					<option value="0">Please Select</option>
        			@foreach ($projects as $project)
        			<option value="{{ $project->ProjectID }}">{{ $project->ProjectID }} - {{ $project->ProjectTitle }}</option>
        			@endforeach
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputStartTime" class="col-md-2 col-xs-4 text-right">Start Time</label>
			<div class="col-lg-4 col-md-4 col-sm-5 col-xs-6">
				<input type="time" class="form-control" step="900" id="inputStartTime" name="inputStartTime" placeholder="Enter Start Time"/>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputEndTime" class="col-md-2 col-xs-4 text-right">End Time</label>
			<div class="col-lg-4 col-md-4 col-sm-5 col-xs-6">
				<input type="time" class="form-control" step="900" id="inputEndTime" name="inputEndTime" placeholder="Enter End Time"/>
			</div>
		</div>
		<br>
		<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<button type="button" class="btn btn-default col-lg-offset-5 col-lg-3 col-md-offset-5 col-md-3 col-sm-offset-5 col-sm-3 col-xs-offset-5 col-xs-3 pull-left" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-primary col-lg-3 col-md-3 col-sm-offset-1 col-sm-3 col-xs-3 pull-right">Update</button>
		</div>
	</form>

	<div class="row">
        <div class="col-md-10">
        	<hr>
            <h4>Submitted Timesheets</h4>
        </div>    
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="mytable" class="table table-bordred table-striped table-hover">
                    <thead>
                        <th>Project ID</th>
                        <th>Project Name</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Hours Worked</th>
                        <th>Edit</th>
                    </thead>
                    <tbody> 
                        @foreach ($timesheet_details as $timesheet_detail)
                        <tr>
                            <td>{{ $timesheet_detail->ProjectID }}</td>
                            <td>{{ $timesheet_detail->ProjectTitle }}</td>
                            <td>{{ $timesheet_detail->Date }}</td>
                            <td>{{ $timesheet_detail->StartTime}}</td>
                            <td>{{ $timesheet_detail->EndTime}}</td> 
                            <td>{{ $timesheet_detail->HoursWorked}}</td>                         
                            <td>
                              <p data-placement="top" data-toggle="tooltip" title="Edit">
                              <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" >
                              <span class="glyphicon glyphicon-edit"></span></button></p>
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
