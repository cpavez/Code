@extends('fichaLayout.epiEpisodio')

@section('pdf')
    <div class="panel panel-default">
        <div class="panel-heading">Documentos</div>
        <div class="panel-body" style="font-size:16px;">
            @if($indicaciones)
            <a href="{{ route('epiEpisodio',['IndicacionesPDF'=>'pdf',
                                             'pcp_id'=>  $obj_pcp->id,
                                             'esb_id'=>$esb_id,
                                             'epi_id'=>$epi_id]) }}">Indicaciones PDF</a>
            @endif
        </div>
    </div>
@stop

@section('alertas')

    <div class="panel panel-default">
        <div class="panel-heading">Antecedentes</div>
        <div class="panel-body" style="font-size:16px;">
            @foreach($obj_ant as $obj_ant)
                <span class="label label-danger">{{$obj_ant->descripcion}}</span>
            @endforeach

        </div>
    </div>
@stop

@section('datos_paciente')
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">Datos del Paciente</div>
            <div class="panel-body" style="font-size:16px;">
                <div class="row">
                    <div class="col-sm-2">
                        <img class="media-object foto_paciente_epi" src="{{ asset('img/default-avatar.png') }}">
                    </div>
                    <div class="col-sm-10">
                        <dl class="dl-horizontal d_paciente">
                            <dt>Nombres</dt>
                            <dd>{{ucwords(strtolower($obj_pcp->nombres))}}</dd>
                            <dt>Apellidos</dt>
                            <dd>{{ucwords(strtolower($obj_pcp->apellido_pat))}} {{ucwords(strtolower($obj_pcp->apellido_mat))}}</dd>
                            <dt>Rut</dt>
                            <dd>{{$obj_pcp->rut}}-{{$obj_pcp->dv}}</dd>
                            <dt>Medico</dt>
                            <dd>{{ucwords(strtolower($obj_fun->nombres))}} {{ucwords(strtolower($obj_fun->apellido_pat))}}</dd>
                            <dt>Descuento</dt>
                            <dd>{{$obj_con->porcentaje}}%</dd>
                        </dl>
                    </div>
                    <div class="col-sm-12">
                        <dl class="dl-horizontal d_paciente">
                            <dt>Convenio</dt>
                            <dd>{{$obj_con->descripcion}}</dd>
                        </dl>
                    </div>
                </div>
                <a class="btn btn-success" href="#modFinalizar" role="button" data-toggle="modal" style="margin-left: 5px;">Finalizar</a>
                <a class="btn btn-danger" href="#" id="eliminarEpisodio" role="button" style="margin-left: 5px;">Eliminar</a>
            </div>
        </div>
    </div>
@stop

@section('resumen_facturacion')
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Resumen Facturación
                <div class="btn-group" role="group" aria-label="..." style="right: 20px;top: 4px;">
                    <button type="button" href="#modAgregarDescuento" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button>
                    <button type="button" href="#modListarDescuento" data-toggle="modal" class="btn btn-success"><span class="glyphicon glyphicon-tasks"></span></button>
                </div>
            </div>
            <div class="panel-body" style="font-size:16px;">

                @php($var_total = 0 )
                @php($var_abono = 0)
                @php($var_otro = 0)
                @foreach($obj_abo as $obj_abo)
                    @php($var_abono = $var_abono + $obj_abo->valor)
                @endforeach
                @foreach($arr_pre as $prestaciones)
                    @php($var_suma = $prestaciones->pivot->cantidad * $prestaciones->valor)
                    @php($var_total = $var_total + $var_suma)
                @endforeach
                @foreach($arr_dep as $descuentos)
                    @php($var_otro = $var_otro + $descuentos->pivot->porcentaje)
                @endforeach
                <dl class="dl-horizontal">
                    <dt>Total Prestaciones</dt>
                    <dd>${{number_format($var_total, 0, ",", ".")}}</dd>
                    <dt>Anbonado</dt>
                    <dd>${{number_format($var_abono, 0, ",", ".")}}</dd>
                    <dt class="divider" style="width:100%"></dt>
                    <dt>Saldo</dt>
                    <dd style="color:#D32323;">${{number_format($var_total - $var_abono, 0, ",", ".")}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Descuento Convenio</dt>
                    <dd>{{$obj_con->porcentaje}}%</dd>
                    <dt>Otros Descuentos</dt>
                    <dd>{{$var_otro}}%</dd>
                    <dt class="divider" style="width:100%"></dt>
                </dl>
                <h4 class="great total_pagar"><dl class="dl-horizontal">
                        <dt style="width: 190px;">Total a Pagar</dt>
                        @php($var_deuda = $var_total - ($var_total * (($obj_con->porcentaje + $var_otro)/100)))
                        <dd style="margin-left: 0%;">${{number_format($var_deuda - $var_abono, 0, ",", ".")}}</dd>
                    </dl></h4>
            </div>
        </div>
    </div>
@stop

@section('tabla_prestaciones')


    <div style="padding: 20px;">
        <table class="table" id='tabla_prestaciones'>
            <caption>Prestaciones Realizadas</caption>
            <thead>
            <tr>
                <th>Prestacion</th>
                <th>Cantidad</th>
                <th>Fecha Realizo</th>
                <th>Valor</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>

            @foreach($arr_pre as $prestaciones)
                @php($epe = $obj_epe->find($prestaciones->pivot->estado_prestacion_id))
                <tr>
                    <td>{{$prestaciones->descripcion}}</td>
                    <td>{{$prestaciones->pivot->cantidad}}</td>
                    <td>{{$prestaciones->pivot->created_at}}</td>
                    <td>${{number_format($prestaciones->pivot->cantidad * $prestaciones->valor, 0, ",", ".")}}</td>
                    <td>{{$epe->descripcion}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('modal')
    <div id="modFinalizar" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Finalizar Tratamiento</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <dl>
                                <dt>Diagnostico</dt>
                                <dd>
                                    <div class="col-xs-12">
                                        <input type="text" class="form-control" id="diagnostico" >
                                    </div>
                                </dd>
                                <dt class="divider" style="width:100%;margin-top: 50px;margin-bottom: 10px; height: 2px;"></dt>
                                <dt>Epicrisis</dt>
                                <dd>
                                    <div class="col-xs-12">
                                        <textarea rows="6" class="form-control" id="epicrisis"></textarea>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id='guardarCierre'>Guardar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('modalAgregarDescuento')
    <div id="modAgregarDescuento" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Agregar Descuento</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-xs-6">
                                <select class="form-control" id="descuento" style="float: left; width:85%;">
                                    @foreach($arr_des as $obj_des)
                                        <option value="{{$obj_des->id}}">{{$obj_des->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <input class="form-control" id="porcentaje" name="porcentaje" placeholder="% descuento">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id='agregarDescuento'>Guardar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('modalListarDescuento')
    <div id="modListarDescuento" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Listar Descuentos</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Descuento</th>
                                    <th>Fecha</th>
                                    <th>Quien Aprueba</th>
                                    <th>Porcentaje</th>
                                    <th>Eliminar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($arr_dep as $obj_dep)
                                    @php($obj_usu = $obj_usu->find($obj_dep->pivot->usuarios_id))
                                    @php($obj_fun = $obj_fun->find($obj_usu->funcionarios_id))
                                    <tr>
                                        <td>{{$obj_dep->descripcion}}</td>
                                        <td>{{$obj_dep->pivot->created_at}}</td>
                                        <td>{{ucwords(strtolower($obj_fun->nombres))}} {{ucwords(strtolower($obj_fun->apellido_pat))}}</td>
                                        <td>{{$obj_dep->pivot->porcentaje}}%</td>
                                        <td>
                                            <button type="button" id='{{$obj_dep->id}}' class="btn btn-danger eliminarDescuento" style="padding: 2px 6px;">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@stop


