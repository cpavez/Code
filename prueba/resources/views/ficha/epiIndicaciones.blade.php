@extends('fichaLayout.epiIndicaciones')

@section('agregar_indicacion')
    <div class="page-header" style="margin: 25px 0 20px;">
        <h2>Indicaciones para la Casa</h2>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="col-xs-10">
                <textarea rows="3" class="form-control" id="epicrisis"></textarea>
            </div>
            <div class="col-xs-2" style="margin-top:10px;">
                <button type="button" class="btn btn-success" id='agregar'>Agregar</button>
            </div>
        </div>
    </div>
@stop

@section('indicaciones')
    <div class="row">
        <div class="col-sm-12">
            @if(isset($obj_ind))
                @foreach($obj_ind as $obj_ind)
                    @php($obj_usu = $obj_usu->find($obj_ind->usuario_id))
                    @php($obj_fun = $obj_fun->find($obj_usu->funcionarios_id))
                    <div class="bs-example" style="overflow: hidden;" data-example-id="blockquote-reverse">
                        <blockquote class="blockquote-reverse">
                            <p>{{strtoupper($obj_ind->indicacion)}}.</p>
                            <footer>{{ucwords(strtolower($obj_fun->nombres))}} {{ucwords(strtolower($obj_fun->apellido_pat))}} {{ucwords(strtolower($obj_fun->apellido_mat))}}
                                <cite title="Source Title">{{$obj_ind->created_at}}</cite>
                            </footer>
                        </blockquote>
                    </div>
                @endforeach
            @else

            @endif

        </div>
    </div>
@stop
