@extends('pdfLayout.epiEpisodioPDF')
@section('contenido')

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Medicamento</th>
            <th>Docis</th>
            <th>Cantidad</th>
        </tr>
        </thead>
        <tbody>
        @foreach($arr_rec as $var => $obj_rec)
            <tr>
                <td scope="row">{{$var+1}}</td>
                <td>{{strtoupper($obj_rec->medicamento)}}</td>
                <td>{{strtoupper($obj_rec->docis)}}</td>
                <td>{{$obj_rec->cantidad}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop