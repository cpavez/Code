@extends('fichaLayout.formPagos')

@section('efectivo')
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="label label-info">Efectivo <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></span></div>

            <div class="panel-body" style="font-size:16px;">
                <table class="table table-condensed tabla-abonos">
                    <thead>
                    <tr>
                        <th># Documento</th>
                        <th>Fecha</th>
                        <th>Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($obj_epi_efe as $obj_epi)
                        @php($efectivo = $obj_abo->where('episodio_id','=',$obj_epi->id)->where('tipo_abono_id','=',1)->where('activo','=',1)->get())
                        @foreach($efectivo as $obj_abo)
                            <tr>
                                <td>{{$obj_abo->documento}}</td>
                                <td>{{$obj_abo->created_at}}</td>
                                <td>${{number_format($obj_abo->valor, 0, ",", ".")}}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('bono')
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="label label-info">Bono <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></span></div>
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
                    @foreach($obj_epi_bon as $obj_epi)
                        @php($bono = $obj_abo->where('episodio_id','=',$obj_epi->id)->where('tipo_abono_id','=',4)->where('activo','=',1)->get())
                        @foreach($bono as $obj_abo)
                            <tr>
                                <td>{{$obj_abo->documento}}</td>
                                <td>{{$obj_abo->created_at}}</td>
                                <td>${{number_format($obj_abo->valor, 0, ",", ".")}}</td>
                                <td>{{($obj_abo->cobrado == 1) ? "Si" : "No"}}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop

@section('cheque')
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="label label-info">Cheque <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></span></div>
            <div class="panel-body" style="font-size:16px;">
                <table class="table table-condensed tabla-abonos">
                    <thead>
                    <tr>
                        <th># Documento</th>
                        <th>Banco</th>
                        <th>Fecha Recepción</th>
                        <th>Valor</th>
                        <th>Cobrado</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($obj_epi_che as $obj_epi)
                        @php($cheque = $obj_abo->where('episodio_id','=',$obj_epi->id)->where('tipo_abono_id','=',2)->where('activo','=',1)->get())
                        @foreach($cheque as $obj_abo)
                            @php($banco_che = $obj_ban_che->find($obj_abo->banco_id))
                            <tr>
                                <td>{{$obj_abo->documento}}</td>
                                <td>{{$banco_che->descripcion}}</td>
                                <td>{{$obj_abo->created_at}}</td>
                                <td>${{number_format($obj_abo->valor, 0, ",", ".")}}</td>
                                <td>{{($obj_abo->cobrado == 1) ? "Si" : "No"}}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('t_bancaria')
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="label label-info">Transferencia Bancaria <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></span></div>
            <div class="panel-body" style="font-size:16px;">
                <table class="table table-condensed tabla-abonos">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Banco</th>
                        <th>Fecha</th>
                        <th>Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($obj_epi_che as $obj_epi)
                        @php($trans = $obj_abo->where('episodio_id','=',$obj_epi->id)->where('tipo_abono_id','=',3)->where('activo','=',1)->get())
                        @foreach($trans as $obj_abo)
                            @php($banco_tra = $obj_ban_tra->find($obj_abo->banco_id))
                            <tr>
                                <td>{{$obj_abo->documento}}</td>
                                <td>{{$banco_tra->descripcion}}</td>
                                <td>{{$obj_abo->created_at}}</td>
                                <td>${{number_format($obj_abo->valor, 0, ",", ".")}}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

