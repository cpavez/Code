@extends('fichaLayout.epiPrestaciones')

@section('tabla_prestaciones')
    <div class="row" style="margin-top:15px;">
        <div class="col-sm-12">
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>Prestación</th>
                    <th>Fecha</th>
                    <th>Cantidad</th>
                    <th>Valor</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
                @foreach($arr_pre as $obj_pre)
                    <tr>
                        <td>{{$obj_pre->descripcion}}</td>
                        <td>{{$obj_pre->pivot->created_at}}</td>
                        <td>{{$obj_pre->pivot->cantidad}}</td>
                        <td>${{number_format($obj_pre->valor * $obj_pre->pivot->cantidad, 0, ",", ".")}}</td>
                        <td>
                            <button type="button" class="btn btn-danger eliminarPrestacion" id='{{$obj_pre->id}}' style="padding: 2px 6px;">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        @if($arr_pre)
            <a href="{{ route('epiPrestaciones',['PrestacionesPDF'=>'pdf',
                                             'pcp_id'=>  $obj_pcp->id,
                                             'esb_id'=>$esb_id,
                                             'epi_id'=>$epi_id]) }}" class="btn btn-primary" style="margin-top:19px;margin-right: 30px;float: right;">Presupuesto PDF</a>
        @endif
    </div>
@stop
