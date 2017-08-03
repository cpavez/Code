<div class="label-primary" style=" height: 35px;width: 100%;line-height: 35px;color: #fff;padding-left: 10px;">Prestaciones</div>
	<div style="position: absolute;top: 35px;bottom: 0;left: 0;right: 0;overflow-y: scroll;">
		<div class="row" style="margin:20px 10px;">
			<div class="col-xs-7">
				<span>Prestacion</span>
				<input type="text" class="form-control" id='prestacion' data-provide="typeahead">
			</div>
			<div class="col-xs-3">
				<span>Valor</span>
				<input type="text" class="form-control" id='valor' data-provide="typeahead">
			</div>
			<div class="col-xs-2">
				<span></span>
				<button type="button" class="btn btn-success" id='agregarPrestaciones' style="margin-top:19px;">Agregar</button>
			</div>
		</div>

		<div class="row" style="margin:30px 80px 15px 20px;">
			<div class="col-sm-12">
				<table class="table table-condensed">
					<thead>
					<tr>
						<th>Denominacion</th>
						<th>Valor</th>
						<th>Fecha</th>
						<th>Eliminar</th>
					</tr>
					</thead>
					<tbody>
					@yield('prestaciones')
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	$("#agregarPrestaciones").click(function(){
		var prestacion	= $("#prestacion").val();
		var valor		= $("#valor").val();
		var esb_id 		= $("#establecimiento").val();
		var usu_id 		= $("#session_usu_id").val();
        var $_token = $("#_token").val();
				
		$.ajax({
	            url:   '/admAgregarPrestaciones?prestacion='+prestacion+'&esb_id='+esb_id+'&usu_id='+usu_id+'&valor='+valor+'&_token='+$_token,
	            type:  'post',
	            success:  function (data) {
	            	console.log(data);
	            	$("#contenidoAdministracion").load('admPrestaciones?esb_id='+esb_id);
	         
	            }
	    });
	});
	
	$(".eliminarPrestaciones").click(function(){
		var id = this.id;
		var esb_id = $("#establecimiento").val();
		var usu_id = $("#session_usu_id").val();
        var $_token = $("#_token").val();
		$.ajax({
	            url:   '/admEliminarPrestaciones?pre_id='+id+'&usu_id='+usu_id+'&_token='+$_token,
	            type:  'post',
	            success:  function (data) {
	            	console.log(data);
	            	$("#contenidoAdministracion").load('admPrestaciones?esb_id='+esb_id);
	         
	            }
	    });
	});
</script>