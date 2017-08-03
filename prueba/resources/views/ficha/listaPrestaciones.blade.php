@extends('fichaLayout.listaPrestaciones')
@section('resultado')
    @foreach($arr_pre as $obj_pre)
        <tr>
            <td>{{$obj_pre->descripcion}}</td>
            <td>{{$obj_pre->piesa}}</td>
            <td>{{$obj_pre->cantidad}}</td>
            <td>${{number_format($obj_pre->valor * $obj_pre->cantidad, 0, ",", ".")}}</td>
            <td>
                <button type="button" class="btn btn-danger eliminarPrestacion" id='{{$obj_pre->id_pod}}' style="padding: 2px 6px;">
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
            </td>
        </tr>
    @endforeach
@stop
