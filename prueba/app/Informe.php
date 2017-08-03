<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 24-05-17
 * Time: 21:07
 */

namespace App;
use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    protected $table = 'informe';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];


}
