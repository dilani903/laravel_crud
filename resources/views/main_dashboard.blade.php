<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{ asset('js/dashboard_script.js') }}"></script>
	<style>
		.header{
			background-color: #0e0d52;
			border-radius: 8px;
			margin-top: 10px;
		}
		.headding{
			color: #cccccc;
			font-family: sans-serif;
			font-variant-caps: all-petite-caps;
		}
		.logout-btn{
			    margin-top: 10px;
		}
	</style>
</head>
<body>
	<center>
		<div class='container'>
			<div class='box'>
				<div class='box-header header'>
					<div class='row'>
						@if(isset(Auth::user()->email))
							<div class='col-sm-8'>
								<h3 class='headding'>Welcome User, {{Auth::user()->name}}</h3>
							</div>
							<div class='col-sm-4 logout-btn pull-right'>
								<a class='btn btn-danger' href="{{url('/logout')}}">LOGOUT</a>	
							</div>
						@endif
					</div>					
				</div>
				<div class='box-body'></br>
					<div class='row'>
					<form method="GET" action="{{url('/dashboard/filter')}}">
						<div class='col-sm-3'>
						<label>Filter Student Records</label>
						<select class='form-control' name='student_filter'>
							<option @if($data['filter_key'] == 0) selected='' @endif value='0'>Show All Students</option>
							<option @if($data['filter_key'] == 1) selected='' @endif value='1'>Students Older Than 18</option>
							<option @if($data['filter_key'] == 2) selected='' @endif value='2'>Students at Class 8 in 2010</option>
							<option @if($data['filter_key'] == 3) selected='' @endif value='3'>Students Older than 16 & Parents Older Than 50</option>
						</select>
						</div>
						<div class='col-sm-3'>
							<input type='submit' class='btn btn-success pull-left' style='margin-top:25px' value='FILTER' />
						</div>
					</form>
					<div class='col-sm-3'>
						@if(Auth::user()->admin_status == 1)
						<a class='btn btn-info pull-right' style='margin-top:10px' href="{{url('/add/students')}}">ADD NEW STUDENT</a>
						@endif
					</div>
					</div></br>
					<div class='row'>
						@if(isset($data['Student_data']))
						<table class='table'>
							<thead>
								<tr class='info'>
									<th>ID</th>
									<th>Name</th>
									<th>Course Name</th>
									<th>DOB</th>
									<th>City</th>
									@if(Auth::user()->admin_status == 1)<th>Action</th>@endif
								</tr>
							</thead>
							<tbody>
								@foreach($data['Student_data'] as $data)
									<tr>
										<td>{{$data->id}}</td>
										<td>{{$data->name}}</td>
										<td>{{$data->course_name}}</td>
										<td>{{$data->dob}}</td>
										<td>{{$data->city}}</td>
										@if(Auth::user()->admin_status == 1)<td><a class='btn btn-warning' href="{{url('/edit/student'.'/'.$data->id)}}">Edit</a>&nbsp;<a class='btn btn-danger' href="{{url('/delete/student'.'/'.$data->id)}}">Delete</a></td>@endif
									</tr>
								@endforeach
							</tbody>
						</table>
						@else
						<div class='alert alert-danger alert-block'>
							<p>Sorry, Data is Not Available..</p>
						</div>
						@endif
					</div></br></br>
					<div class='row'>
						<div class='col-sm-2' style='padding-top:8px'>
							<label>Enter Student ID</label>
						</div>
						<div class='col-sm-4'>
							<input type='text' class='form-control' name='student_id' id='student_id' />
						</div>
					</div>
					<div class='row' id='table_content'></div>
				</div>
				<div class='box-footer'></div>
			</div>
		</div>
	</center>
</body>
</html>
<script>
	$(document).ready(function(){
	$('#student_id').keyup(function(){
		var str = '';
		var parent = '';
		if(this.value != ''){
			$.ajax({
			'url': "{{url("/get/students")}}",
			'type': 'GET',
			'data': {'student_id':this.value},
			success: function(data){
				var json_value = JSON.parse(data);console.log(json_value);
				if(json_value['parent_data'] != ''){
					parent = json_value['parent_data'][0]['name'];
				}else{
					parent = '';
				}
				if(data == ''){
					str = "</br><div class='alert alert-danger alert-block'><button type='button' class='close' data-dismiss='alert'>x</button><strong>Student Data is Not Available for the Given ID..</strong></div>"
					$('#table_content').html(str);
				}else{
					str = "</br><table class='table'><thead><tr class='info'><th>Student Name</th><th>Class</th><th>Parent Name</th></tr></thead><tbody><tr><td>"+json_value['student_data'][0]['name']+"</td><td>"+json_value['student_data'][0]['course_name']+"</td><td>"+parent+"</td></tr></tbody><table>";
					$('#table_content').html(str);
				}
			}
		});
		}else{
			$('#table_content').html('');
		}
	});
});
</script>