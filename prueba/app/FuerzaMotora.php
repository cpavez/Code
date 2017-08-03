<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 24-05-17
 * Time: 11:32
 */

namespace App;
use Illuminate\Database\Eloquent\Model;


class FuerzaMotora extends Model
{
    protected $table = 'fuerza_motora';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];


}