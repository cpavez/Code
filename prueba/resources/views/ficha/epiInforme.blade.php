@extends('fichaLayout.epiInforme')

@section('agregar_informe')
    <div class="page-header" style="margin: 25px 0 20px;">
        <h2>Informe para Medicos</h2>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="col-xs-10">
                <textarea rows="3" class="form-control" id="informe"></textarea>
            </div>
            <div class="col-xs-2" style="margin-top:10px;">
                <button type="button" class="btn btn-success" id='agregarInforme'>Agregar</button>
            </div>
        </div>
    </div>
@stop

@section('listarInforme')
    <div class="row">
        <div class="col-sm-12">
            @if(isset($arr_informe))
                @foreach($arr_informe as $obj_informe)
                    @php($obj_usu = $obj_usu->find($obj_informe->usuario_id))
                    @php($obj_fun = $obj_fun->find($obj_usu->funcionarios_id))
                    <div class="bs-example" style="overflow: hidden;" data-example-id="blockquote-reverse">
                        <textarea rows="3" class="form-control" id="informe">{{$obj_informe->informe_pac}}</textarea>
                        <blockquote class="blockquote-reverse">
                            <p>{{$obj_informe->informe_pac}}.</p>
                            <p>{{str_replace('\n', '<br>', $obj_informe->informe_pac)}}.</p>
                            <footer>{{ucwords(strtolower($obj_fun->nombres))}} {{ucwords(strtolower($obj_fun->apellido_pat))}} {{ucwords(strtolower($obj_fun->apellido_mat))}}
                                <cite title="Source Title">{{$obj_informe->created_at}}</cite>
                                <a href="{{ route('imprimirInforme',['InformePDF'=>'pdf',
                                             'pcp_id'=>  $obj_pcp->id,
                                             'inf_id'=>  $obj_informe->id,
                                             'esb_id'=>$esb_id,
                                             'epi_id'=>$epi_id]) }}" class="btn btn-xs btn-primary" style="margin-top:19px;margin-right: 30px;float: right;">Imprimir</a>
                            </footer>
                        </blockquote>
                    </div>
                @endforeach
            @else

            @endif

        </div>
    </div>
@stop
