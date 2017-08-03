@extends('cajaLayout.repDevoluciones')
@section('devoluciones')
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="label label-info">Devoluciones <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></span></div>
            <div class="panel-body" style="font-size:16px;">
                <table class="table table-condensed tabla-abonos">
                    <thead>
                    <tr>
                        <th># Documento Abono</th>
                        <th># Documento Devolucion</th>
                        <th>Fecha Recepción</th>
                        <th>Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($total = 0)
                    @foreach($arr_devoluciones as $obj_dev)
                        @php($total = ($total + $obj_dev->monto))
                        <tr>
                            <td>{{$obj_dev->documento}}</td>
                            <td>{{$obj_dev->numeroDocumento}}</td>
                            <td>{{$obj_dev->created_at}}</td>
                            <td>${{number_format($obj_dev->monto, 0, ",", ".")}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>TOTAL</td>
                        <td></td>
                        <td></td>
                        <td>${{number_format($total, 0, ",", ".")}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop