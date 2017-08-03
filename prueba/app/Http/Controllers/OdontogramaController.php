<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 22-03-17
 * Time: 16:22
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

use App\CabeceraOdontograma;
use App\DetalleOdontograma;
use App\PrestacionOdontograma;
use App\Prestacion;
use App\Episodio;

class OdontogramaController extends Controller
{
    public function agregarOdontograma(Request $request){
        $epi_id = $request->input('epi_id');
        $fractura = $request->input('fractura');
        $arr_fractura = explode(",", $fractura);
        $restauracion = $request->input('restauracion');
        $arr_restauracion = explode(",", $restauracion);
        $extraidos = $request->input('extraidos');
        $arr_extraidos = explode(",", $extraidos);
        $extraer = $request->input('extraer');
        $arr_extraer = explode(",", $extraer);
        $usu_id = $request->input('usu_id');

        $arr_cod = CabeceraOdontograma::where('episodio_id','=',$epi_id)
                                      ->where('activo','=',1)->get();
        if(count($arr_cod) > 0){
            $cabecaraID = $arr_cod[0]->id;
        }else{
            $cabecaraID = '';
        }


        if($cabecaraID != ''){
            $obj_cabecera = CabeceraOdontograma::find($cabecaraID);
            $obj_cabecera->activo = '0';
            $obj_cabecera->save();
        }

        //var_dump($arr_restauracion);

        $obj_cod = new CabeceraOdontograma;
        $obj_cod->episodio_id = $epi_id;
        $obj_cod->save();

        $CabeceraOdnotogramaId = $obj_cod->id;

        if(count($arr_fractura) > 0 && $arr_fractura != ''){
            foreach ($arr_fractura as $fractura){
                $obj_dod_fractura = new DetalleOdontograma;
                $obj_dod_fractura->piesa_dental = $fractura;
                $obj_dod_fractura->cabecera_odontograma_id = $CabeceraOdnotogramaId;
                $obj_dod_fractura->tipo_procedimiento_id = 1;
                $obj_dod_fractura->save();
            }
        }

        if(count($arr_restauracion) > 0 && $arr_restauracion != ''){
            foreach ($arr_restauracion as $restauracion){
                $obj_dod_restauracion = new DetalleOdontograma;
                $obj_dod_restauracion->piesa_dental = $restauracion;
                $obj_dod_restauracion->cabecera_odontograma_id = $CabeceraOdnotogramaId;
                $obj_dod_restauracion->tipo_procedimiento_id = 2;
                $obj_dod_restauracion->save();
            }
        }

        if(count($arr_extraidos) > 0 && $arr_extraidos != ''){
            foreach ($arr_extraidos as $extraidos){
                $obj_dod_extraidos = new DetalleOdontograma;
                $obj_dod_extraidos->piesa_dental = $extraidos;
                $obj_dod_extraidos->cabecera_odontograma_id = $CabeceraOdnotogramaId;
                $obj_dod_extraidos->tipo_procedimiento_id = 3;
                $obj_dod_extraidos->save();
            }
        }

        if(count($arr_extraer) > 0 & $arr_extraer != ''){
            foreach ($arr_extraer as $extraer){
                $obj_dod_extraer = new DetalleOdontograma;
                $obj_dod_extraer->piesa_dental = $extraer;
                $obj_dod_extraer->cabecera_odontograma_id = $CabeceraOdnotogramaId;
                $obj_dod_extraer->tipo_procedimiento_id = 4;
                $obj_dod_extraer->save();
            }
        }

        $insertId = null;




        $arr_pod = PrestacionOdontograma::select('prestacion_odontograma.id as id_pod',
                                                'prestacion.descripcion',
                                                'prestacion.id as prestacion_id',
                                                'prestacion.valor',
                                                'prestacion_odontograma.cantidad',
                                                'prestacion_odontograma.piesa')
                                                ->leftJoin('prestacion','prestacion.id','prestacion_odontograma.prestacion_id')
                                                ->where('prestacion_odontograma.episodio_id','=',$epi_id)
                                                ->where('prestacion_odontograma.activo','=','1')->get();



        if(count($arr_pod) > 1){
            foreach ($arr_pod as $var){
                $obj_epi = Episodio::find($epi_id);
                $obj_pre = Prestacion::find($var->prestacion_id);

                $obj_epi->prestaciones()->detach($obj_pre);
            }
        }


        foreach ($arr_pod as $var){
            $obj_epi = Episodio::find($epi_id);
            $obj_pre = Prestacion::find($var->prestacion_id);

            $obj_epi->prestaciones()->attach($obj_pre,array('usuarios_id' => $usu_id,
                                                            'cantidad' => $var->cantidad));
        }



        return Response()->json(['abo_id' => $insertId,
                                 'msj' => 'Agregado']);

    }

    public function listarOdontograma(Request $request){
        $epi_id         = $request->input('epi_id');
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');


        $arr_cod = CabeceraOdontograma::where('episodio_id','=',$epi_id)
                                      ->where('activo','=',1)->get();
        $obj_fractura = new DetalleOdontograma();
        $obj_obturacion = new DetalleOdontograma();
        $obj_extraccion = new DetalleOdontograma();
        $obj_por_extraer = new DetalleOdontograma();

        if(count($arr_cod) > 0){
            $cabecaraID = $arr_cod[0]->id;
            $fracturas = [];
            $obsturaciones = [];
            $extracciones = [];
            $por_extracciones = [];


            $arr_det_fractura = $obj_fractura->where('cabecera_odontograma_id','=',$cabecaraID)
                                             ->where('tipo_procedimiento_id','=',1)->get();

            $arr_det_obsturacion = $obj_obturacion->where('cabecera_odontograma_id','=',$cabecaraID)
                                                  ->where('tipo_procedimiento_id','=',2)->get();

            $arr_det_extracion = $obj_extraccion->where('cabecera_odontograma_id','=',$cabecaraID)
                                                ->where('tipo_procedimiento_id','=',3)->get();

            $arr_det_por_extracion = $obj_por_extraer->where('cabecera_odontograma_id','=',$cabecaraID)
                                                     ->where('tipo_procedimiento_id','=',4)->get();

            foreach($arr_det_fractura as $index => $fractura){
                $fracturas[$index] = $fractura->piesa_dental;
            }

            foreach($arr_det_obsturacion as $index => $obsturacion){
                $obsturaciones[$index] = $obsturacion->piesa_dental;
            }

            foreach($arr_det_extracion as $index => $extraccion){
                $extracciones[$index] = $extraccion->piesa_dental;
            }

            foreach($arr_det_por_extracion as $index => $por_extraccion){
                $por_extracciones[$index] = $por_extraccion->piesa_dental;
            }
        }else{
            $fracturas = null;
            $obsturaciones = null;
            $extracciones = null;
            $por_extracciones = null;
        }



        return Response()->json(['fracturas' => ($fracturas) ? $fracturas:null,
                                 'obsturacion' => ($obsturaciones) ? $obsturaciones:null,
                                 'extraccion' => ($extracciones) ? $extracciones:null,
                                 'por_extraccion' => ($por_extracciones) ? $por_extracciones:null,
                                 'msj' => 'Listado']);
    }

    public function agregarPrestacionOdontograma(Request $request){
        $prestacionID = $request->input('prestacionID');
        $episodioID = $request->input('episodioID');
        $piesas = $request->input('piesas');
        $cantidad = $request->input('cantidad');

        $obj_pod = new PrestacionOdontograma;

        $obj_pod->episodio_id = $episodioID;
        $obj_pod->prestacion_id = $prestacionID;
        $obj_pod->piesa = $piesas;
        $obj_pod->cantidad = $cantidad;
        $obj_pod->save();

        $insertId = $obj_pod->id;

        return Response()->json(['pod_id' => $insertId,
                                 'msj' => 'Agregado']);
    }

    public function listarPrestacionOdontograma(Request $request){
        $episodioID = $request->input('epi_id');
        $arr_pod = PrestacionOdontograma::select('prestacion_odontograma.id as id_pod',
                                                 'prestacion.descripcion',
                                                 'prestacion.valor',
                                                 'prestacion_odontograma.cantidad',
                                                 'prestacion_odontograma.piesa')
                                        ->leftJoin('prestacion','prestacion.id','prestacion_odontograma.prestacion_id')
                                        ->where('prestacion_odontograma.episodio_id','=',$episodioID)
                                        ->where('prestacion_odontograma.activo','=','1')->get();

        $data = ['arr_pre'  => $arr_pod];
        return View::make('ficha.listaPrestaciones', $data);
    }

    public function eliminarPrestacionOdontograma(Request $request){
        $pod_id = $request->input('pod_id');
        $obj_pod = PrestacionOdontograma::find($pod_id);
        $obj_pod->delete();

        return Response()->json(['pod_id' => $pod_id,
                                 'msj' => 'Eliminado']);
    }
}