@extends('administracionLayout.admConvenios')

@section('convenios')

	
	@foreach($obj_con as $obj_con)
		<tr>
		    <td>{{$obj_con->descripcion}}</td>
		    <td>{{$obj_con->porcentaje}}</td>
		    <td>{{$obj_con->created_at}}</td>
		    <td>
		    	<button type="button" class="btn btn-danger eliminarConvenio" id='{{$obj_con->id}}' style="padding: 2px 6px;">
		    		<span class="glyphicon glyphicon-trash"></span>
		    	</button>
		    </td>
		</tr>
	@endforeach
@stop