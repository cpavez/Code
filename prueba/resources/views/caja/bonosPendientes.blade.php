@extends('cajaLayout.bonosPendientes')
@section('bono')
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="label label-info">Bonos <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></span></div>
            <div class="panel-body" style="font-size:16px;">
                <table class="table table-condensed tabla-abonos">
                    <thead>
                    <tr>
                        <th># Documento</th>
                        <th>Fecha Recepción</th>
                        <th>Valor</th>
                        <th>Cobrado</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($arr_bonos as $obj_abo)
                        <tr>
                            <td>{{$obj_abo->documento}}</td>
                            <td>{{$obj_abo->created_at}}</td>
                            <td>${{number_format($obj_abo->valor, 0, ",", ".")}}</td>
                            <td>
                                <button type="button" class="btn btn-success cobrarBono" id='{{$obj_abo->id}}' style="padding: 2px 6px;">
                                    <span class="glyphicon glyphicon-ok"></span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop