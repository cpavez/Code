@extends('fichaLayout.epiAnamnesisPediatrica')

@section('eva')
    <form class="form-horizontal" style="width: 700px; padding-top:30px; padding-left:50px; color: #606060;">
        <input type="hidden" id="episodioEvaluda" value="{{$episidioID}}">
        <input type="hidden" id="evaSeleccionado" value="{{$eva}}">
        <div class="form-group">
            <label class="control-label col-xs-3" for="motivoConsulta">Motivo Consulta</label>
            <div class="col-xs-9">
                <textarea class="form-control" rows="3" id="motivoConsulta" name="motivoConsulta">{{$motivoConsulta}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-3" for="eva">EVA</label>
            <div class="col-xs-1" style="padding-right: 0px;">
                <select class="form-control" name="eva" id="eva">
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
                    <div class="progress-bar" id="id_progreso_eva" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$eva}}%;" ></div>
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

        <div class="form-group">
            <label class="control-label col-xs-3" for="examenFisico">Exámen Físico</label>
            <div class="col-xs-9">
                <textarea class="form-control" rows="3" id="examenFisico" name="examenFisico">{{$examenFisico}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-3" for="examenOcular">Exámen Ocular</label>
            <div class="col-xs-9">
                <textarea class="form-control" rows="3" id="examenOcular" name="examenOcular">{{$examenOcular}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-3" for="examenOido">Exámen Oído</label>
            <div class="col-xs-9">
                <textarea class="form-control" rows="3" id="examenOido" name="examenOido">{{$examenOido}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-3" for="examenLenguaje">Exámen Lenguaje</label>
            <div class="col-xs-9">
                <textarea class="form-control" rows="3" id="examenLenguaje" name="examenLenguaje">{{$examenLenguaje}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-3" for="examenDental">Exámen Dental</label>
            <div class="col-xs-9">
                <textarea class="form-control" rows="3" id="examenDental" name="examenDental">{{$examenDental}}</textarea>
            </div>
        </div>
    </form>


@stop

