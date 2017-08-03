@extends('buscarPacienteLayout.buscarPaciente')

@section('buscador')
    <form role="form" class="form-horizontal">
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label col-sm-4"> Rut :</label>
                <div class="col-sm-8">
                    <input type="text" id="rut"  class="form-control">
                    <input type="hidden" id="rut_simple">
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label col-sm-4"> Nombre :</label>
                <div class="col-sm-8">
                    <input type="text" id="nombre" placeholder="Nombres" class="form-control">
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label col-sm-4"> Apellido P. :</label>
                <div class="col-sm-8">
                    <input type="text" id="apellidoPaterno" placeholder="Apellido Paterno" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label col-sm-4"> Apellido M. :</label>
                <div class="col-sm-8">
                    <input type="text" id="apellidoMaterno" placeholder="Apellido Materno" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-offset-4">
            <div class="form-group">
                <div class="col-sm-12 text-center">
                    <button type="button" id="buscarPaciente" class="btn btn-primary display-block font-normal">
                        <span class="glyphicon glyphicon-search icon-left"></span> Buscar
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div class="col-sm-12" style="margin-top: 15px;">
        <div class="page-header" style="margin: 0px 0 0px; padding-bottom: 0px;">
            <h1 style="margin-top: 0px; font-size: 24px;">
                <small>Resultado Busqueda</small>
            </h1>
        </div>
        <table class="table table-hover" id="listaPacientes">

        </table>
    </div>
@stop

