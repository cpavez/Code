<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>SaludClink</title>

	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/base.css') }}" rel="stylesheet">

	<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" media="screen">
	<link href="{{ asset('css/bootstrap-datetimepicker.css') }}" rel="stylesheet" media="screen">
	<link href="{{ asset('css/sweet-alert.css') }}" rel="stylesheet" media="screen">
	<link href="{{ asset('css/normal.css') }}" rel="stylesheet" media="screen">
	<link href="{{ asset('css/fullcalendar.css') }}" rel="stylesheet" media="screen" />
	<link href="{{ asset('css/fullcalendar.print.css') }}" rel="stylesheet" media="print"/>
	<link href="{{ asset('css/examples.css') }}" rel="stylesheet" media="screen"/>
	<link href="{{ asset('css/jasny-bootstrap.min.css') }}" rel="stylesheet" media="screen"/>
	<link href="{{ asset('css/header.css') }}" rel="stylesheet" media="screen"/>

	<script type="text/javascript" src="{{asset('js/app.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/checkConsultores.js') }}"></script>

	<script type="text/javascript" src="{{asset('js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/moment.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap3-typeahead.min.js') }}"></script>

	<script type="text/javascript" src="{{asset('js/angular.min.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/datetimepickerDirective.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap-datetimepicker.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/locales/bootstrap-datetimepicker.es.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/sweet-alert.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/fullcalendar.min.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/lang/es.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/jquery.Rut.min.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/jquery.rut.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/socket.io.js') }}"></script>

	<script type="text/javascript" src="{{asset('js/html2canvas.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/jspdf.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/jspdf.plugin.addimage.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/FileSaver.min.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/jasny-bootstrap.min.js') }}"></script>

	<style>
		body{
			background-color: #ffffff;
		}
		.modal-backdrop {
			z-index: 0 !important;
			position: inherit;
		}
		#header-logo .logo-content-big,.logo-content-small{
			/**background:url({{asset('img/logo_admin_V4.png')}})left 50% no-repeat;**/
			position: absolute;
			left: 10px;
			top: 38%;
			margin-top: -17px;
		}
		.bg-gradient-9 {
			background: url({{asset('img/default-avatar.png') }});
			background: -moz-linear-gradient(-65deg,#008fe2 0,#00b29c 100%);
			background: -webkit-gradient(linear,left top,right bottom,color-stop(0%,#008fe2),color-stop(100%,#00b29c));
			background: -webkit-linear-gradient(-65deg,#008fe2 0,#00b29c 100%);
			background: -o-linear-gradient(-65deg,#008fe2 0,#00b29c 100%);
			background: -ms-linear-gradient(-65deg,#008fe2 0,#00b29c 100%);
			background: linear-gradient(154deg,#008fe2 0,#00b29c 100%);
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#008fe2', endColorstr='#00b29c', GradientType=1);
		}

		.bg-gradient-1, .bg-gradient-2, .bg-gradient-3, .bg-gradient-4, .bg-gradient-5, .bg-gradient-6, .bg-gradient-7, .bg-gradient-8, .bg-gradient-9 {
			background-color: transparent!important;
		}
		.btn, a, button, div[id^=uniform-] span {
			-webkit-transition: all .1s ease-in-out;
			-moz-transition: all .1s ease-in-out;
			-ms-transition: all .1s ease-in-out;
			-o-transition: all .1s ease-in-out;
		}
		.dropdown, .dropup {
			position: relative;
			display: inline-block;
		}
		:active, :focus, :visited, a, a:active, a:focus, a:visited {
			outline: 0;
		}
		.box-sm {
			width: 324px;
		}
		.dropdown-menu .divider {
			margin: 5px 1px;
		}
		.chosen-results, .form-wizard>ul, .nav-list ul, .nav-list-horizontal ul, .parsley-errors-list, .reset-ul, .tabs-navigation>ul, ul.messages-box, ul.notifications-box, ul.progress-box {
			margin: 0;
			padding: 0;
			list-style: none;
		}
		.mrg5B {
			margin-bottom: 5px!important;
		}
		.dropdown-menu li {
			position: relative;
		}
		.dropdown-menu li>a, .ui-menu li>a {
			font-weight: 400;
			line-height: 20px;
			position: relative;
			display: block;
			clear: both;
			margin: 0;
			padding: 5px 15px;
			cursor: pointer;
			white-space: nowrap;
		}
		body .button-pane.button-pane-alt {
			background: 0 0!important;
		}
		.ui-dialog-buttonpane, body .button-pane {
			padding: 10px;
			text-align: center;
			border-width: 1px 0 0;
			border-style: solid;
			border-top-left-radius: 0;
			border-top-right-radius: 0;
		}


		.container-fluid {
			padding-right: 0px;
			padding-left: 0px;
			margin-right: auto;
			margin-left: auto;
		}

		.panel-heading{
			/**background-color: #00bca4 !important;**/
			background-color: #60baec !important;
			/**border-color: #00bca4 !important;**/
			border-color: #60baec !important;
			color: #fff !important;
		}



		.dropdown-menu {
			font-size: 13px;
			line-height: 1.6em;
			padding: 5px 0;
			text-transform: none;
			border: 0;
			min-width: 150px;
		}

		.dropdown-menu, .popover, .ui-dialog {
			box-shadow: 0 1px 7px 2px rgba(135,158,171,.2) !important;
		}

		.dropdown-menu, .minicolors-panel, .popover, .ui-datepicker, .ui-dialog, .ui-menu {
			position: absolute;
			z-index: 1050!important;
			top: 105%;
			left: 0;
			display: none;
			float: left;
			min-width: 150px;
			margin: 5px 0 0;
			padding: 5px;
			list-style: none;
			text-align: left;
			border-width: 1px;
			border-style: solid;
			background: #fff;
		}

		.float-left, .pull-left {
			float: left!important;
		}


		#page-header .user-account-btn>a.user-profile .glyphicon, .logo-bg {
			background-color: rgba(255,255,255,.1);
			color: #fff;
		}
		#page-header .user-account-btn>a.user-profile .glyphicon {
			width: 28px;
			line-height: 28px;
			height: 28px;
			float: right;
			text-align: center;
			border-radius: 4px;
			font-size: 16px;
		}
		.login-box {
			padding: 10px 13px;
		}

		#loadingbar, #nav-toggle span:after, #nav-toggle span:before, #nav-toggle.collapsed span, .badge-primary, .bg-primary, .bootstrap-switch-primary, .btn-primary, .chosen-container .chosen-results li.active-result.highlighted, .daterangepicker .ranges li.active, .daterangepicker .ranges li.active:hover, .fc-event, .form-wizard>ul>li.active .wizard-step, .irs-line-left, .irs-line-mid, .irs-line-right, .label-primary, .ms-hover.ui-state-focus, .ms-list .ms-hover, .nav>li.active>a, .nav>li.active>a:focus, .nav>li.active>a:hover, .owl-controls .owl-page span, .ui-accordion-header.ui-accordion-header-active, .ui-datepicker .ui-datepicker-current-day a, .ui-datepicker .ui-datepicker-current-day span, .ui-datepicker .ui-datepicker-next, .ui-datepicker .ui-datepicker-prev, .ui-dialog-buttonset button, .ui-menu li>a:hover, .ui-rangeSlider-bar, .ui-slider-handle, .ui-spinner .ui-spinner-button:hover, .ui-tabs-nav li.ui-state-active.ui-state-hover>a, .ui-tabs-nav li.ui-state-active>a, a.list-group-item.active, a.list-group-item.active:focus, a.list-group-item.active:hover, div.switch-toggle.switch-on, div[id^=uniform-] span.checked, li.active a.list-group-item, li.active a.list-group-item:focus, li.active a.list-group-item:hover
		{
			color: #fff;
			background: #00bca4;
			border-color: #00bca4;
		}

		#menu_principal li.active >a {
			background-color: #fff !important;
			color: rgba(0, 0, 0, 0.43) !important;
		}

		#menu_principal li > a :hover{
			color: rgba(0, 0, 0, 0.43) !important;
		}
		#menu_principal li :hover{
			color: rgba(0, 0, 0, 0.43) !important;
		}


		#loading {
			position: fixed;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			z-index: 9999;
			background: url({{asset('img/loading.gif')}}) center no-repeat #fff;
		}

		.bg-gradient-9 {
			background: url(http://prueba.laravel/img/default-avatar.png);
			background: -moz-linear-gradient(-65deg,#008fe2 0,#008fe2 100%);
			background: -webkit-gradient(linear,left top,right bottom,color-stop(0%,#008fe2),color-stop(100%,#008fe2));
			background: -webkit-linear-gradient(-65deg,#008fe2 0,#008fe2 100%);
			background: -o-linear-gradient(-65deg,#008fe2 0,#008fe2 100%);
			background: -ms-linear-gradient(-65deg,#008fe2 0,#008fe2 100%);
			background: linear-gradient(154deg,#008fe2 0,#008fe2 100%);
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#008fe2', endColorstr='#008fe2', GradientType=1);
		}

		@media (max-width: 1024px){
			.table {
				font-size: 12px !important;
			}

			.tabla_epi_pagar thead tr th {
				font-size: 16px;
				font-weight: 200;
			}

			#listaPacientes{
				font-size: 12px !important;
			}
		}
	</style>
	<script>
        $(window).load(function(){
            loading(1);
            setTimeout(function() {
                loading(2);
            }, 300);
        });

	</script>
</head>
<body>
	<input type="hidden" id="_token" value="{{ csrf_token() }}" />
	<input type="hidden" id='session_usu_id' value="{{$obj_usu->id}}" />
	<input type="hidden" id='session_perfil_id' value="{{$perfilID}}" />
	<input type="hidden" id='session_especialidad_id' value="{{$especialidadID}}" />
	<input type="hidden" id='establecimiento' value="{{$obj_esb->id}}" />
	<input type="hidden" id='session_fun_id' value="{{$obj_fun_->id}}" />

	<div id="loading" style="display: block"></div>


	<!--inicio prueba cabecera-->
	<div id="page-header" class="bg-gradient-9">
		<div id="mobile-navigation">
			<button id="nav-toggle" class="collapsed" data-toggle="collapse" data-target="#page-sidebar"><span></span></button>
			<a href="#" class="logo-content-small" title="DentaClink"></a>
		</div>
		<div id="header-logo" class="logo-bg">
			<a href="#" class="logo-content-big" title="DentaClink">
				<img class="media-object" src="{{asset('img/logo_admin_V5-01.png')}}" style="width: 200px; height: 50px;">
			</a>
			<a href="#" class="logo-content-small" title="DentaClink">
				SaludClink
				<span>Dedicados a la Calidad</span>
			</a>
			<a id="close-sidebar" href="#" title="Close sidebar">
				<i class="glyph-icon icon-angle-left"></i>
			</a>
		</div>
		<div id="header-nav-left" >
			<div class="user-account-btn dropdown">
				<a href="#" title="Mi Cuenta" class="user-profile clearfix" data-toggle="dropdown" aria-expanded="false">
					<img width="28" src="{{asset('img/default-avatar.png')}}" alt="Perfil">
					<span>{{ucwords(strtolower($fun_nombre))}}</span>
					<span class="glyphicon glyphicon-chevron-down icon-left" style="padding-left: 7px;"></span>
				</a>
				<div class="dropdown-menu float-left">
					<div class="box-sm">
						<div class="login-box clearfix">
							<div class="user-img">
								<a href="#" title="" class="change-img">{{ucwords(strtolower($fun_nombre))}}</a>
								<img src="{{asset('img/default-avatar.png')}}" alt="">
							</div>
							<div class="user-info">
                            <span>
                                {{ucwords(strtolower($fun_nombre))}}
                                <i>{{ucwords(strtolower($especialidadDES))}}</i>
                            </span>
								<a href="#modEditarPerfil" title="Editar perfil" data-toggle="modal">Editar perfil</a>
								<a href="#" title="View notifications">Ver notificaciones</a>
							</div>
						</div>
						<div class="divider"></div>
						<ul class="reset-ul mrg5B">
							<li>
								<a href="#">
									<span class="glyphicon glyphicon-envelope icon-left"></span>
									Enviar Correo

								</a>
							</li>
						</ul>
						<div class="pad5A button-pane button-pane-alt text-center">
							<!--<a href="/" class="btn display-block font-normal btn-danger" style="width: 100%;">
								<span class="glyphicon glyphicon-off icon-left"></span>
								Salir
							</a>-->
							<a href="{{ url('/logout') }}" class="btn display-block font-normal btn-danger" style="width: 100%;"
							   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
								<span class="glyphicon glyphicon-off icon-left"></span>
								Salir
							</a>

							<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</div>
					</div>
				</div>
			</div>
		</div><!-- #header-nav-left -->

		<div id="header-nav-right">
			<ul id="menu_principal" class="nav navbar-nav bg-primary" style="background: rgba(255,255,255,.05);" >
				<li id="index" rel="indexFicha" class="header-btn active" style="background-color: #3BCCE8 !important;">
					<a href="#" data-toggle="tooltip" title="Paciente" data-placement="bottom" style="color: rgba(255,255,255,.8);background-color: #3BCCE8 !important;">
						<i class="glyphicon glyphicon-user icon-left"></i>
					</a>
				</li>
				<li id="agenda" rel="agenda" class="header-btn" style="background-color: #FFD651 !important;">
					<a href="#" data-toggle="tooltip" title="Agenda" data-placement="bottom"  style="color: rgba(255,255,255,.8);background-color: #FFD651 !important;">
						<span class="glyphicon glyphicon-calendar icon-left"></span>
					</a>
				</li>
				<li id="caja"  class="header-btn" style="background-color: #D87D68 !important;">
					<a href="#" data-toggle="tooltip" title="Caja" data-placement="bottom"  style="color: rgba(255,255,255,.8);background-color: #D87D68 !important;">
						<span class="glyphicon glyphicon-usd icon-left"></span>
					</a>
				</li>
				<li id="administracion"  class="header-btn" style="background-color: #F490DA !important;">
					<a href="#" data-toggle="tooltip" title="Administracion" data-placement="bottom"  style="color: rgba(255,255,255,.8);background-color: #F490DA !important;">
						<span class="glyphicon glyphicon-cog icon-left"></span>
					</a>
				</li>
				<li id="reportes" class="header-btn" style="background-color: #F4AB4C !important;">
					<a href="#" data-toggle="tooltip" title="Reportes" data-placement="bottom"  style="color: rgba(255,255,255,.8);background-color: #F4AB4C !important;">
						<span class="glyphicon glyphicon-stats icon-left"></span>
					</a>
				</li>
				<li class="header-btn" style="background-color: #DD6A7A !important;">
					<a href="{{ url('/logout') }}" data-placement="bottom"  style="color: rgba(255,255,255,.8); background-color: #DD6A7A !important;"
					   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
						<span class="glyphicon glyphicon-off icon-left"></span>
					</a>

					<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>

					<!--<a href="#" data-toggle="tooltip" title="Salir" data-placement="bottom"  style="color: rgba(255,255,255,.8);">
						<span class="glyphicon glyphicon-off icon-left"></span>
					</a>-->
				</li>
			</ul>
		</div><!-- #header-nav-right -->

	</div>

	<!--fin prueba cabecera -->

	<div class="container-fluid" id="modificadoPorAgenda" style="position: absolute;bottom: 5px;top: 80px;left: 0px;right: 0px;">
		<div class="container-fluid" id="contenedor">
			@yield('contenido')
		</div>
	</div>


	<div id="modEditarPerfil" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">Mi perfil</h4>
				</div>
				<div class="modal-body">
					<div class="label-primary" style="color: #fff; height: 35px;width: 100%;line-height: 35px;padding-left: 10px;">Profesional</div>
					<img class="media-object foto_paciente" style="width: 100px;height: 100px;right: 20px;top: 60px;" src="{{ asset('img/default-avatar.png') }}">

					<form class="form-horizontal" style="margin-top: 15px; padding-left:50px; color: #606060;">
						<div class="form-group">
							<label class="control-label col-xs-3" for="nombres">Nombres</label>
							<div class="col-xs-6">
								<input type="text" class="form-control" name='funNombres' id="funNombres" value="{{$obj_fun_->nombres}}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3" for="apellidoPaterno">Apellido Paterno</label>
							<div class="col-xs-6">
								<input type="text" class="form-control" name='funApellidoPaterno' id="funApellidoPaterno" value="{{$obj_fun_->apellido_pat}}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3" for="apellidoMaterno">Apellido Materno</label>
							<div class="col-xs-6">
								<input type="text" class="form-control" name='funApellidoMaterno' id="funApellidoMaterno" value='{{$obj_fun_->apellido_mat}}'>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3" for="direccion">Direccón</label>
							<div class="col-xs-6">
								<input type="text" class="form-control" name='funDireccion' id="funDireccion" value='{{$obj_fun_->direccion}}'>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3" for="email">Email</label>
							<div class="col-xs-6">
								<input type="email" class="form-control" id="funEmail" name='funEmail' value='{{$obj_fun_->correo}}'>
							</div>
						</div>
					</form>
					<div class="label-primary" style="color: #fff; height: 35px;width: 100%;line-height: 35px;padding-left: 10px;">Usuario</div>
					<form class="form-horizontal" style="margin-top: 15px; padding-left:50px; color: #606060;">
						<div class="form-group">
							<label class="control-label col-xs-3" for="Usuario">Usuario</label>
							<div class="col-xs-6">
								<input type="text" class="form-control" style="text-transform: lowercase;" name='usuUsuario' id="usuUsuario" value="{{$obj_usu->descripcion}}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3" for="Contraseña">Contraseña</label>
							<div class="col-xs-6">
								<input type="password" class="form-control" style="text-transform: lowercase;" name='usuClave' id="usuClave" value="{{$obj_usu->clave}}">
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" id='modificarPerfil' class="btn btn-success">Modificar</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		var URLsearch = window.location.search;

		if(URLsearch){
		    //revisar aca!!!
			//ver alternativa de saber si esta en session o no
			if(URLsearch.search('3d27c2e24377377bdd907962a53e13eb') != -1){
				$("#menu_principal > li").removeClass("active");
				$("#index").addClass("active");
				$("#contenedor").load('indexFicha'+URLsearch);
			}else{
				//$("#menu_principal > li").removeClass("active");
				//$("#"+URLsearch).addClass("active");
				var url = (window.location.pathname).replace('/', '');
				//alert(url);
				$("#menu_principal > li").removeClass("active");
				$("#"+url).addClass("active");
			}

		}else{
			var url = (window.location.pathname).replace('/', '');
			//alert(url);
			$("#menu_principal > li").removeClass("active");
			$("#"+url).addClass("active");
		}

		$("#modificarPerfil").on('click',function(){
		   var nombres = $("#funNombres").val();
		   var apellidoPat = $("#funApellidoPaterno").val();
		   var apellidoMat = $("#funApellidoMaterno").val();
		   var direccion = $("#funDireccion").val();
		   var mail = $("#funEmail").val();
		   var usuario = $("#usuUsuario").val();
		   var clave = $("#usuClave").val();
		   var fun_id = $("#session_fun_id").val();
		   var $_token = $("#_token").val();
		   var usu_id = $("#session_usu_id").val();

		   if(usuario != '' && clave != ''){
			   $.ajax({
				   url:   'modificarPerfil',
				   data: { nombre:nombres ,
						   apellidoPat:apellidoPat ,
						   apellidoMat:apellidoMat,
						   mail:mail,
						   direccion:direccion,
						   usuario:usuario,
						   clave:clave,
						   fun_id:fun_id,
						   usu_id:usu_id,
						   _token:$_token},
				   type:  'post',
				   success:  function (data) {
					   swal("Modificado!", "Se acaba de modificar correctamente", "success");
				   }
			   });
		   }else{
			   swal("Ups! hay un error!",'Debe dejar usuario y contraseña', "error");
		   }
		});

		$("#menu_principal > li").click(function(){
			if(this.id){
				if(this.id == '/'){
					window.location.href = '/';
				}else{
					$("#menu_principal > li").removeClass("active");
					$(this).addClass("active");
					var URLsearch = window.location.search;

					if(!URLsearch){
						window.location.href = this.id;
					}else{
						var usu_id = $("#session_usu_id").val();
						var esb_id = $("#establecimiento").val();
						//var url_ini = '?esb_id='+esb_id+'&usu_id='+usu_id;
						var url_ini = '';
						window.location.href = this.id+url_ini;
					}
				}

			}

		});

		$(document).ready(function(){
			//$('[data-toggle="tooltip"]').tooltip();
			$('.user-profile').click(function() {
				$('.dropdown').toggleClass('open');
			});
			$(document).ajaxStart(function(){
				$("#loading").css("display", "block");
			});
			$(document).ajaxComplete(function(){
				$("#loading").css("display", "none");
			});
		});



		$(".dropdown-menu li a").click(function(){
			var selText = $(this).text();
			var selId	  = this.id;
			$(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret" id="'+selId+'"></span>');
		});

		function loading(variable){
			console.log(variable);
			if(variable == 1){
				setTimeout(function() {
					$("#loading").fadeIn( 400, "linear" );
				}, 300);

				/*setTimeout(function() {
					$('#loading').show();
				}, 300);*/
			}else if(variable == 2){
				//$('#loading').hide();
				$("#loading").fadeOut( 400, "linear" );
			}else{
				setTimeout(function() {
					$('#loading').fadeOut( 400, "linear" );
				}, 300);
			}

		}


	</script>
</body>
</html>