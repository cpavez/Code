@extends('agendaLayout.agenda')

@section('medico')
    <div class="col-sm-3" style="margin-top:6px;">
        <select class="form-control input-sm" id='medico' style="height: 25px;line-height: 25px;margin-left: -22px;margin-top:-3px;">
            @foreach($obj_fun as $funcionario)
                @if($obj_fun_->id == $funcionario->id )
                    <option selected="selected" value='{{$funcionario->id}}'>{{$funcionario->nombres}} {{$funcionario->apellido_pat}}</option>
                @else
                    <option value='{{$funcionario->id}}'>{{$funcionario->nombres}} {{$funcionario->apellido_pat}}</option>
                @endif

            @endforeach
        </select>
    </div>
@stop
