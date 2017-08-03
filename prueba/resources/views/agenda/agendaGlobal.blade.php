@extends('agendaLayout.agendaGlobal')
@section('citas')
    <div style='position:absolute; left:0px;width:300px;bottom: 0;border-right:1px solid #414141;top:0;'>
        <form class="form-horizontal" style="color: #606060;">
            <label class="control-label col-xs-12" for="ocupacion">Nombres</label>
            <div class="col-xs-12">
                <input type="text" class="typeahead" style="width:270px;font-size: 16px;webkit-border-radius: 0px;border-radius: 0px;" id="paciente">
                <input type="hidden" id='pcp_id'/>
            </div>
            <label class="control-label col-xs-12" for="ocupacion">Rut</label>
            <div class="col-xs-12">
                <input type="text" class="form-control" id="rut" >
            </div>
            <div class="col-xs-12" style="margin-top:10px;  text-align: center;">
                <button type="button" id='buscar' class="btn btn-default">Buscar</button>
            </div>
        </form>
    </div>
@stop

