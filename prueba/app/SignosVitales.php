<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 29-03-17
 * Time: 23:09
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class SignosVitales extends Model
{
    protected $table = 'signos_vitales';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}