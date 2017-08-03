@extends('reporteLayout.reportes')

@section('menu')
	<div class="col-lg-2 contenedor" id="contenidoMenuEpisodio" style="left: 0 !important; top: 0px !important;">
	  	<ul class="nav nav-list menu_paciente" id='menu_reportes' style="right: 0;top: 0px; left: 0;">
	        <li class="nav-header">Paciente</li>
	        <li id='admPaciente'><a href="#"><span class="glyphicon glyphicon-user icon-left"></span>Nuevos</a></li>
	        <li id='admPaciente'><a href="#"><span class="glyphicon glyphicon-usd icon-left"></span>Pagos</a></li>
	    </ul>
	</div>
@stop