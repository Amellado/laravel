@extends('app')

@section('content')
    <p><strong>Hurray!</strong> You arrived at the second view. That means that the token value pased via <code>POST</code> matched the process id of que current interaction. Also that same process id is going to be used to change to a third view, but this time using a pre defined form. Pay no attention to the form fields as they are discarded on the arrival page.</p>
    <p>You can always discard the previous saved data and re-do a setUp, but the idea is to persist the process id between view changes until the process completion is reached</p>
    <div class="col-md-5">
        <h3>An example form requiring data</h3>
        <form class="form-horizontal secureGoTo" action="{{url('viewChange/3')}}" method="post">
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