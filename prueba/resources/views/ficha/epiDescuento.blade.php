@extends('fichaLayout.epiDescuento')

@section('agregar_descuento')
    <div class="row" style="margin-top:20px;">
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
            <div class="col-xs-2">
                <button type="button" class="btn btn-success" id='agregarDescuento' >Agregar</button>
            </div>
        </div>
    </div>
@stop

@section('tabla_descuento')
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
@stop