@extends('pdfLayout.epiEpisodioPDF')
@section('contenido')

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Procedimiento</th>
            <th>Pieza</th>
            <th>Cantidad</th>
            <th>Valor</th>
        </tr>
        </thead>
        <tbody>
        @php($var_total = 0 )
        @foreach($arr_pre as $var => $obj_pre)
            @php($var_suma = $obj_pre->valor * $obj_pre->cantidad)
            @php($var_total = $var_total + $var_suma)
        <tr>
            <td scope="row">{{$var+1}}</td>
            <td>{{$obj_pre->descripcion}}</td>
            <td>{{$obj_pre->piesa}}</td>
            <td>{{$obj_pre->cantidad}}</td>
            <td>${{number_format($obj_pre->valor * $obj_pre->cantidad, 0, ",", ".")}}</td>
        </tr>@endforeach
        <tr>
            <th colspan="4">Total</th>
            <th>${{number_format($var_total, 0, ",", ".")}}</th>
        </tr>
        </tbody>
    </table>
@stop