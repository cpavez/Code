@extends('fichaLayout.epiFotos')

@section('foto')

    <div class="col-sm-12" style="margin-bottom: 30px;">
        <select class="form-control select" id="videoSource" style="width: 40%;"></select>
        <div class="btn-group-wrap">

            <div class="btn-group" style="    right: 0%;">
                <button type="button" id='botonIniciar' class="btn btn-default">Iniciar</button>
                <button type="button" id='botonDetener' class="btn btn-default">Detener</button>
                <button type="button" id='botonFoto' class="btn btn-default">Tomar Foto</button>
                <button type="button" id='guardarFoto' class="btn btn-default">Guardar Foto</button>
            </div>
        </div>


    </div>

    <div class="col-sm-6">
        <div class="titulo">Cámara</div>
        <video id="camara" autoplay controls width="100%" height="auto"></video>
    </div>

    <div class="col-sm-6">
        <div class="titulo">Foto</div>
        <canvas id="foto" width="100%" height="auto"></canvas>
    </div>
@stop

@section('listaFotos')
    @if(count($arr_fotos) > 0)
        @foreach($arr_fotos as $fotos)
            @php($ruta = $fotos->ruta.'.png')

            <a href="#" data-toggle="modal" data-target=".{{$fotos->ruta}}">
                <img src="{{ asset('img/personas/'.$ruta.'') }}" class="img-thumbnail" style="width: 100px; height: 77px;" class="img-responsive img-rounded center-block">
            </a>

            <!--  Modal content for the lion image example -->
            <div class="modal fade {{$fotos->ruta}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-2" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myLargeModalLabel-2">{{$fotos->episodio_id}}-{{$fotos->id}}</h4>
                        </div>
                        <div class="modal-body">
                            <img src="{{ asset('img/personas/'.$ruta.'') }}" class="img-responsive img-rounded center-block" alt="">
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal mixer image -->

        @endforeach
    @endif
@stop