@extends('fichaLayout.epiAnamnesisKine')

@section('eva')
    <form class="form-horizontal" style="width: 700px; padding-top:30px; padding-left:50px; color: #606060;">
        <input type="hidden" id="episodioEvaluda" value="{{$episidioID}}">
        <input type="hidden" id="evaSeleccionadoEstatico" value="{{$evaEstatico}}">
        <input type="hidden" id="evaSeleccionadoDinamico" value="{{$evaDinamico}}">
        <div class="page-header" style="margin: 25px 0 20px;">
            <h2>Motivo Consulta</h2>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-3" for="motivoConsulta">Motivo Consulta</label>
            <div class="col-xs-9">
                <textarea class="form-control" rows="3" id="motivoConsulta" name="motivoConsulta">{{$motivoConsulta}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-3" for="eva">EVA Estatico</label>
            <div class="col-xs-1" style="padding-right: 0px;">
                <select class="form-control" name="evaEstatico" id="evaEstatico">
                    <option value="0">0</option>
                    <option value="10">1</option>
                    <option value="20">2</option>
                    <option value="30">3</option>
                    <option value="40">4</option>
                    <option value="50">5</option>
                    <option value="60">6</option>
                    <option value="70">7</option>
                    <option value="80">8</option>
                    <option value="90">9</option>
                    <option value="100">10</option>
                </select>
            </div>
            <div class="col-xs-8" style="padding-left: 0px;">
                <div class="progress" id="slider">
                    <div class="progress-bar" id="id_progreso_eva_estatico" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$evaEstatico}}%;" ></div>
                </div>
                <div>
                    <img src="{{ asset('img/eva.png') }}" style="width:400px;" alt="eva" id="evaimg">&nbsp;
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-3" for="eva">EVA Dinamico</label>
            <div class="col-xs-1" style="padding-right: 0px;">
                <select class="form-control" name="evaDinamico" id="evaDinamico">
                    <option value="0">0</option>
                    <option value="10">1</option>
                    <option value="20">2</option>
                    <option value="30">3</option>
                    <option value="40">4</option>
                    <option value="50">5</option>
                    <option value="60">6</option>
                    <option value="70">7</option>
                    <option value="80">8</option>
                    <option value="90">9</option>
                    <option value="100">10</option>
                </select>
            </div>
            <div class="col-xs-8" style="padding-left: 0px;">
                <div class="progress" id="slider">
                    <div class="progress-bar" id="id_progreso_eva_dinamico" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$evaDinamico}}%;" ></div>
                </div>
                <div>
                    <img src="{{ asset('img/eva.png') }}" style="width:400px;" alt="eva" id="evaimg">&nbsp;
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-3" for="frecuencia">Frecuencia</label>
            <div class="col-xs-9">
                <textarea class="form-control" rows="3" id="frecuencia" name="frecuencia">{{$frecuencia}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-3" for="zona">Zona</label>
            <div class="col-xs-9">
                <textarea class="form-control" rows="3" id="zona" name="zona">{{$zona}}</textarea>
            </div>
        </div>

        <div class="page-header" style="margin: 25px 0 20px;">
            <h2>Anamnesis</h2>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-3" for="zona">Anamnesis Actual</label>
            <div class="col-xs-9">
                <textarea class="form-control" rows="3" id="anamnesisActual" name="anamnesisActual">{{$anamnesisActual}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-3" for="zona">Anamnesis Remota</label>
            <div class="col-xs-9">
                <textarea class="form-control" rows="3" id="anamnesisRemota" name="anamnesisRemota">{{$anamnesisRemota}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-3" for="zona">Examenes</label>
            <div class="col-xs-9">
                <textarea class="form-control" rows="3" id="examenes" name="examenes">{{$examenes}}</textarea>
            </div>
        </div>

        <div class="page-header" style="margin: 25px 0 20px;">
            <h2>Examen Fisico</h2>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-3" for="inspeccion">Inspeccion</label>
            <div class="col-xs-9">
                <textarea class="form-control" rows="3" id="inspeccion" name="inspeccion">{{$inspeccion}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-3" for="palpacion">Palpacion</label>
            <div class="col-xs-9">
                <textarea class="form-control" rows="3" id="palpacion" name="palpacion">{{$palpacion}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-3" for="sensibilidad">Sensibilidad</label>
            <div class="col-xs-9">
                <textarea class="form-control" rows="3" id="sensibilidad" name="sensibilidad">{{$sensibilidad}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-3" for="movilizacion">Movilizacion</label>
            <div class="col-xs-9">
                <textarea class="form-control" rows="3" id="movilizacion" name="movilizacion">{{$movilizacion}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-3" for="fuerzaMuscular">Fuerza Muscular</label>
            <div class="col-xs-9">
                <table id="tableFuerzaMuscular" class="table">
                    <thead>
                    <tr>
                        <th>Extremidad</th>
                        <th>Derecha</th>
                        <th>Izquierda</th>
                        <th><button type="button" href="#modAgregarFuerzaMuscular" data-toggle="modal" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus"></span></button></th>
                    </tr>
                    </thead>
                    <tbody>
                        @if($arrFuerzaMotora)
                            @foreach($arrFuerzaMotora as $fm)
                                <tr>
                                    <td>{{$fm->extremidad}}</td>
                                    <td>{{$fm->derecha}}</td>
                                    <td>{{$fm->izquierda}}</td>
                                    <td>-</td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-3" for="perimetros">Perimetros</label>
            <div class="col-xs-9">
                <table id="tablePerimetro" class="table">
                    <thead>
                    <tr>
                        <th>Extremidad</th>
                        <th>Derecha</th>
                        <th>Izquierda</th>
                        <th><button type="button" href="#modAgregarPerimetro" data-toggle="modal" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus"></span></button></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($arrPerimetro)
                        @foreach($arrPerimetro as $pr)
                            <tr>
                                <td>{{$pr->extremidad}}</td>
                                <td>{{$pr->derecha}}</td>
                                <td>{{$pr->izquierda}}</td>
                                <td>-</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-3" for="angulo">Angulo Q</label>
            <div class="col-xs-9">
                <table id="tableAngulo" class="table">
                    <thead>
                        <tr>
                            <th>Extremidad</th>
                            <th>Derecha</th>
                            <th>Izquierda</th>
                            <th><button type="button" href="#modAgregarAngulo" data-toggle="modal" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus"></span></button></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($arrAngulo)
                        @foreach($arrAngulo as $an)
                            <tr>
                                <td>{{$an->extremidad}}</td>
                                <td>{{$an->derecha}}</td>
                                <td>{{$an->izquierda}}</td>
                                <td>-</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>


        <div class="page-header" style="margin: 25px 0 20px;">
            <h2>Goniometria</h2>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-3" for="goniometria">Goniometria</label>
            <div class="col-xs-9">
                <table id="tableGoniometria" class="table">
                    <thead>
                    <tr>
                        <th>Articulacion</th>
                        <th>Movimiento</th>
                        <th>Derecha</th>
                        <th>Izquierda</th>
                        <th><button type="button" href="#modAgregarGoniometria" data-toggle="modal" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus"></span></button></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($arrGoniometria)
                        @foreach($arrGoniometria as $go)
                            <tr>
                                <td>{{$go->articulacion}}</td>
                                <td>{{$go->movimiento}}</td>
                                <td>{{$go->derecha}}</td>
                                <td>{{$go->izquierda}}</td>
                                <td>-</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </form>


@stop

@section('zona')
    <div class="page-header" style="margin: 25px 0 20px;">
        <h2>Zona del Dolor</h2>
    </div>
    <div class="col-xs-12">
        <div id="lienzo" style="background:url({{asset('img/male.jpg')}});width:700px;height:436px;cursor: cell;">
            @if($episidioID != '')
                <img src="{{asset('img/cuerpo/'.$episidioID.'_'.$anamID.'.png')}}">
            @endif
        </div>
    </div>

@stop

@section('modalAgregarDescuento')
    <div id="modAgregarGoniometria" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Goniometria</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-xs-3" for="modGoniometriaArticulacion">Articulacion</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" id="modGoniometriaArticulacion">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-3" for="modGoniometriaMovimiento">Movimiento</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" id="modGoniometriaMovimiento">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-3" for="modGoniometriaDerecha">Derecha</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" id="modGoniometriaDerecha">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-3" for="modGoniometriaIzquierda">Izquierda</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" id="modGoniometriaIzquierda">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id='agregarGoniometria'>Guardar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('modalAgregarAngulo')
    <div id="modAgregarAngulo" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Angulo Q</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-xs-3" for="modAnguloExtremidad">Extremidad</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" id="modAnguloExtremidad">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-3" for="modAnguloDerecha">Derecha</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" id="modAnguloDerecha">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-3" for="modAnguloIzquierda">Izquierda</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" id="modAnguloIzquierda">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id='agregarAngulo'>Guardar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('modalAgregarPerimetro')
    <div id="modAgregarPerimetro" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Perimetro</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-xs-3" for="modPerimetroExtremidad">Extremidad</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" id="modPerimetroExtremidad">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-3" for="modPerimetroDerecha">Derecha</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" id="modPerimetroDerecha">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-3" for="modPerimetroIzquierda">Izquierda</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" id="modPerimetroIzquierda">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id='agregarPerimetro'>Guardar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('modalAgregarFuerzaMuscular')
    <div id="modAgregarFuerzaMuscular" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Fuerza Muscular</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-xs-3" for="modFuerzaMuscularExtremidad">Extremidad</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" id="modFuerzaMuscularExtremidad">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-3" for="modFuerzaMuscularDerecha">Derecha</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" id="modFuerzaMuscularDerecha">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-3" for="modFuerzaMuscularIzquierda">Izquierda</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" id="modFuerzaMuscularIzquierda">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id='agregarFuerzaMuscular'>Guardar</button>
                </div>
            </div>
        </div>
    </div>
@stop