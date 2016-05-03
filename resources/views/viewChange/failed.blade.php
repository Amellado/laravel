@extends('app')

@section('content')
    <h1 class="alert-danger">Whoops! you where not supposed to view the page you tried to access.</h1>
    <p>You probably come from page 3 and tried to get to page 2 with the form without the token.</p>
    <p>That, or you send a post request yourself an the token was not the expected one. Cheers</p>
@stop