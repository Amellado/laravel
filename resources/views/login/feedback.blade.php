@if(isset($ok))
    <div class="alert alert-success alert-dismissible big" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Hurray!</strong> data saved, now test it.
    </div>
@endif
@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Oops</strong> {{$error}}
        </div>
    @endforeach
@endif
@if(isset($test))
    @if($test=='true')
        <div class="alert alert-success alert-dismissible big" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Hurray!</strong> The username-password-fingerprint combo was logged successfully.
        </div>
    @else
        <div class="alert alert-danger alert-dismissible big" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Doh!</strong> the info combination was not found.
        </div>
    @endif
@endif
