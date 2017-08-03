@extends('fichaLayout.indexAbono')

@section('episodio')
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">Tratamiento #{{$epi_id}}</div>
            <input type="hidden" id='epi_id' value="{{$epi_id}}"/>
            <div class="panel-body" style="font-size:16px;">
                <div class="row">
                    <div class="col-sm-12">
                        <dl class="dl-horizontal d_paciente_abono">
                            <dt>Nombres</dt>
                            <dd>{{ucwords(strtolower($obj_pcp->nombres))}}</dd>
                            <dt>Apellidos</dt>
                            <dd>{{ucwords(strtolower($obj_pcp->apellido_pat))}} {{ucwords(strtolower($obj_pcp->apellido_mat))}}</dd>
                            <dt>Rut</dt>
                            <dd>{{$obj_pcp->rut}}-{{$obj_pcp->dv}}</dd>
                            <dt>Medico</dt>
                            <dd>{{ucwords(strtolower($obj_fun->nombres))}} {{ucwords(strtolower($obj_fun->apellido_pat))}}</dd>
                            <dt>Convenio</dt>
                            <dd>{{$obj_con->descripcion}}</dd>
                            <dt>Descuento</dt>
                            <dd>{{$obj_con->porcentaje}}%</dd>
                        @php($var_total = 0)
                        @php($var_abono = 0)
                        @php($var_otro = 0)
                        @foreach($obj_abo as $sum_abo)
                            @php($var_abono = $var_abono + $sum_abo->valor)
                        @endforeach
                        @foreach($arr_pre as $prestaciones)
                            @php($var_suma = $prestaciones->pivot->cantidad * $prestaciones->valor)
                            @php($var_total = $var_total + $var_suma)
                        @endforeach
                        @foreach($arr_dep as $descuentos)
                            @php($var_otro = $var_otro + $descuentos->pivot->porcentaje)
                        @endforeach
                        @php($var_deuda = $var_total - ($var_total * (($obj_con->porcentaje + $var_otro)/100)))
                            <dt>Otros</dt>
                            <dd>{{$var_otro}}%</dd>
                            <dt class="divider" style="width:100%"></dt>
                        </dl>
                        <h4 class="great total_pagar_abono">
                            <dl class="dl-horizontal">
                                <dt style="width: 120px;">Total a Pagar</dt>
                                <dd style="margin-left: 70%;">${{number_format((int)$var_deuda - $var_abono, 0, ",", ".")}}</dd>
                            </dl>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('abono')
    <div class="col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">Abonos Realizados</div>
            <div class="panel-body" style="font-size:16px;">
                <table class="table table-condensed tabla-abonos">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Valor</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($obj_abo as $obj_abo)
                        @php($arr_tab = $arr_tab->find($obj_abo->tipo_abono_id))
                        <tr>
                            <td>{{$obj_abo->documento}}</td>
                            <td>{{$arr_tab->descripcion}}</td>
                            <td>{{$obj_abo->created_at}}</td>
                            <td>${{number_format($obj_abo->valor, 0, ",", ".")}}</td>
                            <td>
                                <button type="button" class="btn btn-danger eliminarAbono" id='{{$obj_abo->id}}' style="padding: 2px 6px;">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                @if($epi_pagado == 0)
                    <a class="btn btn-success" href="#modAbono" role="button" data-toggle="modal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                @endif

            </div>
        </div>
    </div>
@stop

@section('modAbono')
    <div id="modAbono" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Abonar</h4>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Valor:</label>
                            <input type="text" class="form-control" id="valor">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Nº Documento:</label>
                            <input type="text" class="form-control" id="documento">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Tipo Abono:</label>
                            <select class="form-control" id='tipoAbono'>
                                @foreach($obj_tab as $obj_tab)
                                    <option value="{{$obj_tab->id}}">{{$obj_tab->descripcion}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" style="display:none;" id='cont_banco'>
                            <label for="message-text" class="control-label">Banco:</label>
                            <select class="form-control" id='banco'>
                                <option value="" selected="selected">SELECCIONE</option>
                                @foreach($obj_ban as $obj_ban)
                                    <option value="{{$obj_ban->id}}">{{$obj_ban->descripcion}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Cobrado:</label>
                            <select class="form-control" id='cobrado'>
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" id='guardar' class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@stop


