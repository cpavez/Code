@extends('fichaLayout.formEpisodio')


@section('episodios')
    <table class="table table-hover" id='episodios'>
        <caption>Tratamientos Activos</caption>
        <thead>
        <tr>
            <th>#Tratamiento</th>
            <th>Medico</th>
            <th>Tipo Tratamiento</th>
            <th>Especialidad</th>
            <th>Ultima Sesión</th>
        </tr>
        </thead>
        <tbody>
        @foreach($obj_epi as $episodio)
            @php($obj_usu = $arr_usu->find($episodio->usuarios_id))
            @php($obj_fun = $arr_fun->find($obj_usu->funcionarios_id))
            @php($obj_eep = $arr_eep->find($episodio->estado_epi_id))
            <tr id='{{$episodio->id}}' rel="{{$episodio->tipo_episodio_id}}">
                <td>{{$episodio->id}}</td>
                <td>{{$obj_fun->nombres}} {{$obj_fun->apellido_pat}}</td>
                <td>{{$episodio->tipo_tratamiento}}</td>
                <td>{{strtoupper($episodio->descripcion)}}</td>
                <td>{{$episodio->updated_at}}</td>
            </tr>

        @endforeach

        </tbody>
    </table>
@stop

@section('modal')
    <div id="modNuevoEpisodio" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Tipo Tratamiento a Crear</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <dl>
                                <dd>
                                    <div class="col-xs-12">
                                        <select class="form-control" id="tipoTratamiento">
                                            <option value="0">SELECCIONE...</option>
                                            @foreach($arr_tep as $obj_tep)
                                                <option value="{{$obj_tep->id}}">{{$obj_tep->descripcion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id='crearNuevoEpisodio'>Crear</button>
                </div>
            </div>
        </div>
    </div>
@stop