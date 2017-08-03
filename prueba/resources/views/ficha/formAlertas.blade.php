@extends('fichaLayout.formAlertas')

@section('tablaAntecedentes')
    @foreach($obj_ant as $obj_ant)
        <tr>
            <td>{{$obj_ant->descripcion}}</td>
            <td>{{$obj_ant->created_at}}</td>
            <td>
                <button type="button" class="btn btn-danger eliminarAntecedente" id='{{$obj_ant->id}}' style="padding: 2px 6px;">
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
            </td>
        </tr>
    @endforeach
@stop