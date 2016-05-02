@extends('app')
{{--todo un form con cosas basicas para que el .js lo intercepte, tiene que apuntar a seccond PERO CON DATOS PENCAS PARA QUE FALLE  ADEMAS EXPLICAR LAS WEAS QUE PASAN. --}}

@section('content')
    {{$processId}}
@stop

@section('scripts')
    <script type="text/javascript" src="{{ URL::asset('/fingerprintToken.js') }}"></script>
    <script type="text/javascript">
        $('#example2').toggleClass('active');
    </script>
@stop