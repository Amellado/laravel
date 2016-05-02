@extends('app')

@section('content')
    <h1>Secure view transition</h1>
    <hr>
    <p class="text-justify">This example implements the secure view transition module of fingerprintToken.js. It works around two functions, one for setting up things, that uses AJAX to make a sort of handshake. The second function is the one that makes the view transition, and should replace the <code>&lt;a&gt;</code> element if that is what is being used. If the transition is being made via a <code>&lt;form&gt;</code>, the <code>'secureGoTo'</code> class is needed to be present on said form.</p>
    <p class="text-justify">Note that this tool needs some PHP help to work properly. Because of this example being made using Laravel, the routes need to be accessible via <code>POST</code> request. The main thing needed is a correct response for the setup via AJAX where a transaction id is defined and the fingerprint is saved to be checked later. The AJAX setup is done in this view. <a href="https://github.com/Amellado/laravel-fingerprintToken.js">Check it on Github</a></p></p>
@stop

@section('scripts')
    <script type="text/javascript">
        $('#example2').toggleClass('active');
    </script>
    <script type="text/javascript" src="{{ URL::asset('/fingerprintToken.js') }}"></script>
@stop