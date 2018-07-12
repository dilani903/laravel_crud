<html>
<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"></script>		
</head>
<body>
	<center>
			<div class='container'>
				<div class='box header'>
					<h3 align='center'>SYSTEM LOGIN WINDOW</h3>
				</div>
				@if(isset(Auth::user()->email))
					<script>
						window.location="/dashboard/main_dashboard";
					</script>
				@endif
				@if($massage = Session::get('error'))
					<div class='alert alert-danger alert-block'>
						<button type="button" class="close" data-dismiss="alert">x</button>
						<strong>{{$massage}}</strong>
					</div>
				@endif
				<div class='box-body'>
					<form method="POST" action="{{url('/login/validate_login')}}">
						{{csrf_field()}}
						<div class='form-group'>
							<label>User Name</label>
							<input type="text" class="form-control" autocomplete="off" required="" name="username" style="width: 50%"/>
						</div>
						<div class='form-group'>
							<label>Password</label>
							<input type="password" class="form-control" autocomplete="off" required="" name="password" style="width: 50%"/>
						</div>
							<div class='form-group'>
							<input type="submit" class="btn btn-danger" autocomplete="off" value="SUBMIT" style="width: 15%"/>
						</div>
					</form>
				</div>
			</div>
	</center>
</body>
</html>



