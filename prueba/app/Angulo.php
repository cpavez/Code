<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 24-05-17
 * Time: 11:57
 */

namespace App;
use Illuminate\Database\Eloquent\Model;


class Angulo extends Model
{
    protected $table = 'angulo';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];


}