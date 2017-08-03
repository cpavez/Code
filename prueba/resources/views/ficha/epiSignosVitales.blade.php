@extends('fichaLayout.epiSignosVitales')

@section('agregar_sv')
    <div class="row" style="margin-top:20px;">
        <div class="col-sm-12">
            <form class="form-horizontal">
                <div class="col-xs-4">
                    <div class="form-group">
                        <label class="control-label col-xs-7 col-sm-8" for="presionArterial">Presion Arterial</label>
                        <div class="col-xs-5 col-sm-4">
                            <input type="text" class="form-control" data-mask="999-999" id="presionArterial" name="presionArterial">
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label class="control-label col-xs-7 col-sm-8" for="frecuenciaRespiratoria">Frecuencia Respiratoria</label>
                        <div class="col-xs-5 col-sm-4">
                            <input type="number" class="form-control" id="frecuenciaRespiratoria" name="frecuenciaRespiratoria">
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label class="control-label col-xs-7 col-sm-8" for="frecuenciaCardiaca">Frecuencia Cardiaca</label>
                        <div class="col-xs-5 col-sm-4">
                            <input type="number" class="form-control" id="frecuenciaCardiaca" name="frecuenciaCardiaca">
                        </div>
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="form-group">
                        <label class="control-label col-xs-7 col-sm-8" for="temperaturaBocal">Temperatura</label>
                        <div class="col-xs-5 col-sm-4">
                            <input type="number" class="form-control" id="temperaturaBocal" name="temperaturaBocal">
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label class="control-label col-xs-7 col-sm-8" for="talla">Talla</label>
                        <div class="col-xs-5 col-sm-4">
                            <input type="number" class="form-control" id="talla" name="talla">
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label class="control-label col-xs-7 col-sm-8" for="peso">Peso</label>
                        <div class="col-xs-5 col-sm-4">
                            <input type="number" class="form-control" id="peso" name="peso">
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label class="control-label col-xs-7 col-sm-8" for="saturacionOxigeno">Saturacion Oxigeno</label>
                        <div class="col-xs-5 col-sm-4">
                            <input type="number" class="form-control" id="saturacionOxigeno" name="saturacionOxigeno">
                        </div>
                    </div>
                </div>
                <div class="col-xs-8 col-sm-8">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <button type="button" id='guardarSignosVitales' class="btn btn-success" style="float: right;">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('tabla_sv')
    <div class="row">
        <div class="col-sm-12">
            <table class="table">
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>P. Arterial</th>
                    <th>F. Respiratoria</th>
                    <th>F. Cardiaca</th>
                    <th>Temperatura</th>
                    <th>Talla</th>
                    <th>Peso</th>
                    <th>S. Oxigeno</th>
                </tr>
                </thead>
                <tbody>
                @foreach($arr_sv as $sv)
                    <tr>
                        <td>{{$sv->created_at}}</td>
                        <td>{{$sv->presion_arterial}}</td>
                        <td>{{$sv->frecuencia_respiratoria}}</td>
                        <td>{{$sv->frecuencia_cardiaca}}</td>
                        <td>{{$sv->temperatura_bocal}}</td>
                        <td>{{$sv->talla}}</td>
                        <td>{{$sv->peso}}</td>
                        <td>{{$sv->saturacion_oxigeno}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop