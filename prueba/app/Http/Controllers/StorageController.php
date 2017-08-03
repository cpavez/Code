<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 27-03-17
 * Time: 19:28
 */

namespace App\Http\Controllers;
use App\Fotos;
use Illuminate\Http\Request;
use App\AnamnesisProxima;
use App\AnamnesisProximaKine;
class StorageController extends Controller
{
    public function save(Request $request)
    {
        $Base64Img = $request->img;
        $nombre = $request->nombre_imagen;
        $evaEstatico = $request->evaEstatico;
        $evaDinamico = $request->evaDinamico;
        $frecuencia = $request->frecuencia;
        $zona = $request->zona;
        $anamnesisActual = $request->anamnesisActual;
        $anamnesisRemota = $request->anamnesisRemota;
        $examenes = $request->examenes;
        $inspeccion = $request->inspeccion;
        $palpacion = $request->palpacion;
        $sensibilidad = $request->sensibilidad;
        $movilizacion = $request->movilizacion;
        $motivoConsulta = $request->motivoConsulta;


        $obj_anam = new AnamnesisProximaKine;

        $obj_anam->evaEstatico = $evaEstatico;
        $obj_anam->evaDinamico = $evaDinamico;
        $obj_anam->frecuencia = $frecuencia;
        $obj_anam->zona = $zona;
        $obj_anam->episodio_id = $nombre;
        $obj_anam->anamnesisActual = $anamnesisActual;
        $obj_anam->motivoConsulta = $motivoConsulta;
        $obj_anam->anamnesisRemota = $anamnesisRemota;
        $obj_anam->examenes = $examenes;
        $obj_anam->inspeccion = $inspeccion;
        $obj_anam->palpacion = $palpacion;
        $obj_anam->sensibilidad = $sensibilidad;
        $obj_anam->movilizacion = $movilizacion;

        $obj_anam->save();
        $insertId = $obj_anam->id;

        if($Base64Img){
            list(, $Base64Img) = explode(';', $Base64Img);
            list(, $Base64Img) = explode(',', $Base64Img);
            $Base64Img = base64_decode($Base64Img);

            $file = $Base64Img;
            $folderName = '/img/';
            $safeName = $nombre.'_'.$insertId.'.'.'png';
            file_put_contents(public_path().'/img/cuerpo/'.$safeName, $file);
        }




        return Response()->json(['epi_id' => $insertId,
                                 'msj' => 'Insertado']);
    }

    public function saveFotoPersona(Request $request)
    {
        $Base64Img = $request->img;
        $nombre = $request->epi_id.'_'.rand();
        $epi_id = $request->epi_id;

        if($Base64Img){
            list(, $Base64Img) = explode(';', $Base64Img);
            list(, $Base64Img) = explode(',', $Base64Img);
            $Base64Img = base64_decode($Base64Img);

            $file = $Base64Img;
            $folderName = '/img/';
            $safeName = $nombre.'.'.'png';
            file_put_contents(public_path().'/img/personas/'.$safeName, $file);
        }


        $obj_foto = new Fotos;

        $obj_foto->episodio_id = $epi_id;
        $obj_foto->ruta = $nombre;

        $obj_foto->save();
        $insertId = $obj_foto->id;

        return Response()->json(['foto_id' => $insertId,
            'msj' => 'Insertado']);
    }
}