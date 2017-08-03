<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 05-04-17
 * Time: 19:26
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fotos extends Model
{
    protected $table = 'fotos';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}