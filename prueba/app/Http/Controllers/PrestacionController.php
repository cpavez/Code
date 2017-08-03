<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 15-03-17
 * Time: 10:19
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Prestacion;

class PrestacionController extends Controller
{
    public function mostrarPrestacion(Request $request)
    {
        $esb_id = $request->input('esb_id');
        $query = $request->descripcion;
        $arr_pre = Prestacion::where('descripcion','LIKE',"%$query%")->where('activo','=','1')->where('establecimientos_id','=',$esb_id)->get();
        $prestaciones = [];
        foreach($arr_pre as $obj_pre => $prestacion){

            $prestaciones[$obj_pre] = ["id" 	 		=> $prestacion->id,
                                       "denominacion" 	=> $prestacion->descripcion,
                                       "valor" 	 		=> $prestacion->valor];


        }

        return response()->json($prestaciones);
    }
}