@extends('app')

@section('content')
    <h1>Examples for fingerprintToken.js</h1>
    <hr>
    <p class="lead">This page contains two example uses of fingerprintToken.js, which is the result of the thesis "SISTEMAS DE AUTENTIFICACIÓN EN SISTEMAS WEB BASADOS EN BROWSER FINGER PRINTING "</p>
    <p>The first example is about the user login function, it's designed to upgrade a username-password credential to a username-password-fingerprint one. The fingerprint used here is a canvas based one.</p>

    <p>The second example covers the use of the short term authentication between views, used to prevent session_hijack attacks and such.</p>


@stop
