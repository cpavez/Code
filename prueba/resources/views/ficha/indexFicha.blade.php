@extends('fichaLayout.layoutIndexFicha')

@section('menu')
    <div class="col-lg-2 contenedor" id="contenidoMenuEpisodio" style="left: 0 !important; top: 0px !important;">
        <ul class="nav nav-list menu_paciente" id='menu_paciente' style="right: 0;top: 0px; left: 0;">
            <li class="nav-header">
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="{{ asset('img/default-avatar.png') }}" style="width: 36px; height: 36px;">
                    </a>
                    <div class="media-body">
                        @php($nombres = explode(" ", $obj_pcp->nombres))
                        <h5 class="media-heading">{{ucwords(strtolower($nombres[0]))}} {{ucwords(strtolower($obj_pcp->apellido_pat))}}</h5>
                    </div>
                </div>
            </li>
            <li id='formPaciente'><a href="#"><span class="glyphicon glyphicon-user icon-left"></span>Datos Personales</a></li>
            <!--<li id='formCarga'><a href="#"><span class="glyphicon glyphicon-leaf icon-left"></span>Cargas Familiares</a></li>-->
            <!--<li id='formImagenes'><a href="#"><span class="glyphicon glyphicon-eye-open icon-left"></span>Examenes</a></li>-->
            <li class="nav-header">Clínico</li>
            <li id='formEpisodio'><a href="#"><span class="glyphicon glyphicon-barcode icon-left"></span>Tratamiento</a></li>
            <!--<li id='formSesiones'><a href="#"><span class="glyphicon glyphicon-calendar icon-left"></span>Sesiones</a></li>-->
            <li id='formFicha'><a href="#"><span class="glyphicon glyphicon-folder-close icon-left"></span>Ficha Clínica</a></li>
            <li id='formAlertas'><a href="#"><span class="glyphicon glyphicon-heart icon-left"></span>Antecedentes</a></li>
            <li id='formSesion'><a href="#"><span class="glyphicon glyphicon-calendar icon-left"></span>Agendar</a></li>
            <li class="nav-header">Facturación</li>
            <li id='formRecaudacion'><a href="#"><span class="glyphicon glyphicon-th icon-left"></span>Recaudación (Pagar)</a></li>
            <li id='formPagos'><a href="#"><span class="glyphicon glyphicon-usd icon-left"></span>Pagos Recibidos</a></li>
        </ul>
    </div>
@stop
