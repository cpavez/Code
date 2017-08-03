@extends('fichaLayout.fichaDetalle')

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
            @if(count($arr_pre) > 0)
                <a href="{{ route('epiPrestaciones',['PrestacionesPDF'=>'pdf',
                                                     'pcp_id'=>  $obj_pcp->id,
                                                     'esb_id'=>$esb_id,
                                                     'epi_id'=>$epi_id]) }}">Presupuesto PDF</a>
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
                            <dt style="width: 76px;">Convenio</dt>
                            <dd style="margin-left: 97px;">{{$obj_con->descripcion}}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('resumen_facturacion')
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">Resumen Facturación</div>
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
                        <dd style="margin-left: 80%;">${{number_format($var_deuda - $var_abono, 0, ",", ".")}}</dd>
                    </dl></h4>
            </div>
        </div>
    </div>
@stop

@section('tabla_prestaciones')
    @if(count($arr_pre) > 0)
        <div style="padding: 20px;">
            <table class="table" id='tabla_prestaciones'>
                <caption>Prestaciones Realizadas</caption>
                <thead>
                <tr>
                    <th>Prestacion</th>
                    <th>Cantidad</th>
                    <th>Fecha Realizo</th>
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
                        <td>{{$epe->descripcion}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@stop

@section('receta')
    @if(count($arr_rec) > 0)
        <div style="padding: 20px;">
            <table class="table" id='tabla_recetas'>
                <caption>Recetas Solicitadas</caption>
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Medico</th>
                    <th>Utilidad</th>
                </tr>
                </thead>
                <tbody>
                @foreach($arr_rec as $obj_rec)
                    @php($obj_usu = $arr_usu->find($obj_rec->usuarios_id))
                    @php($obj_fun = $arr_fun->find($obj_usu->funcionarios_id))
                    <tr>
                        <td>{{$obj_rec->fecha}}</td>
                        <td>{{$obj_fun->nombres}} {{$obj_fun->apellido_pat}}</td>
                        <td>
                            <button type="button" class="btn btn-info detalleReceta" id='{{$obj_rec->fecha}}' style="padding: 2px 6px;"><span class="glyphicon glyphicon-eye-open"></span></button>
                            <a  href="{{ route('epiUnidadApoyo',['recetaPDF'=>'pdf',
                                                                                     'pcp_id'=>$obj_pcp->id,
                                                                                     'esb_id'=>$esb_id,
                                                                                     'epi_id'=>$epi_id,
                                                                                     'fecha'=>$obj_rec->fecha]) }}" class="btn btn-success" style="padding: 2px 6px;"><span class="glyphicon glyphicon-print"></span></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@stop

@section('modRecetaDetalle')
    <div id="modRecetaDetalle" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Receta</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin-top:15px;">
                        <div class="col-sm-12" id='listRecetaDetalle'>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id='cerrarReceta'>Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('examen')
    @if(count($arr_exa) > 0)
        <div style="padding: 20px;">
            <table class="table" id='tabla_recetas'>
                <caption>Exámenes Solicitados</caption>
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Medico</th>
                    <th>Utilidad</th>
                </tr>
                </thead>
                <tbody>
                @foreach($arr_exa as $obj_exa)
                    @php($obj_usu = $arr_usu->find($obj_exa->usuarios_id))
                    @php($obj_fun = $arr_fun->find($obj_usu->funcionarios_id))
                    <tr>
                        <td>{{$obj_exa->fecha}}</td>
                        <td>{{$obj_fun->nombres}} {{$obj_fun->apellido_pat}}</td>
                        <td>
                            <button type="button" class="btn btn-info detalleExamen" id='{{$obj_exa->fecha}}' style="padding: 2px 6px;">
                                <span class="glyphicon glyphicon-eye-open"></span>
                            </button>
                            <a  href="{{ route('epiUnidadApoyo',['examenPDF'=>'pdf',
                                                                                         'pcp_id'=>$obj_pcp->id,
                                                                                         'esb_id'=>$esb_id,
                                                                                         'epi_id'=>$epi_id,
                                                                                         'fecha'=>$obj_exa->fecha]) }}" class="btn btn-success" style="padding: 2px 6px;"><span class="glyphicon glyphicon-print"></span></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@stop

@section('modExamenDetalle')
    <div id="modExamenDetalle" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Examen</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin-top:15px;">
                        <div class="col-sm-12" id='listExamenDetalle'>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id='cerrarExamen'>Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('evoluciones')
    @if($evolucion)
        <div class="col-sm-12">
            <table class="table" id='tabla_recetas' style="margin-bottom: -15px;">
                <caption>Evolucion</caption>

            </table>
            @if(isset($obj_evo))
                @foreach($obj_evo as $obj_evo)
                    @php($obj_usu = $obj_usu->find($obj_evo->usuarios_id))
                    @php($obj_fun = $obj_fun->find($obj_usu->funcionarios_id))
                    <div class="bs-example" style="overflow: hidden;" data-example-id="blockquote-reverse">
                        <blockquote class="blockquote-reverse">
                            <p>{{strtoupper($obj_evo->evolucion)}}.</p>
                            <footer>{{ucwords(strtolower($obj_fun->nombres))}} {{ucwords(strtolower($obj_fun->apellido_pat))}} {{ucwords(strtolower($obj_fun->apellido_mat))}}
                                <cite title="Source Title">{{$obj_evo->created_at}}</cite>
                            </footer>
                        </blockquote>
                    </div>
                @endforeach
            @else

            @endif
        </div>
    @endif
@stop

@section('indicaciones')
    @if($indicaciones)
        <div class="col-sm-12">
            <table class="table" id='tabla_recetas' style="margin-bottom: -15px;">
                <caption>Indicaciones</caption>

            </table>
            @if(isset($obj_ind))
                @foreach($obj_ind as $obj_ind)
                    @php($obj_usu = $obj_usu->find($obj_ind->usuario_id))
                    @php($obj_fun = $obj_fun->find($obj_usu->funcionarios_id))
                    <div class="bs-example" style="overflow: hidden;" data-example-id="blockquote-reverse">
                        <blockquote class="blockquote-reverse">
                            <p>{{strtoupper($obj_ind->indicacion)}}.</p>
                            <footer>{{ucwords(strtolower($obj_fun->nombres))}} {{ucwords(strtolower($obj_fun->apellido_pat))}} {{ucwords(strtolower($obj_fun->apellido_mat))}}
                                <cite title="Source Title">{{$obj_ind->created_at}}</cite>
                            </footer>
                        </blockquote>
                    </div>
                @endforeach
            @else

            @endif

        </div>
    @endif
@stop

@section('eva')
    @if(count($anamnesis) > 0)
        <div class="col-sm-12">
            <table class="table" id='tabla_recetas' style="margin-bottom: -15px;">
                <caption>Motivo de Consulta</caption>
            </table>
            <div class="bs-example" style="overflow: hidden;" data-example-id="blockquote-reverse">
                <blockquote class="blockquote-reverse">
                    <p>{{strtoupper($motivoConsulta)}}.</p>

                </blockquote>
            </div>
        </div>
        <div class="col-sm-12">
            <table class="table" id='tabla_recetas' style="margin-bottom: -15px;">
                <caption>EVA</caption>
            </table>
            <div class="bs-example" style="overflow: hidden;" data-example-id="blockquote-reverse">
                <blockquote class="blockquote-reverse">
                    <div class="col-sm-7 col-sm-offset-5">
                        <div class="progress" id="slider" style="margin-left: 30px;margin-right: 20px;">
                            <div class="progress-bar" id="id_progreso_eva" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$eva}}%;" ></div>
                        </div>
                        <div>
                            <img src="{{ asset('img/eva.png') }}" style="width:400px;" alt="eva" id="evaimg">&nbsp;
                        </div>
                    </div>
                </blockquote>
            </div>
        </div>
        <div class="col-sm-12">
            <table class="table" id='tabla_recetas' style="margin-bottom: -15px;">
                <caption>Frecuencia</caption>
            </table>
            <div class="bs-example" style="overflow: hidden;" data-example-id="blockquote-reverse">
                <blockquote class="blockquote-reverse">
                    <p>{{strtoupper($frecuencia)}}.</p>

                </blockquote>
            </div>
        </div>
        <div class="col-sm-12">
            <table class="table" id='tabla_recetas' style="margin-bottom: -15px;">
                <caption>Zona</caption>
            </table>
            <div class="bs-example" style="overflow: hidden;" data-example-id="blockquote-reverse">
                <blockquote class="blockquote-reverse">
                    <p>{{strtoupper($zona)}}.</p>

                </blockquote>
            </div>
        </div>
        <div class="col-sm-12">
            <table class="table" id='tabla_recetas' style="margin-bottom: -15px;">
                <caption>Exámen Físico</caption>
            </table>
            <div class="bs-example" style="overflow: hidden;" data-example-id="blockquote-reverse">
                <blockquote class="blockquote-reverse">
                    <p>{{strtoupper($examenFisico)}}.</p>

                </blockquote>
            </div>
        </div>

    @elseif(count($anamnesisPediatrica) > 0)
        <div class="col-sm-12">
            <table class="table" id='tabla_recetas' style="margin-bottom: -15px;">
                <caption>Motivo de Consulta</caption>
            </table>
            <div class="bs-example" style="overflow: hidden;" data-example-id="blockquote-reverse">
                <blockquote class="blockquote-reverse">
                    <p>{{strtoupper($motivoConsulta)}}.</p>

                </blockquote>
            </div>
        </div>
        <div class="col-sm-12">
            <table class="table" id='tabla_recetas' style="margin-bottom: -15px;">
                <caption>EVA</caption>
            </table>
            <div class="bs-example" style="overflow: hidden;" data-example-id="blockquote-reverse">
                <blockquote class="blockquote-reverse">
                    <div class="col-sm-7 col-sm-offset-5">
                        <div class="progress" id="slider" style="margin-left: 30px;margin-right: 20px;">
                            <div class="progress-bar" id="id_progreso_eva" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$eva}}%;" ></div>
                        </div>
                        <div>
                            <img src="{{ asset('img/eva.png') }}" style="width:400px;" alt="eva" id="evaimg">&nbsp;
                        </div>
                    </div>
                </blockquote>
            </div>
        </div>
        <div class="col-sm-12">
            <table class="table" id='tabla_recetas' style="margin-bottom: -15px;">
                <caption>Frecuencia</caption>
            </table>
            <div class="bs-example" style="overflow: hidden;" data-example-id="blockquote-reverse">
                <blockquote class="blockquote-reverse">
                    <p>{{strtoupper($frecuencia)}}.</p>

                </blockquote>
            </div>
        </div>
        <div class="col-sm-12">
            <table class="table" id='tabla_recetas' style="margin-bottom: -15px;">
                <caption>Zona</caption>
            </table>
            <div class="bs-example" style="overflow: hidden;" data-example-id="blockquote-reverse">
                <blockquote class="blockquote-reverse">
                    <p>{{strtoupper($zona)}}.</p>

                </blockquote>
            </div>
        </div>
        <div class="col-sm-12">
            <table class="table" id='tabla_recetas' style="margin-bottom: -15px;">
                <caption>Exámen Físico</caption>
            </table>
            <div class="bs-example" style="overflow: hidden;" data-example-id="blockquote-reverse">
                <blockquote class="blockquote-reverse">
                    <p>{{strtoupper($examenFisico)}}.</p>

                </blockquote>
            </div>
        </div>

        <div class="col-sm-12">
            <table class="table" id='tabla_recetas' style="margin-bottom: -15px;">
                <caption>Exámen Ocular</caption>
            </table>
            <div class="bs-example" style="overflow: hidden;" data-example-id="blockquote-reverse">
                <blockquote class="blockquote-reverse">
                    <p>{{strtoupper($examenOcular)}}.</p>

                </blockquote>
            </div>
        </div>
        <div class="col-sm-12">
            <table class="table" id='tabla_recetas' style="margin-bottom: -15px;">
                <caption>Exámen Oído</caption>
            </table>
            <div class="bs-example" style="overflow: hidden;" data-example-id="blockquote-reverse">
                <blockquote class="blockquote-reverse">
                    <p>{{strtoupper($examenOido)}}.</p>

                </blockquote>
            </div>
        </div>
        <div class="col-sm-12">
            <table class="table" id='tabla_recetas' style="margin-bottom: -15px;">
                <caption>Exámen Lenguaje</caption>
            </table>
            <div class="bs-example" style="overflow: hidden;" data-example-id="blockquote-reverse">
                <blockquote class="blockquote-reverse">
                    <p>{{strtoupper($examenLenguaje)}}.</p>

                </blockquote>
            </div>
        </div>
        <div class="col-sm-12">
            <table class="table" id='tabla_recetas' style="margin-bottom: -15px;">
                <caption>Exámen Dental</caption>
            </table>
            <div class="bs-example" style="overflow: hidden;" data-example-id="blockquote-reverse">
                <blockquote class="blockquote-reverse">
                    <p>{{strtoupper($examenDental)}}.</p>

                </blockquote>
            </div>
        </div>
    @endif

@stop

@section('zona')
    @if($episidioID != '' && $especialidadID == 2)
        <label class="control-label col-xs-3" for="zonaDelDolor">Zona del Dolor</label>
        <div class="col-xs-12">
            <div id="lienzo" style="background:url({{asset('img/male.jpg')}});width:700px;height:436px;cursor: cell;">
                <img src="{{asset('img/cuerpo/'.$episidioID.'.png')}}">
            </div>
        </div>
    @endif
@stop

@section('tabla_sv')
    @if(count($arr_sv) > 0)
        <div class="col-sm-12">
            <table class="table">
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>P. Arterial</th>
                    <th>F. Respiratoria</th>
                    <th>F. Cardiaca</th>
                    <th>Temperatura</th>
                    <th>Talla</th>
                    <th>Peso</th>
                    <th>S. Oxigeno</th>
                </tr>
                </thead>
                <tbody>
                @foreach($arr_sv as $sv)
                    <tr>
                        <td>{{$sv->created_at}}</td>
                        <td>{{$sv->presion_arterial}}</td>
                        <td>{{$sv->frecuencia_respiratoria}}</td>
                        <td>{{$sv->frecuencia_cardiaca}}</td>
                        <td>{{$sv->temperatura_bocal}}</td>
                        <td>{{$sv->talla}}</td>
                        <td>{{$sv->peso}}</td>
                        <td>{{$sv->saturacion_oxigeno}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@stop