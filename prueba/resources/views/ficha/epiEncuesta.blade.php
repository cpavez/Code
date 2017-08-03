@extends('fichaLayout.epiEncuesta')

@section('odontograma')
    <div class="col-md-12" style="padding-left: 0;padding-right: 0;">
        <div id="controls" class="panel panel-default" style="border: 0px !important; box-shadow: 0 0 0;">
            <div class="panel-body">
                <div class="btn-group" data-toggle="buttons" style="right: 10%; left: 10%;">
                    <label id="fractura" class="btn btn-danger active">
                        <input type="radio" name="options" id="option1" autocomplete="off" checked>Fractura</label>
                    <label id="restauracion" class="btn btn-primary" style="background-color: blue !important; border-color:blue !important;">
                        <input type="radio" name="options" id="option2" autocomplete="off"> Obturación
                    </label>
                    <label id="extraccion" class="btn btn-warning">
                        <input type="radio" name="options" id="option3" autocomplete="off"> Inexistente
                    </label>
                    <label id="extraer" class="btn btn-warning">
                        <input type="radio" name="options" id="option4" autocomplete="off"> A Extraer
                    </label>
                    <label id="puente" class="btn btn-primary">
                        <input type="radio" name="options" id="option5" autocomplete="off"> Puente
                    </label>
                    <!--<label id="borrar" class="btn btn-default">
                        <input type="radio" name="options" id="option6" autocomplete="off"> Borrar
                    </label>-->
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12" id="div_odontograma" style="padding-right: 0px;padding-left: 0px;">
        <div class="col-sm-12" style="padding-left: 0;padding-right: 0;">
            <div id="tr" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-left: 0;padding-right: 0;">
            </div>
            <div id="tl" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-left: 12px;padding-right: 0;">
            </div>
            <div id="tlr" class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
            </div>
            <div id="tll" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            </div>
        </div>
        <div class="col-sm-12" style="padding-left: 0;padding-right: 0;">
            <div id="blr" class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
            </div>
            <div id="bll" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            </div>
            <div id="br" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-left: 0;padding-right: 0;">
            </div>
            <div id="bl" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-left: 12px;padding-right: 0;">
            </div>
        </div>
    </div>


    <div id="listadoProcedimientos">

    </div>

    <div class="modal-footer">
        @if(count($arr_cod) > 0)
            <a href="{{ route('epiEncuesta',['PresupuestoPDF'=>'pdf',
                                                   'pcp_id'=>  $obj_pcp->id,
                                                   'esb_id'=>  $esb_id,
                                                   'epi_id'=>  $epi_id]) }}" class="btn btn-primary" style="margin-top:19px;margin-right: 30px;float: right;">Presupuesto PDF</a>
            <a href="#" id="guardar" style="margin-top:19px;margin-right: 30px;float: right;" class="btn btn-primary">Guardar</a>
        @else
            <a href="#" id="guardar" style="margin-top:19px;margin-right: 30px;float: right;" class="btn btn-primary">Guardar</a>
        @endif


    </div>

    <div id="content" class="hidden">
        <button type="button" class="close">&times;</button>
        <br>
        <div style="width: 350px;">
            <button class="btn btn-success addprocedimiento">Procedimiento</button>
            <button class="btn btn-primary addPieza">Agregar Cara</button>
        </div>
    </div>

    <div id="contentExtraer" class="hidden">
        <button type="button" class="close">&times;</button>
        <br>
        <div>
            <button class="btn btn-success addprocedimiento">Procedimiento</button>
        </div>
    </div>

    <div id="modAgregarProcedimiento" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Procedimiento</h4>
                    <input type="hidden" id="nombrePiesa" value="">
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-9">
                            <span>Procedimiento</span>
                            <input type="text" class="form-control" style="width: 600px;font-size: 16px;webkit-border-radius: 0px;border-radius: 0px;moz-border-radius: 0px; text-transform: uppercase;" id='prestacion' data-provide="typeahead">
                            <input type="hidden" id='pre_id'/>
                        </div>
                        <div class="col-xs-3">
                            <span>Cantidad</span>
                            <input type="text" class="form-control" id='cantidad'>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" id='agregarProcedimiento'>Agregar</button>
                </div>
            </div>
        </div>
    </div>

@stop

