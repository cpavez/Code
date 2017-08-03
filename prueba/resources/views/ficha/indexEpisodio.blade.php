@extends('fichaLayout.indexEpisodio')

@section('menu')
    <ul class="nav nav-tabs" id='menu_episodio' style="margin-top:0px;">
        @foreach($arrMenu as $menus)
            @php($obj_menu = $obj_menu->find($menus->menu_secundario_id))
            <li id='{{$obj_menu->id_mostrar}}'><a href="#"><span class="{{$obj_menu->class}}"></span>{{$obj_menu->descripcion}}</a></li>
        @endforeach
    </ul>
@stop

