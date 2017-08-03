@extends('cajaLayout.ingresos')
@section('ingresos')
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="label label-info">Abonos <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></span></div>
            <div class="panel-body" style="font-size:16px;">
                <table class="table table-condensed tabla-abonos">
                    <thead>
                    <tr>
                        <th># Documento</th>
                        <th>Tipo Documento</th>
                        <th>Banco</th>
                        <th>Fecha Recepción</th>
                        <th>Cobrado</th>
                        <th>Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($total = 0)
                    @foreach($arr_ingresos as $obj_abo)
                        @php($tip_abo = $tipo_anbono->find($obj_abo->tipo_abono_id))
                        @if($obj_abo->banco_id)
                            @php($banco_che = $obj_ban_che->find($obj_abo->banco_id))
                            @php($banco = $banco_che->descripcion)
                        @else
                            @php($banco = '')
                        @endif
                        @php($total = ($total + $obj_abo->valor))
                        <tr>
                            <td>{{$obj_abo->documento}}</td>
                            <td>{{$tip_abo->descripcion}}</td>
                            <td>{{$banco}}</td>
                            <td>{{$obj_abo->created_at}}</td>
                            <td>{{($obj_abo->cobrado == 1)?'SI':'NO'}}</td>
                            <td>${{number_format($obj_abo->valor, 0, ",", ".")}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>TOTAL</td>
                        <td></td>
                        <td></td>
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