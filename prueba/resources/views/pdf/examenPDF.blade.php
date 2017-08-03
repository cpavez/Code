@extends('pdfLayout.epiEpisodioPDF')

@section('contenido')

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>EXAMEN</th>
            <th>TIPO EXAMEN</th>
            <th>CANTIDAD</th>
        </tr>
        </thead>
        <tbody>
        @foreach($arr_exa as $var => $obj_exa)
            @php($obj_tpe = $obj_tpe->find($obj_exa->tipo_examen_id))
            <tr>
                <td scope="row">{{$var+1}}</td>
                <td>{{strtoupper($obj_exa->examen)}}</td>
                <td>{{$obj_tpe->descripcion}}</td>
                <td>{{$obj_exa->cantidad}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop