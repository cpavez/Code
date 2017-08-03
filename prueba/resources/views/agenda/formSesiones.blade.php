@extends('agendaLayout.formSesiones')


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
                            <input type="text" class="form-control" id="paciente_"  value="{{$obj_pcp->nombres}} {{$obj_pcp->apellido_pat}}"/>
                            <input type="hidden" id='paciente_id_' value="{{$obj_pcp->id}}"/>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Comentario:</label>
                            <textarea rows="3" class="form-control" id="comentario_"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Estado:</label>
                            <select class="form-control input-sm" id="estado_" style="height: 22px;line-height: 22px;">
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
                            <input type="hidden" id='paciente_mod_id'>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Comentario:</label>
                            <textarea rows="3" class="form-control" id="comentario_mod"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Estado:</label>
                            <select class="form-control input-sm" id="estado_mod" style="height: 22px;line-height: 22px;">
                                <option value="1">AGENDADO</option>
                                <option value="1">EN ATENCION</option>
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

