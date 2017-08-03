@extends('fichaLayout.formFicha')

@section('listaTratamientos')
    <div class="col-lg-3 contenedor popup-box chat-popup" id="qnimate" style="left: 0; top: 35px;">
        <div style="margin-top: 0px;border: 1px solid #D6D6D6;position: absolute;right: 0;left: 0;top: 0;bottom: 0; left: 0 !important;  overflow-y: scroll; background-color: #ffffff;">
            <div class="popup-messages">
                <div class="direct-chat-messages">
                    <!-- Message. Default to the left -->
                    <div class="direct-chat-msg doted-border">
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-left">&nbsp;</span>
                        </div>
                        @foreach($arr_epi as $obj_epi)
                            <img id="{{$obj_epi->id}}" alt="iamgurdeeposahan" src="{{ asset('img/default-avatar.png') }}" class="direct-chat-img"><!-- /.direct-chat-img -->
                            <span class="direct-chat-reply-name">Atencion {{$obj_epi->descripcion}}</span>
                            <span class="direct-chat-reply-name">{{ucwords(strtolower($obj_epi->tipo_tratamiento))}}</span>
                            <span class="direct-chat-timestamp pull-right">{{$obj_epi->created_at}}</span>
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-timestamp pull-right">&nbsp;</span>
                            </div>
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-timestamp pull-right">&nbsp;</span>
                            </div>
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-timestamp pull-right">&nbsp;</span>
                            </div>
                        @endforeach
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-img-reply-small pull-left"></span>
                            <span class="direct-chat-reply-name">&nbsp;</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop