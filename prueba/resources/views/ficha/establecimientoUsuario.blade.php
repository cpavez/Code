@extends('fichaLayout.establecimientoUsuario')

@section('establecimiento')

    @if(count($arr_esb) > 0)
        @foreach($arr_esb as $obj_esb)
            <div class="col-sm-4">
                <div class="choice" data-toggle="wizard-radio">
                    <input type="radio" name="job" value="{{$obj_esb->id}}" id="{{$obj_esb->id}}"/>
                    <div class="icon">
                        <i class="fa fa-pencil"></i>
                    </div>
                    <h6>{{$obj_esb->descripcion}}</h6>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-sm-4">
            <div class="choice" data-toggle="wizard-radio">
                <input type="radio" name="job" value="0">
                <div class="icon">
                    <i class="fa fa-pencil"></i>
                </div>
                <h6>NO TIENE ASOCIADO NINGUN ESTABLECIMIENTO</h6>
            </div>
        </div>
    @endif

    <input type="hidden" id="esb_id" value="">
    <input type="hidden" id='usu_id' value="{{$usu_id}}"/>
@stop
