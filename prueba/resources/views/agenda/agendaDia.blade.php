@extends('agendaLayout.agendaDia')
@section('citas')
    <div style='position:absolute; left:0px;width:300px;bottom: 0;border-right:1px solid #414141;top:0;'>
        <ul class="list-group" style="color:#606060;">
            <li class="list-group-item center no_border" id='fecha_palabras'>

            </li>
            <li class="list-group-item center no_border">
                Citas <span class="badge">{{$cantidad}}</span>
            </li>
            <li class="list-group-item no_border">
                <input type="checkbox" checked> Marcar todos
            </li>
            <li class="list-group-item no_border" style="border-bottom:0;">
                @foreach($arr_est as $estado)
                    <div class="oaerror line_{{$estado->id}}"><input type="checkbox" checked> {{$estado->descripcion}}</div>
                @endforeach

            </li>
        </ul>
    </div>
@stop
@section('agendaDia')
    <div style="position:absolute;left:299px;right:0;">
        <table class="table table-hover" style="color:#606060;">
            <thead>
            <tr style="border: 1px solid #414141;">
                <th>Hora</th>
                <th>Paciente</th>
                <th>Médico</th>
                <th>Estado cita</th>
                <th>Motivo</th>
            </tr>
            </thead>
            <tbody >

            @foreach($agenda as $agendas)
                <tr id="{{$agendas->id}}">
                    <td class="est_{{$agendas->estado_agenda_id}}">{{date('H:i',strtotime($agendas->inicio))}}-{{date('H:i',strtotime($agendas->fin))}}</td>
                    @php($obj_pcp = $arr_pcp->find($agendas->pacientes_id))
                    @php($obj_fun = $arr_fun->find($agendas->funcionarios_id))
                    <td>{{ucwords(strtolower($obj_pcp->nombres))}} {{ucwords(strtolower($obj_pcp->apellido_pat))}} {{ucwords(strtolower($obj_pcp->apellido_mat))}}<br>
                        {{$obj_pcp->telefono_fijo}}-{{$obj_pcp->telefono_celular}}
                    </td>
                    <td>Dr(a).{{ucwords(strtolower($obj_fun->nombres))}} {{ucwords(strtolower($obj_fun->apellido_pat))}}</td>
                    <td>
                        <select class="form-control input-sm estado">
                        @foreach($arr_est as $estado)

                            @if($estado->id === $agendas->estado_agenda_id)
                                <option value="{{$estado->id}}" selected="selected">{{$estado->descripcion}}</option>
                            @else
                                    <option value="{{$estado->id}}">{{$estado->descripcion}}</option>
                            @endif
                        @endforeach
                        </select>
                    </td>
                    <td class="borde_right"><span class="label label-success">{{$agendas->comentario}}</span></td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@stop

