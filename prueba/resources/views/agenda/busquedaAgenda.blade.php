@extends('agendaLayout.busquedaAgenda')
@section('agendaDia')
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
            <tr>
                <td class="est_{{$agendas->establecimientos_id}}">{{date('d/m/Y H:i',strtotime($agendas->inicio))}}<br>{{date('d/m/Y H:i',strtotime($agendas->fin))}}</td>
                @php($obj_pcp = $arr_pcp->find($agendas->pacientes_id))
                @php($obj_fun = $arr_fun->find($agendas->funcionarios_id))
                @php($estado  = $arr_est->find($agendas->estado_agenda_id))
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

        </tbody>
    </table>
@stop