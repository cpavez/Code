@extends('fichaLayout.listReceta')

@section('receta')
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>Medicamento</th>
            <th>Dosis</th>
            <th>Cantidad</th>
            <th>Eliminar</th>
        </tr>
        </thead>
        <tbody>
        @foreach($arr_rec as $obj_rec)
            <tr>
                <td>{{$obj_rec->medicamento}}</td>
                <td>{{$obj_rec->docis}}</td>
                <td>{{$obj_rec->cantidad}}</td>
                <td>
                    <button type="button" class="btn btn-danger eliminarReceta" id='{{$obj_rec->id}}' style="padding: 2px 6px;">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@stop