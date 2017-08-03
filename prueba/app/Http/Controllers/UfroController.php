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

class UfroController extends Controller
{
    public function indexUfro(Request $request){
        $data = ['obj_fun' => null];
        return View::make('ufro.index', $data);
    }

}