<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 20-03-17
 * Time: 16:36
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Convenio;
use App\Sexo;
use App\Prestacion;
use App\TipoExamen;
use App\EstadoAgenda;
use App\Descuento;
use App\Banco;
use App\Establecimiento;
use App\Funcionario;
use App\Usuario;
use Illuminate\Support\Facades\Redirect;

class AdministracionController extends Controller
{
    public function administracion(Request $request){
        //$esb_id = $request->input('esb_id');
        //$usu_id = $request->input('usu_id');
        if ($request->session()->has('usuId') && $request->session()->has('esbId')) {
            $usu_id = $request->session()->get('usuId');
            $esb_id = $request->session()->get('esbId');


            $obj_esb     = Establecimiento::find($esb_id);
            $obj_usu     = Usuario::find($usu_id);
            $obj_fun_     = Funcionario::find($obj_usu->funcionarios_id);

            $nombres = explode(" ", $obj_fun_->nombres);
            $nombre = $nombres[0].' '.$obj_fun_->apellido_pat;
            $obj_fun = Funcionario::all();

            $arr_perfil     = Usuario::leftJoin('rup_relacion_usu_per','rup_relacion_usu_per.usuarios_id','usuarios.id')
                ->leftJoin('especialidad','especialidad.id','rup_relacion_usu_per.especialidad_id')
                ->where('rup_relacion_usu_per.establecimientos_id','=',$esb_id)
                ->where('rup_relacion_usu_per.activo','=','1')
                ->where('usuarios.id','=',$usu_id)->get();

            $perfilID = '';
            $especialidadID = '';
            $especialidadDES = '';

            foreach ($arr_perfil as $perfil){

                $perfilID       = $perfil->perfil_id;
                $especialidadID = $perfil->especialidad_id;
                $especialidadDES = $perfil->descripcion;
            }

            $data = ['obj_fun' => $obj_fun,
                'obj_esb'=>$obj_esb,
                'obj_usu'=>$obj_usu,
                'fun_nombre'=>$nombre,
                'perfilID' => $perfilID,
                'obj_fun_'=>$obj_fun_,
                'especialidadDES' => $especialidadDES,
                'especialidadID' => $especialidadID];

            return View::make('administracion.administracion', $data);
        }else{
            return Redirect::to('login');
        }


    }

    public function listarConvenios(Request $request)
    {
        $esb_id = $request->input('esb_id');

        $obj_con = Convenio::where('establecimientos_id','=',$esb_id)->where('activo','=',1)->get();


        $data = ['obj_con'   => $obj_con];

        return View::make('administracion.admConvenios', $data);
    }

    public function agregarConvenio(Request $request){

        $convenio_des 	= $request->input('convenio');
        $porcentage 	= $request->input('porcentage');
        $esb_id			= $request->input('esb_id');
        $usu_id 		= $request->input('usu_id');


        $convenio = new Convenio;

        $convenio->descripcion = strtoupper($convenio_des);
        $convenio->porcentaje = $porcentage;
        $convenio->establecimientos_id = $esb_id;

        $convenio->save();


        $insertId = $convenio->id;
        return Response()->json(['epi_id' => $insertId,
                                 'msj' => 'Insertado']);
    }

    public function eliminarConvenio(Request $request){

        $con_id 		= $request->input('con_id');
        $usu_id 		= $request->input('usu_id');


        $convenio = Convenio::find($con_id);

        $convenio->activo = 0;

        $convenio->save();


        $insertId = $convenio->id;
        return Response()->json(['epi_id' => $insertId,
                                 'msj' => 'Eliminado']);
    }

    public function listarSexo(Request $request)
    {
        $esb_id = $request->input('esb_id');

        $obj_sex = Sexo::where('activo','=',1)->get();

        $data = ['obj_sex'   => $obj_sex];

        return View::make('administracion.admSexo', $data);
    }

    public function agregarSexo(Request $request){

        $sexo_des 		= $request->input('sexo');
        $esb_id			= $request->input('esb_id');
        $usu_id 		= $request->input('usu_id');


        $sexo = new Sexo;

        $sexo->descripcion = strtoupper($sexo_des);
        $sexo->establecimientos_id = $esb_id;
        $sexo->save();


        $insertId = $sexo->id;
        return Response()->json(['epi_id' => $insertId,
                                 'msj' => 'Insertado']);
    }

    public function eliminarSexo(Request $request){

        $sex_id 		= $request->input('sex_id');
        $usu_id 		= $request->input('usu_id');


        $sexo = Sexo::find($sex_id);

        $sexo->activo = 0;

        $sexo->save();

        $insertId = $sexo->sex_id;
        return Response()->json(['epi_id' => $insertId,
                                 'msj' => 'Eliminado']);
    }

    public function listarPrestaciones(Request $request)
    {
        $esb_id = $request->input('esb_id');

        $obj_pre = Prestacion::where('establecimientos_id','=',$esb_id)->where('activo','=',1)->get();

        $data = ['obj_pre'   => $obj_pre];

        return View::make('administracion.admPrestaciones', $data);
    }

    public function agregarPrestaciones(Request $request){

        $prestacion_des = $request->input('prestacion');
        $valor 			= $request->input('valor');
        $esb_id			= $request->input('esb_id');
        $usu_id 		= $request->input('usu_id');


        $prestacion = new Prestacion;

        $prestacion->descripcion = strtoupper($prestacion_des);
        $prestacion->valor = $valor;
        $prestacion->establecimientos_id = $esb_id;
        $prestacion->save();


        $insertId = $prestacion->id;
        return Response()->json(['epi_id' => $insertId,
                                 'msj' => 'Insertado']);
    }

    public function eliminarPrestaciones(Request $request){

        $pre_id 		= $request->input('pre_id');
        $usu_id 		= $request->input('usu_id');


        $prestacion = Prestacion::find($pre_id);

        $prestacion->activo = 0;

        $prestacion->save();


        $insertId = $prestacion->id;

        return Response()->json(['epi_id' => $insertId,
                                 'msj' => 'Eliminado']);
    }

    public function listarTipoExamenes(Request $request)
    {
        $esb_id = $request->input('esb_id');

        $obj_tpe = TipoExamen::where('establecimientos_id','=',$esb_id)->where('activo','=',1)->get();

        $data = ['obj_tpe'   => $obj_tpe];

        return View::make('administracion.admTipoExamenes', $data);
    }

    public function agregarTipoExamenes(Request $request){

        $tipoExamen_des = $request->input('tipoExamen');
        $esb_id			= $request->input('esb_id');
        $usu_id 		= $request->input('usu_id');


        $tipoExamen = new TipoExamen;

        $tipoExamen->descripcion = strtoupper($tipoExamen_des);
        $tipoExamen->establecimientos_id = $esb_id;
        $tipoExamen->save();


        $insertId = $tipoExamen->id;
        return Response()->json(['tpe_id' => $insertId,
                                 'msj' => 'Insertado']);
    }

    public function eliminarTipoExamenes(Request $request){

        $tpe_id 		= $request->input('tpe_id');
        $usu_id 		= $request->input('usu_id');


        $tipoExamen = TipoExamen::find($tpe_id);

        $tipoExamen->activo = 0;

        $tipoExamen->save();


        $insertId = $tipoExamen->id;
        return Response()->json(['tpe_id' => $insertId,
                                 'msj' => 'Eliminado']);
    }

    public function listarEstadoAtencion(Request $request)
    {
        $esb_id = $request->input('esb_id');

        $obj_est = EstadoAgenda::where('activo','=',1)->get();

        $data = ['obj_est'   => $obj_est];

        return View::make('administracion.admEstadoAtencion', $data);
    }

    public function agregarEstadoAtencion(Request $request){

        $estadoAtencion_des = $request->input('estadoAtencion');
        $esb_id				= $request->input('esb_id');
        $usu_id 			= $request->input('usu_id');


        $estadoAtencion = new EstadoAgenda;

        $estadoAtencion->descripcion = strtoupper($estadoAtencion_des);
        $estadoAtencion->establecimientos_id = $esb_id;
        $estadoAtencion->save();


        $insertId = $estadoAtencion->id;
        return Response()->json(['est_id' => $insertId,
                                 'msj' => 'Insertado']);
    }

    public function eliminarEstadoAtencion(Request $request){

        $est_id 		= $request->input('est_id');
        $usu_id 		= $request->input('usu_id');


        $estadoAtencion = EstadoAgenda::find($est_id);

        $estadoAtencion->activo = 0;

        $estadoAtencion->save();


        $insertId = $estadoAtencion->id;
        return Response()->json(['est_id' => $insertId,
                                 'msj' => 'Eliminado']);
    }

    public function listarDescuentos(Request $request)
    {
        $esb_id = $request->input('esb_id');

        $obj_des = Descuento::where('establecimientos_id','=',$esb_id)->where('activo','=',1)->get();

        $data = ['obj_des'   => $obj_des];

        return View::make('administracion.admDescuentos', $data);
    }

    public function agregarDescuentos(Request $request){

        $descuento_des 		= $request->input('descuento');
        $esb_id				= $request->input('esb_id');
        $usu_id 			= $request->input('usu_id');


        $descuento = new Descuento;

        $descuento->descripcion = strtoupper($descuento_des);
        $descuento->establecimientos_id = $esb_id;
        $descuento->save();


        $insertId = $descuento->id;
        return Response()->json(['des_id' => $insertId,
                                 'msj' => 'Insertado']);
    }

    public function eliminarDescuentos(Request $request){

        $des_id 		= $request->input('des_id');
        $usu_id 		= $request->input('usu_id');


        $descuento = Descuento::find($des_id);

        $descuento->activo = 0;

        $descuento->save();


        $insertId = $descuento->id;
        return Response()->json(array('des_id' => $insertId,
                                      'msj' => 'Eliminado'));
    }

    public function listarBancos(Request $request)
    {
        $esb_id = $request->input('esb_id');

        $obj_ban = Banco::where('establecimientos_id','=',$esb_id)->where('activo','=',1)->get();

        $data = ['obj_ban'   => $obj_ban];

        return View::make('administracion.admBancos', $data);
    }

    public function agregarBancos(Request $request){

        $banco_des 		= $request->input('banco');
        $esb_id				= $request->input('esb_id');
        $usu_id 			= $request->input('usu_id');


        $banco = new Banco;

        $banco->descripcion = strtoupper($banco_des);
        $banco->establecimientos_id = $esb_id;
        $banco->save();


        $insertId = $banco->id;
        return Response()->json(['ban_id' => $insertId,
                                 'msj' => 'Insertado']);
    }

    public function eliminarBancos(Request $request){

        $ban_id 		= $request->input('ban_id');
        $usu_id 		= $request->input('usu_id');


        $banco = Banco::find($ban_id);

        $banco->activo = 0;

        $banco->save();


        $insertId = $banco->id;
        return Response()->json(['ban_id' => $insertId,
                                 'msj' => 'Eliminado']);
    }

    public function modificarPerfil(Request $request){

        $nombre 		= $request->input('nombre');
        $apellidoPat 	= $request->input('apellidoPat');
        $apellidoMat 	= $request->input('apellidoMat');
        $direccion 	    = $request->input('direccion');
        $mail 		    = $request->input('mail');
        $usuario 		= $request->input('usuario');
        $clave 		    = $request->input('clave');
        $fun_id 		= $request->input('fun_id');
        $usu_id 		= $request->input('usu_id');


        $obj_fun = Funcionario::find($fun_id);
        $obj_usu = Usuario::find($usu_id);

        $obj_fun->nombres = $nombre;
        $obj_fun->apellido_pat = $apellidoPat;
        $obj_fun->apellido_mat = $apellidoMat;
        $obj_fun->direccion = $direccion;
        $obj_fun->correo = $mail;

        $obj_fun->save();

        $obj_usu->descripcion = $usuario;
        $obj_usu->clave = $clave;

        $obj_usu->save();

        $insertId = $obj_fun->id;
        return Response()->json(['epi_id' => $insertId,
                                 'msj' => 'Modificado']);
    }
}