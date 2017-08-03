@extends('pdfLayout.epiEpisodioPDF')
@section('contenido')

    <table class="table"  border="1" cellpadding="0" cellspacing="-1" bordercolor="#000000">
        <thead>
        <tr>
            <th colspan="2">
                INDICACIONES DEL PACIENTE
            </th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    @foreach($obj_ind as $indicaciones)
                           {{strtoupper($indicaciones->indicacion)}}<br>
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>
@stop