@extends('administracionLayout.admPrestaciones')

@section('prestaciones')

	
	@foreach($obj_pre as $obj_pre)
		<tr>
		    <td>{{$obj_pre->descripcion}}</td>
		    <td>{{$obj_pre->valor}}</td>
		    <td>{{$obj_pre->created_at}}</td>
		    <td>
		    	<button type="button" class="btn btn-danger eliminarPrestaciones" id='{{$obj_pre->id}}' style="padding: 2px 6px;">
		    		<span class="glyphicon glyphicon-trash"></span>
		    	</button>
		    </td>
		</tr>
	@endforeach
@stop