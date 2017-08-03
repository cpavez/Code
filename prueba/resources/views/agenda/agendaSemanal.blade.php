@extends('agendaLayout.agendaSemanal')


@section('modAgregar')
    <div id="modAgendar" class="modal fade" tabindex="-1" role="dialog">
        <input type="hidden" id='mod_fecha'/>
        <input type="hidden" id='mod_fini'/>
        <input type="hidden" id='mod_ffin'/>
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id='mostrarFecha'></h4>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Paciente:</label>
                            <input type="text" class="typeahead" style="width:220px; font-size: 16px;" id="paciente" />
                            <input type="hidden" id='paciente_id'/>
                            <a data-toggle="modal" id='prueba' href="#modPaciente" class="btn btn-success" style="margin-bottom: -5px;"><span class="glyphicon glyphicon-plus"></span></a>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Comentario:</label>
                            <textarea rows="3" class="form-control" id="comentario"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Estado:</label>
                            <select class="form-control input-sm" id="estado" style="height: 22px;line-height: 22px;">
                                @foreach($estados as $estado)
                                    <option value="{{$estado->id}}">{{$estado->descripcion}}</option>
                                @endforeach
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary">Cerrar</button>
                    <button type="button" id='guardar' class="btn btn-success">Guardar</button>
                    <button type="button" id='bloquear' class="btn btn-danger">Bloquear</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('modModificar')
    <div id="modModificar" class="modal fade">
        <input type="hidden" id='evento_id'/>
        <input type="hidden" id='evento'/>
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id='mostrarFechaMod'></h4>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Paciente:</label>
                            <input type="text" class="typeahead" style="width:270px;font-size: 16px;" id="paciente_mod">
                            <input type="hidden" id='paciente_mod_id'/>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Comentario:</label>
                            <textarea rows="3" class="form-control" id="comentario_mod"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Estado:</label>
                            <select class="form-control input-sm" id="estado_mod" style="height: 22px;line-height: 22px;">
                                @foreach($estados as $estado)
                                    <option value="{{$estado->id}}">{{$estado->descripcion}}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary">Cerrar</button>
                    <button type="button" id='modificar' class="btn btn-success">Modificar</button>
                    <button type="button" id='eliminar' class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('paciente')
    <div id="modPaciente" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Paciente</h4>
                </div>
                <div class="modal-body" style="overflow-x:auto; height:500px;">
                    <form class="form-horizontal" style="padding-left:20px; color: #606060;">
                        <div class="form-group">
                            <label class="control-label col-xs-3" for="rut">Rut</label>
                            <div class="col-xs-6">
                                <input type="text" class="form-control" id="rut"/>
                                <input type="hidden" id="pcp_text_id"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3" for="nombres">Nombres</label>
                            <div class="col-xs-6">
                                <input type="text" class="form-control" id="nombres">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3" for="apellidos">Apellido Paterno</label>
                            <div class="col-xs-6">
                                <input type="text" class="form-control" id="apePaterno">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3" for="apellidos">Apellido Materno</label>
                            <div class="col-xs-6">
                                <input type="text" class="form-control" id="apeMaterno">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3" for="fNacimiento">Fecha Nacimiento</label>
                            <div class="col-xs-6">
                                <input type="text" class="form-control datepicker" id="fNacimiento" data-date-format="dd/mm/yyyy" data-provide="datepicker">
                                <span class="glyphicon glyphicon-calendar form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3" for="email">Email</label>
                            <div class="col-xs-6">
                                <input type="email" class="form-control" id="email" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3">Convenio</label>
                            <div class="col-xs-7">
                                <select class="form-control" id='convenio' style="float: left; width:85%;">
                                    @foreach($convenios as $convenio)
                                        <option value="{{$convenio->id}}">{{$convenio->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3">Ciudad</label>
                            <div class="col-xs-7">
                                <select class="form-control" id='ciudad' style="float: left; width:85%;">
                                    @foreach($ciudades as $ciudad)
                                        <option value="{{$ciudad->id}}">{{$ciudad->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3" for="email">Dirección</label>
                            <div class="col-xs-6">
                                <input type="email" class="form-control" id="direccion" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3">Sexo</label>
                            <div class="col-xs-6">
                                <select class="form-control" id='sexo'>
                                    @foreach($sexos as $sexo)
                                        <option value="{{$sexo->id}}">{{$sexo->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3" for="telefonoFijo">Telefono Fijo</label>
                            <div class="col-xs-6">
                                <input type="tel" class="form-control" id="telefonoFijo" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3" for="telefonoMovil">Telefono Movil</label>
                            <div class="col-xs-6">
                                <input type="tel" class="form-control" id="telefonoMovil" >
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" id='guardarPaciente' class="btn btn-primary">Guardar</button>
                    <button type="button" id='modificarPaciente' class="btn btn-primary" style="display:none;">Modificar</button>
                </div>
            </div>
        </div>
    </div>
@stop