@extends('app')

@section('content')
    @if(isset($ok))
        @if($ok)
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Hurray!</strong> data saved, now test it.
            </div>
        @else
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Doh!</strong> something went wrong.
            </div>
        @endif
    @endif
	<h1>Login using canvas fingerprinting</h1>
	<hr>
	<p class="text-justify">Here you have two forms, one for registering username-password-machine combos, and the other one is for testing the previously stored data. This forms are using the default configuration (for when creating a new form), rather than changing the initialization values in fingerprintToken.js (for when the form existed and worked before including this). Feel free to use any information as all data, in this example, is hashed by SHA-1 before saving.</p>
	<div class="row">
		<div class="col-md-5">
			<h3>Save your User-Pass-Device combo</h3>
			<form class="form-horizontal" action="/login/save" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
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
			<form class="form-horizontal" action="/login/test" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
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