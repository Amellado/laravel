@extends('app')

@section('content')
	<h1>Login using canvas fingerprinting</h1>
	<hr>
	<p class="text-justify">Here you have two forms, one for registering username-password-machine combos, and the other one is for testing the previously stored data. This forms are using the default configuration (for when creating a new form), rather than changing the initialization values in fingerprintToken.js (for when the form existed and worked before including this). Feel free to use any information as all data, in this example, is hashed by SHA-1 before saving.</p>
	<div class="row">
		<div class="col-md-5">
			<h3>Save your User-Pass-Device combo</h3>
			<form class="form-horizontal" action="/login/save" method="post">
				<div class="form-group">
					<label for="user" class="col-sm-2 control-label">Username</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="user" placeholder="Username">
					</div>
				</div>
				<div class="form-group">
					<label for="pass" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="pass" placeholder="Password">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<input type="submit" class="btn btn-default" data-loading-text="Loading..." value="Save" />
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-5 col-md-offset-2">
			<h3>Test saved info</h3>
			<form class="form-horizontal" action="/login/test" method="post">
				<div class="form-group">
					<label for="user" class="col-sm-2 control-label">Username</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="user" placeholder="Username">
					</div>
				</div>
				<div class="form-group">
					<label for="pass" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="pass" placeholder="Password">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<input type="submit" class="btn btn-default" data-loading-text="Loading..." value="Test" />
					</div>
				</div>
			</form>
		</div>
	</div>
@stop

@section('scripts')
	<script type="text/javascript">
		$('#example1').toggleClass('active');
	</script>
@stop