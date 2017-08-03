<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 23-03-17
 * Time: 15:59
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App;
use PDF;
use App\Http\Controllers\fonasa;


class ItemController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function paciente()
    {
        $obj_fonasa = new fonasa();

        $resultado = $obj_fonasa->datosFonasa(19201295,3);

        var_dump($resultado);
    }
}