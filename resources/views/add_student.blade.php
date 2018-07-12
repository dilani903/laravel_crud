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
					<form method="POST" action="{{url('/save/student')}}">
						<div class='row'>
						{{csrf_field()}}
						<div class='col-sm-6'>
							<div class='col-sm-6' style='padding-top:8px'>
								<label>Student Nme</label>
							</div>
							<div class='col-sm-6'>
								<input type='text' class='form-control' name='student_name' id='student_name' />
							</div>
						</div>
						</div></br> 
						
						<div class='row'>
						<div class='col-sm-6'>
							<div class='col-sm-6' style='padding-top:8px'>
								<label>Course</label>
							</div>
							<div class='col-sm-6'>
								<select class='form-control' name='course' id='course' />
								@foreach($data['course_data'] as $course)
									<option value="{{$course->id}}">{{$course->name}}--{{$course->year}}</option>
								@endforeach
								</select>
							</div>
						</div>
						</div></br>
						
						<div class='row'>
						<div class='col-sm-6'>
							<div class='col-sm-6' style='padding-top:8px'>
								<label>Date of Birth</label>
							</div>
							<div class='col-sm-6'>
								<input type='text' class='form-control' name='dob' placeholder='1990-03-13' id='dob' />
							</div>
						</div>
						</div></br>
						
						<div class='row'>
						<div class='col-sm-6'>
							<div class='col-sm-6' style='padding-top:8px'>
								<label>Parents</label>
							</div>
							<div class='col-sm-6'>
								<select class='form-control' name='parents' id='parents' />
								@foreach($data['parents_data'] as $parents)
									<option value="{{$parents->id}}">{{$parents->name}}</option>
								@endforeach
								</select>
							</div>
						</div>
						</div></br>
						
						<div class='row'>
						<div class='col-sm-6'>
							<div class='col-sm-6' style='padding-top:8px'>
								<label>City</label>
							</div>
							<div class='col-sm-6'>
								<input type='text' class='form-control' name='city' id='city' />
							</div>
						</div>
						</div></br>
						<div>
							<input type="submit" value="SUBMIT" class="btn btn-info" />
						</div>
					</form>
					</div>
				</div>
		</div>
	</center>
</body>
</html>
