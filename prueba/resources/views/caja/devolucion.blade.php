@extends('cajaLayout.devolucion')
@section('ingresos')
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="label label-info">Ingresos <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></span></div>
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
                        <th>Devolución</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($arr_ingresos)
                        @foreach($arr_ingresos as $obj_abo)
                            @php($tip_abo = $tipo_anbono->find($obj_abo->tipo_abono_id))
                            @if($obj_abo->banco_id)
                                @php($banco_che = $obj_ban_che->find($obj_abo->banco_id))
                                @php($banco = $banco_che->descripcion)
                            @else
                                @php($banco = '')
                            @endif
                            <tr>
                                <td>{{$obj_abo->documento}}</td>
                                <td>{{$tip_abo->descripcion}}</td>
                                <td>{{$banco}}</td>
                                <td>{{$obj_abo->created_at}}</td>
                                <td>{{($obj_abo->cobrado == 1)?'SI':'NO'}}</td>
                                <td>${{number_format($obj_abo->valor, 0, ",", ".")}}</td>
                                <td style="text-align: center;">
                                    <button type="button" href="#modDevolucion" data-toggle="modal" class="btn btn-success realizarDevolucion" id='{{$obj_abo->id}}' rel="{{$obj_abo->valor}}" style="padding: 2px 6px;">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop