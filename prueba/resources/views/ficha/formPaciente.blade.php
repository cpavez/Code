@extends('fichaLayout.formPaciente')

@section('formulario')

    <div class="label-primary" style="color: #fff; height: 35px;width: 100%;line-height: 35px;padding-left: 10px;">Paciente</div>

    <div style="  position: absolute;top: 35px;bottom: 0;left: 0;right: 0;overflow-y: scroll;">
        <img class="media-object foto_paciente" src="{{ asset('img/default-avatar.png') }}">

        <form class="form-horizontal" style="width: 700px; padding-top:30px; padding-left:50px; color: #606060;">
            <div class="form-group">
                <label class="control-label col-xs-3" for="nombres">Nombres</label>
                <div class="col-xs-6">
                    <input type="text" class="form-control" name='nombres' id="nombres" value="{{$obj_pcp->nombres}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3" for="apellidoPaterno">Apellido Paterno</label>
                <div class="col-xs-6">
                    <input type="text" class="form-control" name='apellidoPaterno' id="apellidoPaterno" value="{{$obj_pcp->apellido_pat}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3" for="apellidoMaterno">Apellido Materno</label>
                <div class="col-xs-6">
                    <input type="text" class="form-control" name='apellidoMaterno' id="apellidoMaterno" value='{{$obj_pcp->apellido_mat}}'>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3" for="rut">Rut</label>
                <div class="col-xs-6">
                    <input type="text" class="form-control" name='rut' id="rut" value="">
                    <input type="hidden" id='rut_bd' value="{{$obj_pcp->rut}}{{$obj_pcp->dv}}"/>
                    <input type="hidden" id="rut_solo" value="{{$obj_pcp->rut}}">
                    <input type="hidden" id="dv_solo" value="{{$obj_pcp->dv}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3" for="fNacimiento">Fecha Nacimiento</label>
                <div class="col-xs-6">
                    <input type="text" class="form-control datepicker" name='fNacimiento' id="fNacimiento" data-date-format="dd/mm/yyyy" data-provide="datepicker" value="{{$obj_pcp->fecha_nacimiento}}">
                    <span class="glyphicon glyphicon-calendar form-control-feedback" aria-hidden="true"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3" for="email">Email</label>
                <div class="col-xs-6">
                    <input type="email" class="form-control" id="email" name='email' value='{{$obj_pcp->correo}}'>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3" for="observaciones">Observaciones</label>
                <div class="col-xs-8">
                    <textarea rows="3" class="form-control" id="observaciones" name='observaciones'>{{$obj_pcp->observaciones}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3">Convenio</label>
                <div class="col-xs-7">
                    <select class="form-control sel_con" id="convenio">
                        @foreach($obj_con as $convenios)
                            @if($convenios->id === $obj_pcp->convenio_id)
                                <option value="{{$convenios->id}}" selected="selected">{{$convenios->descripcion}}</option>
                            @else
                                <option value="{{$convenios->id}}">{{$convenios->descripcion}}</option>
                            @endif
                        @endforeach
                    </select>
                    <a class="btn btn-success" href="#modConvenio" role="button" data-toggle="modal" style="float: rigth; margin-left: 5px;">+</a>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3">Genero</label>
                <div class="col-xs-6">
                    <select class="form-control" id="sexo">
                        @foreach($obj_sex as $sexos)
                            @if($sexos->id === $obj_pcp->sexo_id)
                                <option value="{{$sexos->id}}" selected="selected">{{$sexos->descripcion}}</option>
                            @else
                                <option value="{{$sexos->id}}">{{$sexos->descripcion}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3" for="ciudad">Ciudad</label>
                <div class="col-xs-6">
                    <select class="form-control sel_con" id="ciudad">
                        @foreach($obj_ciu as $ciudad)
                            @if($ciudad->id === $obj_pcp->ciudad_id)
                                <option value="{{$ciudad->id}}" selected="selected">{{$ciudad->descripcion}}</option>
                            @else
                                <option value="{{$ciudad->id}}">{{$ciudad->descripcion}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3" for="telefonoFijo">Dirección</label>
                <div class="col-xs-6">
                    <input type="tel" class="form-control" id="direccion" name='direccion' value="{{$obj_pcp->direccion}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3" for="telefonoFijo">Telefono Fijo</label>
                <div class="col-xs-6">
                    <input type="tel" class="form-control" id="telefonoFijo" name='telefonoFijo' value="{{$obj_pcp->telefono_fijo}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3" for="telefonoMovil">Telefono Movil</label>
                <div class="col-xs-6">
                    <input type="tel" class="form-control" id="telefonoMovil" name="telefonoMovil" value='{{$obj_pcp->telefono_celular}}'>
                </div>
            </div>
            <br>
            <div class="form-group">
                <div class="col-xs-offset-3 col-xs-9">
                    <button type="button" id='modificar' class="btn btn-success">Modificar</button>
                </div>
            </div>
        </form>
    </div>
@stop

@section('modal')
    <div id="modConvenio" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modConvenio">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Convenios</h4>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Convenio:</label>
                            <input type="text" class="form-control"  id='conConvenio'>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Porcentaje:</label>
                            <input type="text" class="form-control" id='conPorcentaje'>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id='agreagrConvenio'>Guardar</button>
                </div>
            </div>
        </div>
    </div>

@stop
