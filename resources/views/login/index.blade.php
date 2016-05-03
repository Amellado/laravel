@extends('app')

@section('content')
    @include('login.feedback')
	<h1>Login using canvas fingerprinting</h1>
	<hr>
	<p class="text-justify">Here you have two forms, one for registering username-password-machine combos, and the other one is for testing the previously stored data. This forms are using the default configuration (for when creating a new form), rather than changing the initialization values in fingerprintToken.js (for when the form existed and worked before including this). Feel free to use any information as all data, in this example, is hashed by SHA-1 before saving.</p>
	<p class="text-justify">What the library does, is intercept the submit method of a form with the <code>secureForm</code> class and check if it fits the form format expected (defined in the initialization values). If it does, the input data is used to create a unique fingerprint (canvas fingerprint) that is added as a hidden value of the form, then the form submit is completed. What is done with the extra value provided is up to you, but feel free to use this example. <a href="https://github.com/Amellado/laravel-fingerprintToken.js">Check it on Github</a></p>
		<div class="col-md-5">
			<h3>Save your User-Pass-Device combo</h3>
			<form class="form-horizontal secureForm" action="{{url('login')}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="saving" value="yes">
				<div class="form-group">
					<label for="user" class="col-sm-2 control-label">Username</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="user" placeholder="Username">
					</div>
				</div>
				<div class="form-group">
					<label for="pass" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="pass" placeholder="Password">
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
			<form class="form-horizontal secureForm" action="{{url('login')}}" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="saving" value="no">
                <div class="form-group">
					<label for="user" class="col-sm-2 control-label">Username</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="user" placeholder="Username">
					</div>
				</div>
				<div class="form-group">
					<label for="pass" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="pass" placeholder="Password">
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
	<script type="text/javascript" src="{{ URL::asset('/fingerprintToken.js') }}"></script>
@stop