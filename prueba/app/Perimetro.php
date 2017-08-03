<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 24-05-17
 * Time: 11:51
 */

namespace App;
use Illuminate\Database\Eloquent\Model;

class Perimetro extends Model
{
    protected $table = 'perimetro';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];


}