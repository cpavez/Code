<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 20-03-17
 * Time: 17:48
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Usuario;
use App\Funcionario;
use App\Establecimiento;
use App\Episodio;
use App\Abono;
use App\Banco;
use App\TipoAbono;
use DateTime;
use Illuminate\Support\Facades\Redirect;

class ReporteController extends Controller
{
    public function reportes(Request $request){
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
                'especialidadDES' => $especialidadDES,
                'obj_fun_'=>$obj_fun_,
                'especialidadID' => $especialidadID];

            return View::make('reporte.reportes', $data);
        }else{
            return Redirect::to('login');
        }


    }

}