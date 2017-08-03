@extends('fichaLayout.epiUnidadApoyo')

@section('receta')



    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Recetas <a class="btn btn-success" href="#modReceta" role="button" data-toggle="modal" style="position: absolute;right: 20px;top: 4px;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></div>
                <div class="panel-body" style="font-size:16px;">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table">
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
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop

@section('modReceta')
    <div id="modReceta" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Receta</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <span>Medicamento</span>
                            <input type="text" class="form-control" id='medicamento' data-provide="typeahead">
                        </div>
                        <div class="col-xs-4">
                            <span>Dosis</span>
                            <input type="text" class="form-control" id='docis'>
                        </div>
                        <div class="col-xs-2">
                            <span>Cantidad</span>
                            <input type="text" class="form-control" id='cantidad'>
                        </div>
                        <div class="col-xs-2">
                            <span></span>
                            <button type="button" class="btn btn-success" style="margin-top:19px;" id='agregarReceta'>Agregar</button>
                        </div>
                    </div>

                    <div class="row" style="margin-top:15px;">
                        <div class="col-sm-12" id='listReceta'>

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
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Exámenes <a class="btn btn-success" href="#modExamen" role="button" data-toggle="modal" style="position: absolute;right: 20px;top: 4px;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></div>
                <div class="panel-body" style="font-size:16px;">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-xs-12">
                                <table class="table">
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
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@stop

@section('modExamen')
    <div id="modExamen" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Exámenes</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <span>Exámen</span>
                            <input type="text" class="form-control" id='examen'>
                        </div>
                        <div class="col-xs-4">
                            <span>Tipo Exámen</span>
                            <select class="form-control" id='tipoExamen'>
                                @foreach($arr_tpe as $obj_tpe)
                                    <option value="{{$obj_tpe->id}}">{{$obj_tpe->descripcion}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-2">
                            <span>Cantidad</span>
                            <input type="text" class="form-control" id='cantidadExamen'>
                        </div>
                        <div class="col-xs-2">
                            <span></span>
                            <button type="button" class="btn btn-success" style="margin-top:19px;" id='agregarExamen'>Agregar</button>
                        </div>
                    </div>

                    <div class="row" style="margin-top:15px;">
                        <div class="col-sm-12" id='listExamen'>

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