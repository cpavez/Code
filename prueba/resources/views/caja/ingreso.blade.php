@extends('cajaLayout.ingreso')
@section('tratamientos')
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="label label-info">Tratamientos <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></span></div>
            <div class="panel-body" style="font-size:16px;">
                <table class="table table-condensed tabla_epi_pagar">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Tratamiento</th>
                        <th>Total Tratamiento</th>
                        <th>Pagado</th>
                        <th>Descuento</th>
                        <th>Por pagar</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(count($obj_epi) > 0)
                        @foreach($obj_epi as $obj_epi)
                            @php($obj_pcp    = $obj_paciente->find($obj_epi->pacientes_id))
                            @php($obj_con    = $obj_convenio->find($obj_pcp->convenio_id))


                            @php($obj_usu = $obj_usu->find($obj_epi->usuarios_id))
                            @php($obj_fun = $obj_fun->find($obj_usu->funcionarios_id))
                            @php($arr_epi = $arr_epi->find($obj_epi->id))
                            @php($obj_pre = $arr_epi->prestaciones)
                            @php($obj_des = $arr_epi->descuentos)


                            @php($var_total = 0)
                            @php($var_abono = 0)
                            @php($var_otro = 0)
                            @php($var_sin_cobrar = 0)

                            @foreach($obj_abo as $obj_abono)
                                @if($obj_epi->id == $obj_abono->episodio_id)
                                    @php($var_abono = $var_abono + $obj_abono->valor)
                                    @php($var_sin_cobrar = $var_sin_cobrar + ($obj_abono->cobrado == 0) ? 1:0)
                                @endif
                            @endforeach

                            @foreach($obj_pre as $prestaciones)
                                @php($var_suma = $prestaciones->pivot->cantidad * $prestaciones->valor)
                                @php($var_total = $var_total + $var_suma)
                            @endforeach
                            @foreach($obj_des as $descuentos)
                                @php($var_otro = $var_otro + $descuentos->pivot->porcentaje)
                            @endforeach

                            @php($var_deuda = $var_total - ($var_total * (($obj_con->porcentaje + $var_otro)/100)))


                            @if(((int)$var_deuda - $var_abono) == 0)
                                @if($var_sin_cobrar > 0)
                                    @php($var_mensaje = 1)
                                @else
                                    @php($var_mensaje = 1)
                                @endif
                            @else
                                @php($var_mensaje = 0)
                            @endif

                            @if(((int)$var_deuda - $var_abono) == 0)
                                @if($var_sin_cobrar > 0)
                                    <tr id='{{$obj_epi->id}}' rel="{{$var_mensaje}}">
                                        <td><input type="radio" name="optionsRadios" id="{{$obj_epi->id}}" value="{{$obj_epi->id}}"></td>
                                        <td>Tratamiento #{{$obj_epi->id}}<br>
                                            Dr. {{ucwords(strtolower($obj_fun->nombres))}} {{ucwords(strtolower($obj_fun->apeillido_pat))}}<br>
                                            Pste. {{ucwords(strtolower($obj_pcp->nombres))}} {{ucwords(strtolower($obj_pcp->apellido_pat))}}<br>

                                            <span class="label label-danger">Pagado - Pendiente Cobrar</span>

                                        </td>
                                        <td>${{number_format($var_total, 0, ",", ".")}}</td>
                                        <td>${{number_format($var_abono, 0, ",", ".")}}</td>
                                        <td>{{$var_otro + $obj_con->porcentaje}}%</td>
                                        <td>${{number_format((int)$var_deuda - $var_abono, 0, ",", ".")}}</td>
                                    </tr>
                                @else

                                @endif
                            @else
                                <tr id='{{$obj_epi->id}}' rel="{{$var_mensaje}}">
                                    <td><input type="radio" name="optionsRadios" id="{{$obj_epi->id}}" value="{{$obj_epi->id}}"></td>
                                    <td>Tratamiento #{{$obj_epi->id}}<br>
                                        Dr. {{ucwords(strtolower($obj_fun->nombres))}} {{ucwords(strtolower($obj_fun->apeillido_pat))}}<br>
                                        Pste. {{ucwords(strtolower($obj_pcp->nombres))}} {{ucwords(strtolower($obj_pcp->apellido_pat))}}<br>

                                        <span class="label label-danger">Deuda</span>

                                    </td>
                                    <td>${{number_format($var_total, 0, ",", ".")}}</td>
                                    <td>${{number_format($var_abono, 0, ",", ".")}}</td>
                                    <td>{{$var_otro + $obj_con->porcentaje}}%</td>
                                    <td>${{number_format((int)$var_deuda - $var_abono, 0, ",", ".")}}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                    </tbody>
                </table>
                @if(count($obj_epi) > 0)
                <div class="form-group" style="margin-bottom:10px;">
                    <div class="col-xs-offset-5 col-xs-7">
                        <button type="button" class="btn btn-success" id='abonar_seleccion'>Abonar Selección</button>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@stop