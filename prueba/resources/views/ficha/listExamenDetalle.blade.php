@extends('fichaLayout.listExamenDetalle')

@section('examen')
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>Exámen</th>
            <th>Tipo Exámen</th>
            <th>Cantidad</th>
        </tr>
        </thead>
        <tbody>
        @foreach($arr_exa as $obj_exa)
            @php($obj_tpe = $obj_tpe->find($obj_exa->tipo_examen_id))
            <tr>
                <td>{{$obj_exa->examen}}</td>
                <td>{{$obj_tpe->descripcion}}</td>
                <td>{{$obj_exa->cantidad}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
@stop