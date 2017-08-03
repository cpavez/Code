<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 13-03-17
 * Time: 23:19
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use View;


class LogearController extends Controller
{
    public function usuarioEstablecimiento(Request $request)
    {
        $usu_id = $request->input('usu_id');

        $obj_usu = Usuario::find($usu_id);

        $arr_esb = $obj_usu->establecimientos;

        $data = ['arr_esb'=>$arr_esb,
                 'usu_id'=>$usu_id];

        return View::make('ficha.establecimientoUsuario', $data);
    }

    public function validaUsuario(Request $request){
        $usuario = $request->input('usuario');
        $clave   = $request->input('clave');



        $obj_usu = Usuario::where('descripcion','=',$usuario)->where('clave','=',$clave)->get();

        if($obj_usu != '[]'){
            foreach($obj_usu as $obj_usu){
                if($obj_usu->id){
                    $request->session()->put('usuId', $obj_usu->id);
                    return Response()->json(['msj' => 'Encontrado',
                                             'usuId' => $obj_usu->id]);
                }
            }
        }else{
            return Response()->json(['msj' => 'Error',
                                     'usuId' => null]);
        }


    }


    public function guardamosVariableSession(Request $request){
        $esb_id = $request->input('esb_id');
        $usu_id = $request->input('usu_id');
        $request->session()->put('esbId', $esb_id);

        $arr_perfil     = Usuario::leftJoin('rup_relacion_usu_per','rup_relacion_usu_per.usuarios_id','usuarios.id')
                                ->leftJoin('especialidad','especialidad.id','rup_relacion_usu_per.especialidad_id')
                                ->where('rup_relacion_usu_per.establecimientos_id','=',$esb_id)
                                ->where('rup_relacion_usu_per.activo','=','1')
                                ->where('usuarios.id','=',$usu_id)->get();

        $perfilID = '';
        foreach ($arr_perfil as $perfil){
            $perfilID  = $perfil->perfil_id;
        }
        return Response()->json(['code' => 1,
                                 'perfil' => $perfilID]);


    }

    public function guardamosVariableSessionPaciente(Request $request){
        $esb_id = $request->input('pcp_id');
        $request->session()->put('pcpId', $esb_id);
        return Response()->json(['code' => 1]);


    }

}