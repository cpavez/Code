@extends('fichaLayout.listRecetaDetalle')

@section('receta')
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>Medicamento</th>
            <th>Dosis</th>
            <th>Cantidad</th>
        </tr>
        </thead>
        <tbody>
        @foreach($arr_rec as $obj_rec)
            <tr>
                <td>{{$obj_rec->medicamento}}</td>
                <td>{{$obj_rec->docis}}</td>
                <td>{{$obj_rec->cantidad}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
@stop