@extends('administracionLayout.admTipoExamenes')

@section('tipoExamenes')

	
	@foreach($obj_tpe as $obj_tpe)
		<tr>
		    <td>{{$obj_tpe->descripcion}}</td>
		    <td>{{$obj_tpe->created_at}}</td>
		    <td>
		    	<button type="button" class="btn btn-danger eliminarTipoExamenes" id='{{$obj_tpe->id}}' style="padding: 2px 6px;">
		    		<span class="glyphicon glyphicon-trash"></span>
		    	</button>
		    </td>
		</tr>
	@endforeach
@stop