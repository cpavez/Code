<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<div class="titulo page_header">
    @yield('titulo')
    <br>
    <span>CLÍNICA {{$obj_esb->descripcion}}</span>
</div>

<div class="wrap page">
    <table class="table" border="1" cellpadding="0" cellspacing="-1">
        <tr>
            <th colspan="3">
                INDENTIFICACION DEL PACIENTE
            </th>
        </tr>
        <tr>
            <td colspan="3">
                Nombre: {{$obj_pcp->nombres}} {{$obj_pcp->apellido_pat}} {{$obj_pcp->apellido_mat}}
            </td>
        </tr>
        <tr>
            <td>
                Run: {{$obj_pcp->rut}}-{{$obj_pcp->dv}}
            </td>
            <td>
                @php($genero = $obj_sex::find($obj_pcp->sexo_id))
                Genero: {{$genero->descripcion}}
            </td>
            <td>
                Fecha Nacimiento: {{$obj_pcp->fecha_nacimiento}}
            </td>
        </tr>
        <tr>
            <td colspan="3">
                Domicilio: {{$obj_pcp->direccion}}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                @php($ciudad = $obj_ciu::find($obj_pcp->ciudad_id))
                Ciudad Residencia: {{$ciudad->descripcion}}
            </td>
            <td>
                Telefono:{{$obj_pcp->telefono_fijo}} / {{$obj_pcp->telefono_celular}}
            </td>
        </tr>
    </table>
    @yield('contenido')
    <footer>
        <table class="table"  border="1" cellpadding="0" cellspacing="-1" bordercolor="#000000">
            <tr>
                <th colspan="4">
                    DATOS DEL MEDICO RESPONSABLE DE EPICRISIS
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    NOMBRE
                </td>
                <td colspan="2">
                    {{$obj_fun->nombres}} {{$obj_fun->apellido_pat}} {{$obj_fun->apellido_mat}}
                </td>
            </tr>
            <tr>
                <td>
                    RUN
                </td>
                <td>
                    {{$obj_fun->rut}}-{{$obj_fun->dv}}
                </td>
                <td>
                    FIRMA
                </td>
                <td>
                </td>
            </tr>
        </table>

    </footer>
</div>