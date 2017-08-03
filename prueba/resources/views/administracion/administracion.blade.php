@extends('administracionLayout.administracion')

@section('menu')
	<div class="col-lg-2 contenedor" id="contenidoMenuEpisodio" style="left: 0 !important; top: 0px !important;">
	  	<ul class="nav nav-list menu_paciente" id='menu_administracion' style="right: 0;top: 0px; left: 0;">
	        <li class="nav-header">Paciente</li>
	        <!--<li id='admPaciente'><a href="#"><span class="glyphicon glyphicon-user icon-left"></span>Paciente</a></li>-->
	        <li id='admConvenios'><a href="#"><span class="glyphicon glyphicon-list-alt icon-left"></span>Convenios</a></li>  
	        <!--<li id='admSexo'><a href="#"><span class="glyphicon glyphicon-user icon-left"></span>Genero</a></li>-->
	        <li class="nav-header">Clínico</li>
	        <li id='admPrestaciones'><a href="#"><span class="glyphicon glyphicon-folder-open icon-left"></span>Prestaciones</a></li>  
	        <li id='admTipoExamenes'><a href="#"><span class="glyphicon glyphicon-paste icon-left"></span>Tipo Examenes</a></li>  
	        <!--<li id='admEstadoAtencion'><a href="#"><span class="glyphicon glyphicon-send icon-left"></span>Estado Atencion</a></li>-->
	        <li class="nav-header">Caja</li>  
	        <li id='admDescuentos'><a href="#"><span class="glyphicon glyphicon-equalizer icon-left"></span>Descuentos</a></li>  
	        <li id='admBancos'><a href="#"><span class="glyphicon glyphicon-usd icon-left"></span>Bancos</a></li> 
		</ul>
	</div>
@stop