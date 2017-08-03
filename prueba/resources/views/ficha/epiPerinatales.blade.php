@extends('fichaLayout.epiPerinatales')

@section('eva')
    <div class="page-header" style="margin: 20px 0 20px;">
        <h2>Antecedentes Perinatales</h2>
    </div>
    <div class="form-horizontal">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="patologiaEmbarazo" class="col-sm-4 control-label">Patología Embarazo:</label>
                <div class="col-sm-8">
                    <select class="form-control" id="patologiaEmbarazo" name="patologiaEmbarazo">
                        @foreach($arr_pat as $patologia)
                        <option value="{{$patologia->id}}">{{$patologia->descripcion}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="edad" class="col-sm-4 control-label">Edad Gestacional (semanas):</label>
                <div class="col-sm-8">
                    <input name="edad" id="edad" class="form-control" type="text" value="{{$edad}}">
                </div>
            </div>
            <div class="form-group">
                <label for="talla" class="col-sm-4 control-label">Talla (cm):</label>
                <div class="col-sm-8">
                    <input name="talla" id="talla" class="form-control" type="text" value="{{$talla}}">
                </div>
            </div>
            <div class="form-group">
                <label for="apgar" class="col-sm-4 control-label">APGAR (minuto):</label>
                <div class="col-sm-4">
                    <label for="primer" class="col-sm-3 control-label">1º</label>
                    <input name="primer" style="width: 75%;" id="primer" class="col-sm-9 form-control" value="{{$primer}}" type="text">
                </div>
                <div class="col-sm-4">
                    <label for="quinto" class="col-sm-3 control-label">5º</label>
                    <input name="quinto" style="width: 75%;" id="quinto" class="col-sm-9 form-control" value="{{$quinto}}" type="text">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="peso" class="col-sm-4 control-label">Peso al Nacer (kg):</label>
                <div class="col-sm-8">
                    <input name="peso" id="peso" class="form-control" type="text" value="{{$peso}}">
                </div>
            </div>
            <div class="form-group">
                <label for="perimetro" class="col-sm-4 control-label">Perimetro Cefalico (cm):</label>
                <div class="col-sm-8">
                    <input name="perimetro" id="perimetro" class="form-control" type="text" value="{{$perimetro}}">
                </div>
            </div>
            <div class="form-group">
                <label for="deprimido" class="col-sm-4 control-label">Deprimido:</label>
                <div class="col-sm-8">
                    <select class="form-control" id="deprimido" name="deprimido">
                        @if($deprimido == 1)
                            <option value="1" select>SI</option>
                            <option value="0">NO</option>
                        @else
                            <option value="0" select>NO</option>
                            <option value="1">SI</option>
                        @endif


                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="reanimacion" class="col-sm-4 control-label">Reanimación:</label>
                <div class="col-sm-8">
                    <select class="form-control" id="reanimacion" name="reanimacion">
                        @if($reanimacion == 1)
                            <option value="0">NO</option>
                            <option value="1" selected>SI</option>
                        @else
                            <option value="0" selected>NO</option>
                            <option value="1">SI</option>
                        @endif

                    </select>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="page-header">
        <h2>Patologias al Nacer</h2>
    </div>

    <div class="form-horizontal">
        <div class="col-sm-12">
            <form class="form-horizontal">
                <div class="col-xs-4">
                    <div class="form-group">
                        <label class="control-label col-xs-7 col-sm-8" for="patologiaRespiratoria">Patología Respiratoria</label>
                        <div class="col-xs-5 col-sm-4">
                            <select class="form-control" id="patologiaRespiratoria">
                                @if($patologiaRespiratoria == 1)
                                    <option value="0">NO</option>
                                    <option value="1" selected>SI</option>
                                @else
                                    <option value="0" selected>NO</option>
                                    <option value="1">SI</option>
                                @endif

                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label class="control-label col-xs-7 col-sm-8" for="hiv">HIV</label>
                        <div class="col-xs-5 col-sm-4">
                            <select class="form-control" id="hiv">
                                @if($hiv == 1)
                                    <option value="0">NO</option>
                                    <option value="1" selected>SI</option>
                                @else
                                    <option value="0" selected>NO</option>
                                    <option value="1">SI</option>
                                @endif

                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label class="control-label col-xs-7 col-sm-8" for="malformaciones">Malformaciones</label>
                        <div class="col-xs-5 col-sm-4">
                            <select class="form-control" id="malformaciones">
                                @if($malformaciones == 1)
                                    <option value="0">NO</option>
                                    <option value="1" selected>SI</option>
                                @else
                                    <option value="0" selected>NO</option>
                                    <option value="1">SI</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="form-group">
                        <label class="control-label col-xs-7 col-sm-8" for="ingeccionCongenica">Infección Congénica</label>
                        <div class="col-xs-5 col-sm-4">
                            <select class="form-control" id="ingeccionCongenica">
                                @if($ingeccionCongenica == 1)
                                    <option value="0">NO</option>
                                    <option value="1" selected>SI</option>
                                @else
                                    <option value="0" selected>NO</option>
                                    <option value="1">SI</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label class="control-label col-xs-7 col-sm-8" for="infeccionAdquirida">Infección Adquiruda</label>
                        <div class="col-xs-5 col-sm-4">
                            <select class="form-control" id="infeccionAdquirida">
                                @if($infeccionAdquirida == 1)
                                    <option value="0">NO</option>
                                    <option value="1" selected>SI</option>
                                @else
                                    <option value="0" selected>NO</option>
                                    <option value="1">SI</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label class="control-label col-xs-7 col-sm-8" for="ictericia">Ictericia</label>
                        <div class="col-xs-5 col-sm-4">
                            <select class="form-control" id="ictericia">
                                @if($ictericia == 1)
                                    <option value="0">NO</option>
                                    <option value="1" selected>SI</option>
                                @else
                                    <option value="0" selected>NO</option>
                                    <option value="1">SI</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label class="control-label col-xs-7 col-sm-8" for="problemasNeurologicos">Problemas Neurológicos</label>
                        <div class="col-xs-5 col-sm-4">
                            <select class="form-control" id="problemasNeurologicos">
                                @if($problemasNeurologicos == 1)
                                    <option value="0">NO</option>
                                    <option value="1" selected>SI</option>
                                @else
                                    <option value="0" selected>NO</option>
                                    <option value="1">SI</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@stop

