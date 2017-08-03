@extends('administracionLayout.admDescuentos')

@section('descuentos')

	
	@foreach($obj_des as $obj_des)
		<tr>
		    <td>{{$obj_des->descripcion}}</td>
		    <td>{{$obj_des->created_at}}</td>
		    <td>
		    	<button type="button" class="btn btn-danger eliminarDescuentos" id='{{$obj_des->id}}' style="padding: 2px 6px;">
		    		<span class="glyphicon glyphicon-trash"></span>
		    	</button>
		    </td>
		</tr>
	@endforeach
@stop