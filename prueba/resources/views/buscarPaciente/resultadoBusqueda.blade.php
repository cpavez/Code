@extends('buscarPacienteLayout.resultadoBusqueda')
@section('resultadoBusqueda')
    <thead>
    <tr style="font-size: 21px">
        <th>Hora</th>
        <th>Paciente</th>
        <th>Médico</th>
        <th>Estado cita</th>
        <th>Motivo</th>
    </tr>
    </thead>
    <tbody style="cursor: pointer;" >
    @if(isset($arr_pcp))
        @foreach($arr_pcp as $agendas)
            <tr id="{{$agendas->id}}">
                <td class="est_{{$agendas->estado_agenda_id}}">{{date('H:i',strtotime($agendas->inicio))}}-{{date('H:i',strtotime($agendas->fin))}}</td>
                @php($obj_pcp = $arr_pcp->find($agendas->pacientes_id))
                @php($obj_fun = $obj_fun->find($agendas->funcionarios_id))
                @php($estado = $obj_est->find($agendas->estado_agenda_id))
                <td>{{ucwords(strtolower($obj_pcp->nombres))}} {{ucwords(strtolower($obj_pcp->apellido_pat))}} {{ucwords(strtolower($obj_pcp->apellido_mat))}}<br>
                    {{$obj_pcp->telefono_fijo}}-{{$obj_pcp->telefono_celular}}
                </td>
                <td>Dr(a).{{ucwords(strtolower($obj_fun->nombres))}} {{ucwords(strtolower($obj_fun->apellido_pat))}}</td>
                <td>
                    {{$estado->descripcion}}
                </td>
                <td class="borde_right"><span class="label label-success">{{$agendas->comentario}}</span></td>
            </tr>
        @endforeach
    @endif
    </tbody>
@stop