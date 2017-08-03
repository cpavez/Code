@extends('administracionLayout.admEstadoAtencion')

@section('estadoAtencion')

	
	@foreach($obj_est as $obj_est)
		<tr>
		    <td>{{$obj_est->descripcion}}</td>
		    <td>{{$obj_est->created_at}}</td>
		    <td>
		    	<button type="button" class="btn btn-danger eliminarEstadoAtencion" id='{{$obj_est->id}}' style="padding: 2px 6px;">
		    		<span class="glyphicon glyphicon-trash"></span>
		    	</button>
		    </td>
		</tr>
	@endforeach
@stop