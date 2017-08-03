@extends('fichaLayout.pacientes')

@section('pacientes')
    {{json_encode($arr_pcp)}}
@stop