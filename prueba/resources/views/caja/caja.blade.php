@extends('cajaLayout.caja')

@section('menu')
    <div class="col-lg-2 contenedor" id="contenidoMenuEpisodio" style="left: 0 !important; top: 0px !important;">
        <ul class="nav nav-list menu_paciente" id='menu_reportes' style="right: 0;top: 0px; left: 0;">
            <li class="nav-header">Ingresos</li>
            <li id='ingreso'><a href="#"><span class="glyphicon glyphicon-arrow-down icon-left"></span>Ingresar Abono</a></li>
            <li id='repIngresos'><a href="#"><span class="glyphicon glyphicon-arrow-down icon-left"></span>Reporte Abonos</a></li>
            <li class="nav-header">Devoluciones</li>
            <li id='devolucion'><a href="#"><span class="glyphicon glyphicon-arrow-up icon-left"></span>Ingresar Devolución</a></li>
            <li id='repDevoluciones'><a href="#"><span class="glyphicon glyphicon-arrow-up icon-left"></span>Reporte Devoluciones</a></li>
            <li class="nav-header">Recaudación</li>
            <li id='repChequesPorCobrar'><a href="#"><span class="glyphicon glyphicon-credit-card icon-left"></span>Cheques por cobrar</a></li>
            <li id='repBonosPorCobrar'><a href="#"><span class="glyphicon glyphicon-credit-card icon-left"></span>Bonos por cobrar</a></li>
        </ul>
    </div>
@stop