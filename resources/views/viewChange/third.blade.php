@extends('app')

@section('content')
    <p><strong>>Excellent!</strong> You arrived at the last view. That means that the token value was added correctly to the form and it was consistent with the expected value.</p>
    <p>For the sake of demonstration, here is a form that will take you to the last step but without the token.</p>
    <div class="col-md-5">
        <h3>A form missing the correct class</h3>
        <form class="form-horizontal" action="{{url('viewChange/2')}}" method="post">
            <div class="form-group">
                <label for="user" class="col-sm-2 control-label">First:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="users" placeholder="Username">
                </div>
            </div>
            <div class="form-group">
                <label for="pass" class="col-sm-2 control-label">Second:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="pasds" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" data-loading-text="Loading..." value="Save" />
                </div>
            </div>
        </form>
    </div>

@stop

@section('scripts')
    <script type="text/javascript" src="{{ URL::asset('/fingerprintToken.js') }}"></script>
    <script type="text/javascript">
        $('#example2').toggleClass('active');
        Secure.keepProcessId('{{$processId}}');
    </script>
@stop