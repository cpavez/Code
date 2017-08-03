@extends('fichaLayout.epiEvolucionKine')

@section('prestaciones')
    <table class="table">
        <thead>
            <tr>
                <th>Session</th>
                <th>Tratamiento</th>
                <th>Evolucion</th>
                <th>Indicaciones</th>
                <th>Opciones</th>
            </tr>
        </thead>
        @foreach($arr_evo as $obj_evo)
            @if($obj_evo->insertado == 1)
                <tr>
                    <td>{{$obj_evo->descripcion}}</td>
                    <td><textarea rows="3" class="form-control" id="tratamiento_{{$obj_evo->id}}">{{$obj_evo->tratamiento}}</textarea></td>
                    <td><textarea rows="3" class="form-control" id="evolucion_{{$obj_evo->id}}">{{$obj_evo->evolucion}}</textarea></td>
                    <td><textarea rows="3" class="form-control" id="indicaciones_{{$obj_evo->id}}">{{$obj_evo->indicaciones}}</textarea></td>
                    <td>-</td>
                </tr>
            @else
                <tr>
                    <td>{{$obj_evo->descripcion}}</td>
                    <td><textarea rows="3" class="form-control" id="tratamiento_{{$obj_evo->id}}"></textarea></td>
                    <td><textarea rows="3" class="form-control" id="evolucion_{{$obj_evo->id}}"></textarea></td>
                    <td><textarea rows="3" class="form-control" id="indicaciones_{{$obj_evo->id}}"></textarea></td>
                    <td><button type="button" class="btn btn-success agregarEvolucion" id='{{$obj_evo->id}}'>Guardar</button></td>
                </tr>
            @endif
        @endforeach
    </table>

@stop
