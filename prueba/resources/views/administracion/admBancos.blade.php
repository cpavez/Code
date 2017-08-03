@extends('administracionLayout.admBancos')

@section('bancos')

	
	@foreach($obj_ban as $obj_ban)
		<tr>
		    <td>{{$obj_ban->descripcion}}</td>
		    <td>{{$obj_ban->created_at}}</td>
		    <td>
		    	<button type="button" class="btn btn-danger eliminarBancos" id='{{$obj_ban->id}}' style="padding: 2px 6px;">
		    		<span class="glyphicon glyphicon-trash"></span>
		    	</button>
		    </td>
		</tr>
	@endforeach
@stop