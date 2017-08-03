@extends('administracionLayout.admSexo')

@section('sexo')

	
	@foreach($obj_sex as $obj_sex)
		<tr>
		    <td>{{$obj_sex->descripcion}}</td>
		    <td>{{$obj_sex->created_at}}</td>
		    <td>
		    	<button type="button" class="btn btn-danger eliminarSexo" id='{{$obj_sex->id}}' style="padding: 2px 6px;">
		    		<span class="glyphicon glyphicon-trash"></span>
		    	</button>
		    </td>
		</tr>
	@endforeach
@stop